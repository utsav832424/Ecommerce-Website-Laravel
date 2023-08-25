<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Users extends Controller
{
    public function saveusers(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ]);
        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $checkEmail = DB::table('users')->where([['email', '=', $request->email]])->get()->count();

            if ($checkEmail > 0) {
                return response()->json(['status' => false, 'message' => 'The email address entered already exists, Please enter another email address']);
            }
            $checkMobile = DB::table('users')->where([['mobile', '=', $request->mobile]])->get()->count();

            if ($checkMobile > 0) {
                return response()->json(['status' => false, 'message' => 'The mobile numner entered already exists, Please enter new mobile number']);
            }

            $value = [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isActive' => 1,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('users')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Registration has been succeessfully', "url" => route('userLogin'), 'redirect' => true]);
            }
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return back()->with('error', $errorMessage)->withInput();
        } else {
            $userData = DB::table('users')->where([['email', '=', $request->email], ['isActive', '=', 1], ['role', '=', 'user']])->first();
            if ($userData) {
                if (Hash::check($request->password, $userData->password)) {
                    $request->session()->put('userData', $userData);
                    return redirect()->route('home');
                } else {
                    return back()->with('error', 'Entered password is not valid, Please enter correct password');
                }
            } else {
                return back()->with('error', 'Please enter a valid email, the email entered does not exist in our system');
            }
        }
    }

    public function logout()
    {
        Session::forget('userData');
        return redirect()->route('login');
    }
    function getNewToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shipment.xpressbees.com/api/users/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
