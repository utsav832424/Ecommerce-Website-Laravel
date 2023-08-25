<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;
use Validator;

class Order extends Controller
{
    function fetchOrder(Request $request)
    {
        $query = DB::table('orders');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%")->orWhere('slug', 'LIKE', "{$request->search}%");
        }
        $allorders = $query->get();
        $ordersCount = $allorders->count();

        $query = DB::table('orders')
            ->select('orders.*', 'users.name',)
            ->join('users', 'users.id', '=', 'orders.user_id');
        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%")->orWhere('slug', 'LIKE', "{$request->search}%");
        }

        if (!empty($request->sort)) {
            $query->orderBy('orders.id', $request->sort);
        } else {
            $query->orderBy('orders.id', 'desc');
        }
        $query->offset($request->offset);
        $query->limit($request->limit);
        $orders = $query->get();

        return response()->json(['status' => true, 'data' => $orders, 'totalPage' => Ceil($ordersCount / $request->limit)]);
    }

    function orderDetails(Request $request)
    {
        $orderNumber = $request->orderNumber;

        $data = DB::table('orders')
            ->select('orders.id as orderId', 'orders.order_number', 'orders.sub_total', 'orders.coupon', 'orders.total_amount', 'orders.payment_method', 'orders.payment_status', 'orders.added_datetime', 'orders.user_id', 'shipping.name as shippingUserName', 'shipping.email as shippingUserEmail', 'shipping.mobile as shippingUserMobile', 'shipping.flat_no', 'shipping.address', 'shipping.country', 'shipping.state', 'shipping.city', 'shipping.pincode')
            ->join('shipping', 'shipping.id', '=', 'orders.shipping_id')
            ->where([['orders.order_number', '=', $orderNumber]])->get();

        foreach ($data as $key => $value) {
            $value->added_datetime = date('d-m-Y H:i A', strtotime($value->added_datetime));
            $userData = DB::table('users')->where([['id', '=', $value->user_id]])->first();
            $value->userName = $userData->name;
            $value->userEmail = $userData->email;
            $value->userMobile = $userData->mobile;

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

        // dd($data);

        return view('backend.orderDetails')
            ->with('data', $data[0]);
    }

    function userOrderDetails(Request $request)
    {
        $orderNumber = $request->orderNumber;

        $data = DB::table('orders')
            ->select('orders.id as orderId', 'orders.order_number','orders.awb_number', 'orders.sub_total', 'orders.coupon', 'orders.total_amount', 'orders.payment_method', 'orders.payment_status', 'orders.added_datetime', 'orders.user_id', 'shipping.name as shippingUserName', 'shipping.email as shippingUserEmail', 'shipping.mobile as shippingUserMobile', 'shipping.flat_no', 'shipping.address', 'shipping.country', 'shipping.state', 'shipping.city', 'shipping.pincode')
            ->join('shipping', 'shipping.id', '=', 'orders.shipping_id')
            ->where([['orders.order_number', '=', $orderNumber]])->get();

        foreach ($data as $key => $value) {
            $value->added_datetime = date('d-m-Y H:i A', strtotime($value->added_datetime));
            $userData = DB::table('users')->where([['id', '=', $value->user_id]])->first();
            $value->userName = $userData->name;
            $value->userEmail = $userData->email;
            $value->userMobile = $userData->mobile;

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

        // dd($data);

        return view('frontend.orderDetails')
            ->with('data', $data[0]);
    }

    function downloadInvoice(Request $request)
    {
        $orderNumber = $request->orderNumber;

        $data = DB::table('orders')
            ->select('orders.id as orderId', 'orders.order_number', 'orders.sub_total', 'orders.coupon', 'orders.total_amount', 'orders.payment_method', 'orders.payment_status', 'orders.added_datetime', 'orders.user_id', 'shipping.name as shippingUserName', 'shipping.email as shippingUserEmail', 'shipping.mobile as shippingUserMobile', 'shipping.flat_no', 'shipping.address', 'shipping.country', 'shipping.state', 'shipping.city', 'shipping.pincode')
            ->join('shipping', 'shipping.id', '=', 'orders.shipping_id')
            ->where([['orders.order_number', '=', $orderNumber]])->get();

        foreach ($data as $key => $value) {
            $value->added_datetime = date('d-m-Y H:i A', strtotime($value->added_datetime));
            $userData = DB::table('users')->where([['id', '=', $value->user_id]])->first();
            $value->userName = $userData->name;
            $value->userEmail = $userData->email;
            $value->userMobile = $userData->mobile;

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

        $pdf = PDF::loadView('frontend.downloadInvoice', array('data' => $data[0]))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return $pdf->download('invoice.pdf');
    }

    function order()
    {
        $holdQuery = DB::table('orders')
            ->where([['status', '=', 0]])->count();

        $holdDataQuery = DB::table('orders')
            ->where([['status', '=', 0]])->get();

        $pendingQuery = DB::table('orders')
            ->where([['status', '=', 1]])->count();

        $shipQuery = DB::table('orders')
            ->where([['status', '=', 2]])->count();

        return view('backend.order_list1')
            ->with('hold', $holdQuery)
            ->with('holdData', $holdDataQuery)
            ->with('pending', $pendingQuery)
            ->with('ship', $shipQuery);
    }

    function trackShipment(Request $request)
    {
        $awbNumber = $request->slug;

        $data = DB::table('orders')
            ->select('orders.id as orderId', 'orders.order_number','orders.awb_number', 'orders.sub_total', 'orders.coupon', 'orders.total_amount', 'orders.payment_method', 'orders.payment_status', 'orders.added_datetime', 'orders.user_id', 'shipping.name as shippingUserName', 'shipping.email as shippingUserEmail', 'shipping.mobile as shippingUserMobile', 'shipping.flat_no', 'shipping.address', 'shipping.country', 'shipping.state', 'shipping.city', 'shipping.pincode')
            ->join('shipping', 'shipping.id', '=', 'orders.shipping_id')
            ->where([['orders.awb_number', '=', $awbNumber]])->get();

        foreach ($data as $key => $value) {
            $value->added_datetime = date('d-m-Y H:i A', strtotime($value->added_datetime));
            // $userData = DB::table('users')->where([['id', '=', $value->user_id]])->first();
            // $value->userName = $userData->name;
            // $value->userEmail = $userData->email;
            // $value->userMobile = $userData->mobile;

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
        $data1 = DB::table('site_setting')->where([['id', '=',1]])->first();
        $curl = curl_init();
        // dd('https://shipment.xpressbees.com/api/shipments2/track/'.$request->slug.'');
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shipment.xpressbees.com/api/shipments2/track/'.$request->slug.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $data1->token,
            ),
        ));

        $response = curl_exec($curl);
        // dd(json_decode($response)->data->history);
        curl_close($curl);
        return view('backend.trackshipment')->with('shipment', json_decode($response))->with('data', $data[0]);
    }
    function trackShipmentUser(Request $request)
    {
        $awbNumber = $request->slug;

        $data = DB::table('orders')
            ->select('orders.id as orderId', 'orders.order_number','orders.awb_number', 'orders.sub_total', 'orders.coupon', 'orders.total_amount', 'orders.payment_method', 'orders.payment_status', 'orders.added_datetime', 'orders.user_id', 'shipping.name as shippingUserName', 'shipping.email as shippingUserEmail', 'shipping.mobile as shippingUserMobile', 'shipping.flat_no', 'shipping.address', 'shipping.country', 'shipping.state', 'shipping.city', 'shipping.pincode')
            ->join('shipping', 'shipping.id', '=', 'orders.shipping_id')
            ->where([['orders.awb_number', '=', $awbNumber]])->get();

        foreach ($data as $key => $value) {
            $value->added_datetime = date('d-m-Y H:i A', strtotime($value->added_datetime));
            // $userData = DB::table('users')->where([['id', '=', $value->user_id]])->first();
            // $value->userName = $userData->name;
            // $value->userEmail = $userData->email;
            // $value->userMobile = $userData->mobile;

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

        // dd($data);

        // return view('frontend.orderDetails')
        //     ->with('data', $data[0]);

        $data1 = DB::table('site_setting')->where([['id', '=',1]])->first();
        $curl = curl_init();
        // dd('https://shipment.xpressbees.com/api/shipments2/track/'.$request->slug.'');
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shipment.xpressbees.com/api/shipments2/track/'.$request->slug.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $data1->token,
            ),
        ));

        $response = curl_exec($curl);
        // dd(json_decode($response)->data->history);
        curl_close($curl);
        return view('frontend.trackusershipment')->with('shipment', json_decode($response))->with('data', $data[0]);
    }

    function sortOrder(Request $request)
    {
        $query = DB::table('orders AS o')
            ->select('o.id', 'o.order_number', 'o.total_amount', 'o.ship_label', 'o.manifest', 'o.awb_number', 'c.quantity', 'p.name', 'p.sku', 's.name as sizeName', 'cl.name as colorName', DB::raw('(SELECT image FROM product_img WHERE color_id = c.color_id AND product_id = c.product_id ORDER BY id asc limit 1)as image'), DB::raw('(SELECT color_sku FROM product_img WHERE color_id = c.color_id AND product_id = c.product_id ORDER BY id asc limit 1)as color_sku'))
            ->join('carts AS c', 'c.orders_id', '=', 'o.id')
            ->join('product AS p', 'p.id', '=', 'c.product_id')
            ->join('size AS s', 's.id', '=', 'c.size_id')
            ->join('color AS cl', 'cl.id', '=', 'c.color_id')
            ->where([['o.status', '=', $request->status], ['c.status', '=', 1]])->get();

        return response()->json(['status' => true, 'data' => $query]);
    }

    function changeOrderStatus(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'status' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $query = DB::table('orders')->where([['id', '=', $request->order_id]])->update(['status' => $request->status]);

            if ($query) {
                $order_data =  DB::table('orders')->where([['id', '=', $request->order_id]])->first();
                $shipping_data =  DB::table('shipping')->where([['user_id', '=', $order_data->user_id]])->first();
                $cart_data =  DB::table('carts')->where([['orders_id', '=', $order_data->id]])->get();
                $pickup_data = DB::table('site_setting')->get();
                $orderitems = [];
                $package_weight = 0;
                $package_length = 0;
                $package_breadth = 0;
                $package_height = 0;
                if ($request->status == 2) {
                    foreach ($cart_data as $key => $value) {
                        // dd(".$value->quantity.");
                        $product_data =  DB::table('product')->where([['id', '=', $value->product_id]])->first();
                        $orderitems[] = [
                            "name" => $product_data->name,
                            "qty" => $value->quantity,
                            "price" =>  $value->price,
                            "sku" =>  $product_data->sku
                        ];
                        $package_weight =  $package_weight + $product_data->package_weight;
                        $package_length =  $package_length + $product_data->package_length;
                        $package_breadth =  $package_breadth + $product_data->package_breadth;
                        $package_height =  $package_height + $product_data->package_height;
                    }
                    $courier_id = 1;
                    if ($package_weight <= 500) {
                        $courier_id = 1;
                    } else if ($package_weight > 500 && $package_weight <= 1000) {
                        $courier_id = 12298;
                    } else if ($package_weight > 1000 && $package_weight <= 2000) {
                        $courier_id = 2;
                    } else if ($package_weight > 2000 && $package_weight <= 5000) {
                        $courier_id = 3;
                    } else if ($package_weight > 5000 && $package_weight <= 10000) {
                        $courier_id = 4;
                    }
                    $shipmentData = [];
                    $shipmentData['order_number'] = $request->order_id;
                    $shipmentData['shipping_charges'] = 10;
                    $shipmentData['discount'] = $order_data->coupon;
                    $shipmentData['cod_charges'] = 10;
                    $shipmentData['payment_type'] = ($order_data->payment_method == 'cod' ? 'cod' : 'prepaid');
                    $shipmentData['order_amount'] = $order_data->total_amount;
                    $shipmentData['package_weight'] = $package_weight;
                    $shipmentData['package_length'] = $package_length;
                    $shipmentData['package_breadth'] = $package_breadth;
                    $shipmentData['package_height'] = $package_height;
                    $shipmentData['request_auto_pickup'] = "yes";
                    $shipmentData['consignee'] = [
                        'name' => $shipping_data->name,
                        'address' => $shipping_data->flat_no . ',' . $shipping_data->address,
                        'address_2' => '',
                        'city' => $shipping_data->city,
                        'state' => $shipping_data->state,
                        'pincode' => $shipping_data->pincode,
                        'phone' => $shipping_data->mobile,
                    ];
                    $shipmentData['pickup'] = [
                        'warehouse_name' => $pickup_data[0]->warehouse,
                        'name' => $pickup_data[0]->name,
                        'address' => $pickup_data[0]->address,
                        'address_2' => "",
                        'city' => $pickup_data[0]->city,
                        'state' => $pickup_data[0]->state,
                        'pincode' => $pickup_data[0]->pincode,
                        'phone' => $pickup_data[0]->mobile,
                    ];
                    $shipmentData['order_items'] = $orderitems;
                    $shipmentData['courier_id'] = $courier_id;
                    $shipmentData['collectable_amount'] = ($order_data->payment_method == "cod" ? $order_data->total_amount : 0);
    
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.xpressbees.com/api/shipments2',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode($shipmentData),
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Bearer ' . Session::get('adminData')->xpressbees_token,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    
                    DB::table('orders')->where([['id', '=', $request->order_id]])->update([
                        'xorder_id' => json_decode($response)->data->order_id,
                        'shipment_id' => json_decode($response)->data->shipment_id,
                        'awb_number' => json_decode($response)->data->awb_number,
                        'ship_label' => json_decode($response)->data->label,
                        'manifest' => json_decode($response)->data->manifest,
                    ]);
                    return response()->json(['status' => true, 'message' => 'The Orders are Accepted.']);
                } else if ($request->status == 3) {
                    return response()->json(['status' => true, 'message' => 'The Orders label print successfully.']);
                } else if ($request->status == 4) {
                    return response()->json(['status' => true, 'message' => 'The Orders has been cancelled successfully.']);
                }
                
            } else {
                return response()->json(['status' => false, 'message' => 'Product cannot be cancelled, please contact admin.']);
            }
        }
    }

    function readyToShip(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'courier_id' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        }
        //         else {
        //             $order_data =  DB::table('orders')->where([['id', '=', $request->order_id]])->first();
        //             $curl = curl_init();

        //             curl_setopt_array($curl, array(
        //                 CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/assign/awb',
        //                 CURLOPT_RETURNTRANSFER => true,
        //                 CURLOPT_ENCODING => '',
        //                 CURLOPT_MAXREDIRS => 10,
        //                 CURLOPT_TIMEOUT => 0,
        //                 CURLOPT_FOLLOWLOCATION => true,
        //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //                 CURLOPT_CUSTOMREQUEST => 'POST',
        //                 CURLOPT_POSTFIELDS => '{
        //             "shipment_id": "' . $order_data->shipment_id . '",
        //             "courier_id": "' . $request->courier_id . '"
        //         }',
        //                 CURLOPT_HTTPHEADER => array(
        //                     'Content-Type: application/json',
        //                     'Authorization: Bearer '.Session::get('adminData')->shiprocket_token
        //                 ),
        //             ));

        //             $response = curl_exec($curl);
        //             // dd(json_decode($response));

        //             curl_close($curl);

        //             $curl = curl_init();

        //             curl_setopt_array($curl, array(
        //                 CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/generate/pickup',
        //                 CURLOPT_RETURNTRANSFER => true,
        //                 CURLOPT_ENCODING => '',
        //                 CURLOPT_MAXREDIRS => 10,
        //                 CURLOPT_TIMEOUT => 0,
        //                 CURLOPT_FOLLOWLOCATION => true,
        //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //                 CURLOPT_CUSTOMREQUEST => 'POST',
        //                 CURLOPT_POSTFIELDS => '{
        // 	"shipment_id": ["' . $order_data->shipment_id . '"]

        // }',
        //                 CURLOPT_HTTPHEADER => array(
        //                     'Content-Type: application/json',
        //                     'Authorization: Bearer '.Session::get('adminData')->shiprocket_token
        //                 ),
        //             ));

        //             $response = curl_exec($curl);

        //             curl_close($curl);
        //             dd($response);
        //         }
    }
}