"email": "biggershop12@gmail.com",
"password": "bigger@121212"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $xpressbees_token = json_decode($response)->data;
        $query = DB::table('site_setting')
                ->where('id', 1)
                ->update([
                    'token' =>json_decode($response)->data,
                    ]);
                    return $xpressbees_token;
    }
    function loginSubmit(Request $request)
    {
        $userData = DB::table('users')->where([['email', '=', $request->email], ['role', '=', 'admin'], ['isActive', '=', 1]])->first();


        if ($userData) {
            if (Hash::check($request->password, $userData->password)) {

                $userData->xpressbees_token = $this->getNewToken();
                $request->session()->put('adminData', $userData);

                return redirect()->route('dashboard');
            } else {
                return back()->with('error', 'Entered password is not valid, Please enter correct password');
            }
        } else {
            return back()->with('error', 'Please enter valid email address');
        }
    }

    public function adminLogout()
    {
        Session::forget('adminData');
        return redirect()->route('admin-login');
    }

    function userProductAddToWishList(Request $request)
    {
        if (Session()->has('userData')) {
            $wishproduct = DB::table('wishlists')->where([['product_id', '=', $request->pid], ['isActive', '=', 1]])->get();
            $countProduct = $wishproduct->count();

            if ($countProduct > 0) {
                return response()->json(["status" => false, "message" => "Product has already been added to your wishlist"]);
            } else {
                $product = DB::table('product')->where([['id', '=', $request->pid], ['isActive', '=', 1]])->first();
                $value = [
                    'user_id' => Session::get('userData')->id,
                    'product_id' => $request->pid,
                    'price' => $product->price,
                    'quantity' => 1,
                    'amount' => $product->price,
                    'isActive' => 1,
                    'added_datetime' => date('Y-m-d H:i:s'),
                ];

                $query = DB::table('wishlists')->insert($value);

                if ($query) {
                    return response()->json(["status" => true, "message" => "Product has been successfully added to your wishlist"]);
                }
            }
        } else {
            return response()->json(["status" => false, "message" => "Please login first and then you can add product to wishlist", "url" => route('userLogin'), 'redirect' => true]);
        }
    }

    function userWishList()
    {
        $userData = Session::get('userData');
        $featured = DB::table('product')
            ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug', 'wishlists.price', 'wishlists.quantity', 'wishlists.id as wishlistsId')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->join('wishlists', 'wishlists.product_id', '=', 'product.id')
            ->where([['product.isActive', '=', 1], ['product.status', '=', 2], ['wishlists.user_id', '=', $userData->id], ['wishlists.isActive', '=', 1]])->get();

        foreach ($featured as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $value->img = $product_img;
            $value->main_img = $product_img[0]->image;
        }

        return view('frontend.my_wishlist')
            ->with('data', $featured);
    }

    function userRemoveWishList(Request $request)
    {

        $query = DB::table('wishlists')
            ->where('id', $request->pid)
            ->delete();

        if ($query) {
            return response()->json(['status' => true, 'message' => 'The product has been successfully removed from your wishlist']);
        } else {
            return response()->json(['status' => false, 'message' => 'The product has been failed removed from your wishlist, Please try again after some time']);
        }
    }

    function addToCard(Request $request)
    {
        $userData = Session::get('userData');
        if (!Session()->has('userData')) {
            return response()->json(['status' => false, 'message' => 'Please login first', 'url' => route('login')]);
        }
        $productData = DB::table('product')->where([['id', '=', $request->pid]])->first();
        $sell = DB::table('carts')->where([['product_id', '=', $request->pid], ['status', '=', 1]])->get()->count();
        $qty = DB::table('qty_adjustment')->select(DB::raw('sum(qty) as total'))->where([['product_id', '=', $request->pid]])->first();
        $totalQty = $productData->quantity + $qty->total;

        if ($totalQty > $sell) {
            $value = [
                'user_id' => $userData->id,
                'product_id' => $request->pid,
                'color_id' => $request->cid,
                'size_id' => $request->sid,
                'quantity' => 1,
                'price' => $productData->price,
                'amount' => $productData->price,
                'total_amount' => $productData->price,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('carts')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'The product has been successfully added to your cart list']);
            } else {
                return response()->json(['status' => false, 'message' => 'The product has been failed added to your cart list, Please try again after some time']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'The product has been out of stock, Please try again after some time.']);
        }
    }

    function singalProductAddToCard(Request $request)
    {
        $userData = Session::get('userData');
        if (!Session()->has('userData')) {
            return response()->json(['status' => false, 'message' => 'Please login first', 'url' => route('login')]);
        }
        $productData = DB::table('size_price')->where([['product_id', '=', $request->pid], ['size_id', '=', $request->sid]])->first();
        $sell = DB::table('carts')->where([['product_id', '=', $request->pid], ['status', '=', 1]])->get()->count();
        $qty = DB::table('qty_adjustment')->select(DB::raw('sum(qty) as total'))->where([['product_id', '=', $request->pid]])->first();
        $totalQty = $productData->quantity + $qty->total;

        if ($totalQty > $sell) {
            $value = [
                'user_id' => $userData->id,
                'product_id' => $request->pid,
                'color_id' => $request->cid,
                'size_id' => $request->sid,
                'quantity' => $request->qty,
                'price' => $productData->price,
                'amount' => $productData->price * $request->qty,
                'total_amount' => $productData->price * $request->qty,
                'added_datetime' => date('Y-m-d H:i:s'),

            ];

            $query = DB::table('carts')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'The product has been successfully added to your cart list']);
            } else {
                return response()->json(['status' => false, 'message' => 'The product has been failed added to your cart list, Please try again after some time']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'The product has been out of stock, Please try again after some time.']);
        }
    }

    function removeCartProduct(Request $request)
    {
        $orderData = DB::table('carts')->where([['id', '=', $request->oid]])->get()->count();

        if ($orderData > 0) {
            DB::table('carts')->where([['id', '=', $request->oid]])->delete();
            return response()->json(['status' => true, 'message' => 'Selected cart products has been successfully removed']);
        }

        return response()->json(['status' => false, 'message' => 'Selected cart products cannot be removed, please contact admin']);
    }

    function clearCartProduct()
    {
        $userData = Session::get('userData');
        DB::table('carts')->where([['user_id', '=', $userData->id], ['status', '=', 0]])->delete();
        return redirect('/view_cart');
    }

    function increaseCartProductQty(Request $request)
    {
        if ($request->has('oid')) {
            $orderData = DB::table('carts')->where([['id', '=', $request->oid]])->first();
            $productData = DB::table('product')->where([['id', '=', $orderData->product_id]])->first();
            $qty = DB::table('qty_adjustment')->select(DB::raw('sum(qty) as total'))->where([['product_id', '=', $productData->id]])->first();
            $totalQty = $productData->quantity + $qty->total;
            if ($totalQty > $orderData->quantity + 1) {
                $amount = ($orderData->quantity + 1) * $orderData->price;
                $query = DB::table('carts')
                    ->where([['id', '=', $request->oid]])
                    ->update(['quantity' => $orderData->quantity + 1, 'amount' => $amount, 'total_amount' => $amount]);
                $orderData = DB::table('carts')->where([['id', '=', $request->oid]])->first();

                $userData = Session::get('userData');
                $total_amount = DB::table('carts')->where(
                    [
                        ['isActive', '=', 1],
                        ['user_id', '=', $userData->id],
                        ['shipping_id', '=', 0],
                        ['status', '=', 0],
                        ['payment_method', '=', null]
                    ]
                )->sum('total_amount');

                return response()->json(['status' => true, 'message' => 'Cart data has been successfully updated', 'data' => $orderData, 'total_amount' => $total_amount]);
            } else {
                return response()->json(['status' => false, 'message' => 'Out Of Stock']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Cart id is required']);
        }
    }

    function decreaseCartProductQty(Request $request)
    {
        if ($request->has('oid')) {
            $orderData = DB::table('carts')->where([['id', '=', $request->oid]])->first();

            $amount = ($orderData->quantity - 1) * $orderData->price;
            if ($orderData->quantity - 1 > 0) {
                $query = DB::table('carts')
                    ->where([['id', '=', $request->oid]])
                    ->update(['quantity' => $orderData->quantity - 1, 'amount' => $amount, 'total_amount' => $amount]);
                $orderData = DB::table('carts')->where([['id', '=', $request->oid]])->first();

                $userData = Session::get('userData');
                $total_amount = DB::table('carts')->where(
                    [
                        ['isActive', '=', 1],
                        ['user_id', '=', $userData->id],
                        ['shipping_id', '=', 0],
                        ['status', '=', 0],
                        ['payment_method', '=', null]
                    ]
                )->sum('total_amount');

                return response()->json(['status' => true, 'message' => 'Cart data has been successfully updated', 'data' => $orderData, 'total_amount' => $total_amount]);
            } else {
                return response()->json(['status' => false, 'message' => 'At least 1 mandatory quantity']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Cart id is required']);
        }
    }

    function addShippingAddress(Request $request)
    {
        if ($request->type == 0) {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'mobile' => 'required',
                'flat_no' => 'required',
                'address' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
            ]);

            if (!$validator->passes()) {
                $errorMessage = "";
                foreach ($validator->errors()->toArray() as $key => $value) {
                    $errorMessage = $value[0];
                    break;
                }
                return response()->json(['status' => false, 'message' => $errorMessage]);
            } else {
                $userData = Session::get('userData');
                $value = [
                    'user_id' => $userData->id,
                    'name' => $request->fullname,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'flat_no' => $request->flat_no,
                    'address' => $request->address,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'isActive' => 1,
                    'added_datetime' => date('Y-m-d H:i:s'),
                ];

                $query = DB::table('shipping')->insertGetId($value);

                if ($query > 0) {
                    $orderNumber = 'ORD-' . strtoupper(Str::random(8));
                    $orderData = DB::table('orders')->where([['order_number', '=', $orderNumber]])->get();
                    if ($orderData->count() > 0) {
                        $status = true;
                        while ($status) {
                            $orderNumber = 'ORD-' . strtoupper(Str::random(8));
                            $orderData = DB::table('orders')->where([['order_number', '=', $orderNumber]])->get();
                            if ($orderData->count() == 0) {
                                $status = false;
                            }
                        }
                    }

                    $value = [
                        'user_id' => $userData->id,
                        'shipping_id' => $query,
                        'order_number' => $orderNumber,
                        'isActive' => 1,
                        'added_datetime' => date('Y-m-d H:i:s'),
                    ];

                    $orderId = DB::table('orders')->insertGetId($value);
                    return response()->json(['status' => true, 'message' => 'Shipping Adddress has been succeessfully added', 'orderId' => $orderId]);
                }
            }
        } else {
            $userData = Session::get('userData');
            $shipping = $request->shipping;
            $orderNumber = 'ORD-' . strtoupper(Str::random(8));
            $orderData = DB::table('orders')->where([['order_number', '=', $orderNumber]])->get();
            if ($orderData->count() > 0) {
                $status = true;
                while ($status) {
                    $orderNumber = 'ORD-' . strtoupper(Str::random(8));
                    $orderData = DB::table('orders')->where([['order_number', '=', $orderNumber]])->get();
                    if ($orderData->count() == 0) {
                        $status = false;
                    }
                }
            }

            $value = [
                'user_id' => $userData->id,
                'shipping_id' => $shipping,
                'order_number' => $orderNumber,
                'isActive' => 1,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $orderId = DB::table('orders')->insertGetId($value);
            return response()->json(['status' => true, 'message' => 'Shipping Adddress has been succeessfully added', 'orderId' => $orderId]);
        }
    }

    function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'orderName' => 'required',
            'orderEmail' => 'required',
            'orderMobile' => 'required',
            'amount' => 'required'
        ]);

        $url = "https://sandbox.cashfree.com/pg/orders";

        $headers = array(
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_API_KEY'),
            "x-client-secret: " . env('CASHFREE_API_SECRET')
        );

        $data = json_encode([
            'order_id' =>  'order_' . rand(1111111111, 9999999999),
            'order_amount' => $validated['amount'],
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => 'customer_' . rand(111111111, 999999999),
                "customer_name" => $validated['orderName'],
                "customer_email" => $validated['orderEmail'],
                "customer_phone" => $validated['orderMobile'],
            ],
            "order_meta" => [
                "return_url" => 'http://127.0.0.1:8000/checkPayment/' . $request->orderId . '?order_id={order_id}&order_token={order_token}'
                // "return_url" => 'http://pritesh.levelupinstitute.co.in?order_id={order_id}&order_token={order_token}'
            ]
        ]);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);

        curl_close($curl);

        return redirect()->to(json_decode($resp)->payment_link);
        /* $userData = Session::get('userData');
        if ($request->has('orderId')) {
            // if ($request->type == 1) {
            //     $totalAmount = DB::table('carts')->where(
            //         [
            //             ['isActive', '=', 1],
            //             ['user_id', '=', $userData->id],
            //             ['shipping_id', '=', 0],
            //             ['status', '=', 0],
            //             ['payment_method', '=', null]
            //         ])->sum('total_amount');
            //     $orderData = DB::table('orders')->where([['id', '=', $request->orderId]])->first();

            //     DB::table('orders')
            //     ->where([['id', '=', $request->orderId]])
            //     ->update(['sub_total' => $totalAmount, 'total_amount' => ($totalAmount - $orderData->coupon), 'payment_method' => 'cod', 'payment_status' => 'paid', 'status' => 1]);

            //     DB::table('carts')->where(
            //         [
            //             ['isActive', '=', 1],
            //             ['user_id', '=', $userData->id],
            //             ['shipping_id', '=', 0],
            //             ['status', '=', 0],
            //             ['payment_method', '=', null]
            //         ])
            //     ->update(['orders_id' => $orderData->id, 'shipping_id' => $orderData->shipping_id, 'payment_method' => 'cod', 'status' => 1]);
            //     return response()->json(['status' => true, 'message' => 'Order has been successfully placed', 'url' => url('/my_order_history')]);
            // } else {

            // }
        } else {
            return response()->json(['status' => false, 'message' => 'Order cannot be completed, Please contact to admin']);
        } */
    }

    function hotDeals()
    {
        $featured = DB::table('product')
            ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug', 'product.price', 'product.old_price', 'product.save_price', 'product.catelogue_price', 'product.catelogue_pis', 'product.is_featured', 'product.is_new', 'product.discount', 'product.size_id')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->where([['product.isActive', '=', 1], ['product.is_hot_deal', '=', 1], ['product.status', '=', 2]])->limit(16)->orderBy('product.id', 'desc')->get();

        $userData = Session::get('userData');

        foreach ($featured as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id', explode(',', $value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id', '=', $userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id', '=', $value->id]])->orderBy('id', 'asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        return view('frontend.hot_deals')
            ->with('data', $featured);
    }

    function newArrivals()
    {
        $featured = DB::table('product')
            ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug', 'product.price', 'product.old_price', 'product.save_price', 'product.catelogue_price', 'product.catelogue_pis', 'product.is_featured', 'product.is_new', 'product.discount', 'product.size_id')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->where([['product.isActive', '=', 1], ['product.is_new', '=', 1], ['product.status', '=', 2]])->limit(16)->orderBy('product.id', 'desc')->get();

        $userData = Session::get('userData');

        foreach ($featured as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id', explode(',', $value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id', '=', $userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id', '=', $value->id]])->orderBy('id', 'asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        return view('frontend.new_arrivals')
            ->with('data', $featured);
    }

    function getSetting()
    {
        $data = DB::table('site_setting')->where([['id', '=', 1]])->first();
        return view('backend.setting')->with('data', $data);
    }

    function editSetting(Request $request)
    {
        DB::table('site_setting')
            ->where([['id', '=', 1]])
            ->update(['gst_no' => $request->gst_no, 'mobile' => $request->mobile, 'email' => $request->email, 'address' => $request->address]);

        return redirect('/admin/setting');
    }

    public function changepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirmpassword' => 'required|same:newpassword',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return back()->with('error', $errorMessage)->withInput();
        } else {
            $userData = Session::get('userData');
            $userData = DB::table('users')->where([['id', '=', $userData->id]])->first();
            if (Hash::check($request->oldpassword, $userData->password)) {
                DB::table('users')
                    ->where([['id', '=', $userData->id]])
                    ->update(['password' => Hash::make($request->newpassword)]);
                return back()->with('success', 'User password has been successfully updated');
            } else {
                return back()->with('error', 'Enter you current password is wrong')->withInput();
            }
        }
    }

    function forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return back()->with('error', $errorMessage)->withInput();
        } else {
            $userData = DB::table('users')->where([['email', '=', $request->email]])->first();
            $code = Str::random(10);
            $codeData = DB::table('users')->where([['forgot_code', '=', $code]])->get()->count();
            if ($codeData > 0) {
                $codeStatus = true;
                while ($codeStatus) {
                    $code = Str::random(10);
                    $codeData = DB::table('users')->where([['forgot_code', '=', $code]])->get()->count();
                    if ($codeData > 0) {
                        $codeStatus = false;
                    }
                }
            }
            if (!empty($userData)) {
                DB::table('users')
                    ->where([['id', '=', $userData->id]])
                    ->update(['forgot_code' => $code]);
                return redirect('/resetpassword');
            } else {
                return back()->with('error', 'Enter your email not found, Please register')->withInput();
            }
        }
    }

    function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'password' => 'required',
            'confirmpassword' => 'required|same:password',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return back()->with('error', $errorMessage)->withInput();
        } else {
            $userData = DB::table('users')->where([['forgot_code', '=', $request->code]])->first();
            if (empty($userData)) {
                return back()->with('error', 'Enter your code is not valid, Please try again')->withInput();
            } else {
                DB::table('users')
                    ->where([['id', '=', $userData->id]])
                    ->update(['password' => Hash::make($request->password), 'forgot_code' => '']);
                return redirect('/login');
            }
        }
    }
    public function checkPayment(Request $request)
    {
        // dd($request->get('order_id'));
        $url = "https://sandbox.cashfree.com/pg/orders/" . $request->get('order_id') . "/payments";

        $headers = array(
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_API_KEY'),
            "x-client-secret: " . env('CASHFREE_API_SECRET')
        );
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $resp = curl_exec($curl);

        curl_close($curl);


        $payment_json = json_decode($resp);
        // dd($request);
        if (json_decode($resp)[0]->payment_status == "FAILED") {
            return redirect()->route('home');
        } else {
            $userData = Session::get('userData');
            if ($request->orderNumber > 0) {
                // if ($request->type == 1) {
                $totalAmount = DB::table('carts')->where(
                    [
                        ['isActive', '=', 1],
                        ['user_id', '=', $userData->id],
                        ['shipping_id', '=', 0],
                        ['status', '=', 0],
                        ['payment_method', '=', null]
                    ]
                )->sum('total_amount');
                $orderData = DB::table('orders')->where([['id', '=', $request->orderNumber]])->first();

                DB::table('orders')
                    ->where([['id', '=', $request->orderNumber]])
                    ->update(['sub_total' => $totalAmount, 'total_amount' => ($totalAmount - $orderData->coupon), 'payment_method' => $payment_json[0]->payment_group, 'payment_status' => 'paid', 'status' => 1, 'payment_json' => $resp]);

                DB::table('carts')->where(
                    [
                        ['isActive', '=', 1],
                        ['user_id', '=', $userData->id],
                        ['shipping_id', '=', 0],
                        ['status', '=', 0],
                        ['payment_method', '=', null]
                    ]
                )
                    ->update(['orders_id' => $orderData->id, 'shipping_id' => $orderData->shipping_id, 'payment_method' => $payment_json[0]->payment_group, 'status' => 1]);

                $cartData = DB::table('carts')->where([['orders_id', '=', $orderData->id]])->first();
                $sizeData = DB::table('size_price')->where([['product_id', '=', $cartData->product_id], ['size_id', '=',  $cartData->size_id]])->first();


                DB::table('size_price')
                    ->where([['product_id', '=', $cartData->product_id], ['size_id', '=',  $cartData->size_id]])
                    ->update(['quantity' => $sizeData->quantity - $cartData->quantity]);


                    $orderNumber =  $orderData->order_number;

                    $data = DB::table('orders')
                        ->select('orders.id as orderId', 'orders.order_number', 'orders.sub_total', 'orders.coupon', 'orders.total_amount', 'orders.payment_method', 'orders.payment_status', 'orders.added_datetime', 'orders.user_id', 'shipping.name as shippingUserName', 'shipping.email as shippingUserEmail', 'shipping.mobile as shippingUserMobile', 'shipping.flat_no', 'shipping.address', 'shipping.country', 'shipping.state', 'shipping.city', 'shipping.pincode')
                        ->join('shipping', 'shipping.id', '=', 'orders.shipping_id')
                        ->where([['orders.order_number', '=', $orderNumber]])->get();
            
                    foreach ($data as $key => $value) {
                        $value->added_datetime = date('d-m-Y H:i A', strtotime($value->added_datetime));
                        $userData1 = DB::table('users')->where([['id', '=', $value->user_id]])->first();
                        $value->userName = $userData1->name;
                        $value->userEmail = $userData1->email;
                        $value->userMobile = $userData1->mobile;
            
                        $productData = DB::table('carts')
                            ->join('product', 'product.id', '=', 'carts.product_id')
                            ->select('carts.quantity', 'carts.price', 'carts.total_amount', 'product.name', 'carts.product_id')
                            ->where([['orders_id', '=', $value->orderId]])->get();
            
                        foreach ($productData as $key => $productValue) {
                            $img = DB::table('product_img')->where([['product_id', '=', $productValue->product_id]])->orderBy('id', 'asc')->first();
                            $productValue->mainImg = $img->image;
                        }
            
                        $value->productData = $productData;
                    }
                    $userdata2 = DB::table('shipping')->where([['id','=',$orderData->shipping_id]])->first();
                    $user['to']= $userdata2->email;
                    Mail::send('frontend.downloadInvoice', array('data' => $data[0]),function($message) use ($user){
                        $message->to($user['to']);
                        $message->subject('Order Placed SuccesFully');
                    });
                // return response()->json(['status' => true, 'message' => 'Order has been successfully placed', 'url' => url('/my_order_history')]);
                return redirect()->to('http://127.0.0.1:8000/orderDetails/' . $orderData->order_number);
                // } 
                // else {
                // }
            } else {
                return response()->json(['status' => false, 'message' => 'Order cannot be completed, Please contact to admin']);
            }
        }
    }

    public function addreview(Request $request){

        // dd($request->file('reviewImages'));
        $userData = Session::get('userData');
        $rate = $request->rate;
        $pid = $request->pid;
        $message = $request->message;

        $value = [
            'userid' => $userData->id,
            'star' => $rate,
            'product_id' => $pid,
            'message' => $message,
            'isactive' => 1,
            'added_datetime' => date('Y-m-d H:i:s'),
        ];

        $query = DB::table('user_review')->insertGetId($value);
        if ($query) { 
            foreach ($request->file('reviewImages') as $key => $images) {
                $imageName = 'image-' . time() . rand(1, 1000) . '.' . $images->extension();
                $images->move(public_path('product_review'), $imageName);

                $imageValue = [
                    'review_id' => $query,
                    'image' => "product_review/" . $imageName,
                    'added_datetime' => date('Y-m-d H:i:s'),
                ];

                DB::table('product_review')->insertGetId($imageValue);
            }
            return back()->with('success', 'Add review Successfully');
            $this->getreview();
        } else {
            return back()->with('error', 'Review can not be added');
        }
        
    }

    function contactus()
    {
        $featured = DB::table('site_setting')->where([['id', '=', 1]])->first();

        return view('frontend.contact_us')
            ->with('data', $featured);
    }
    
}
