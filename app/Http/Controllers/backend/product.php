<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Session;

class product extends Controller
{
    public function addProduct()
    {
        $category = DB::table('category')->where([['isActive', '=', 1]])->get();
        $color = DB::table('color')->where([['isActive', '=', 1]])->get();
        $fabric = DB::table('fabric')->where([['isActive', '=', 1]])->get();
        $size = DB::table('size')->where([['isActive', '=', 1]])->get();
        $occasion = DB::table('occasion')->where([['isActive', '=', 1]])->get();
        $pattern = DB::table('pattern')->where([['isActive', '=', 1]])->get();
        $work = DB::table('work')->where([['isActive', '=', 1]])->get();
        $sleeve_type = DB::table('sleeve_type')->where([['isActive', '=', 1]])->get();
        $wash = DB::table('wash')->where([['isActive', '=', 1]])->get();
        $hook = DB::table('hook')->where([['isActive', '=', 1]])->get();

        return view('backend.addProduct')
            ->with('category', $category)
            ->with('fabric', $fabric)
            ->with('size', $size)
            ->with('color', $color)
            ->with('occasion', $occasion)
            ->with('pattern', $pattern)
            ->with('work', $work)
            ->with('sleeve_type', $sleeve_type)
            ->with('wash', $wash)
            ->with('hook', $hook);
    }

    public function categories()
    {
        return view('backend.categories');
    }

    function getSubcategory(Request $request)
    {
        $subcategory = DB::table('sub_category')->where([['isActive', '=', 1], ['isDelete', '=', 0], ['category_id', '=',  $request->mainCategoryId]])->get();
        return response()->json(['status' => true, 'data' => $subcategory]);
    }

    function saveProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'fabric_id' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'occasion_id' => 'required',
            'pattern_id' => 'required',
            'work_id' => 'required',
            'sleeve_id' => 'required',
            'wash_id' => 'required',
            'hook_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'specification' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'old_price' => 'required',
            'catelogue_price' => 'required',
            'catelogue_pis' => 'required',
            'discount' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'is_new' => 'required',
            'is_hot_deal' => 'required',
            'savePrice' => 'required',
            '_token' => 'required',
            'package_weight' => 'required',
            'package_length' => 'required',
            'package_breadth' => 'required',
            'package_height' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $value = [
                'category_id' => $request->category_id,
                'sub_category_id' => $request->subcategory_id,
                'fabric_id' => $request->fabric_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'occasion_id' => $request->occasion_id,
                'pattern_id' => $request->pattern_id,
                'work_id' => $request->work_id,
                'sleeve_id' => $request->sleeve_id,
                'wash_id' => $request->wash_id,
                'hook_id' => $request->hook_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'sku' => $request->sku,
                'description' => $request->description,
                'specification' => $request->specification,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'save_price' => $request->savePrice,
                'catelogue_price' => $request->catelogue_price,
                'catelogue_pis' => $request->catelogue_pis,
                'is_featured' => $request->is_featured,
                'is_new' => $request->is_new,
                'is_hot_deal' => $request->is_hot_deal,
                'discount' => $request->discount,
                'status' => $request->status,
                'added_datetime' => date('Y-m-d H:i:s'),
                'package_weight' => $request->package_weight,
                'package_length' => $request->package_length,
                'package_breadth' => $request->package_breadth,
                'package_height' => $request->package_height,
            ];

            $query = DB::table('product')->insertGetId($value);

            $color = explode(',', $request->color_id);
            foreach ($color as $key => $value) {
                if ($request->has('colorImage_' . $value)) {
                    foreach ($request->file('colorImage_' . $value) as $key => $images) {
                        $imageName = 'image-' . time() . rand(1, 1000) . '.' . $images->extension();
                        $images->move(public_path('product_images'), $imageName);

                        $imageValue = [
                            'product_id' => $query,
                            'color_id' => $value,
                            'color_sku' => $request->input('colorSku_' . $value),
                            'image' => "product_images/" . $imageName,
                            'added_datetime' => date('Y-m-d H:i:s'),
                        ];

                        DB::table('product_img')->insertGetId($imageValue);
                    }
                }
            }
            $size = explode(',', $request->size_id);
            $sizeDetails = json_decode($request->sizeDetails, true);
            foreach ($size as $key => $value) {
                if (isset($sizeDetails[$value])) {
                    $sizeValue = [
                        'product_id' => $query,
                        'size_id' => $value,
                        'quantity' => $sizeDetails[$value]['quantity'],
                        'price' => $sizeDetails[$value]['newprice'],
                        'old_price' => $sizeDetails[$value]['oldprice'],
                        'isActive' => 1,
                        'added_datetime' => date('Y-m-d H:i:s'),
                    ];

                    DB::table('size_price')->insertGetId($sizeValue);
                }
            }

            if ($query > 0) {
                return response()->json(['status' => true, 'message' => 'Product has been succeessfully added ']);
            }
        }

        // return response()->json(['status' => false, 'message' => "Product has been successfully added"]);
    }

    function fetchProduct(Request $request)
    {
        $query = DB::table('product')
            ->select('product.id', 'product.name', 'product.slug', 'product.sku', 'product.isActive', 'category.name as category_name', 'sub_category.name as sub_category_name', 'quantity', 'price', 'catelogue_price', 'catelogue_pis', 'is_featured', 'is_new', 'product.added_datetime')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id');
        
        if (!empty($request->search)) {
            $query->orWhere('product.name', 'LIKE', "{$request->search}%");
        }

        if (!empty($request->category_id)) {
            $query->where([['product.category_id', '=', $request->category_id]]);
        }

        if (!empty($request->fabric_id)) {
            $query->where([['product.fabric_id', '=', $request->fabric_id]]);
        }

        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('product')
            ->select('product.id', 'product.name', 'product.slug', 'product.sku', 'product.isActive', 'category.name as category_name', 'sub_category.name as sub_category_name', 'price', 'catelogue_price', 'catelogue_pis', 'is_featured', 'is_new', 'product.added_datetime', DB::raw('(SELECT sum(quantity) FROM size_price WHERE product_id = product.id ORDER BY id asc limit 1)as quantity_size'), DB::raw('(SELECT sum(quantity)FROM carts WHERE product_id = product.id)as total_qty'),)
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id');

        if (!empty($request->search)) {
            $query->orWhere('product.name', 'LIKE', "{$request->search}%");
        }

        if (!empty($request->category_id)) {
            $query->where([['product.category_id', '=', $request->category_id]]);
        }

        if (!empty($request->fabric_id)) {
            $query->where([['product.fabric_id', '=', $request->fabric_id]]);
        }

        if (!empty($request->sort)) {
            $query->orderBy('product.id', $request->sort);
        }
        $query->offset($request->offset);
        $query->limit($request->limit);
        $category = $query->get();

        foreach ($category as $key => $value) {
            $sellProduct = DB::table('carts')->where([['product_id', '=', $value->id], ['status', '=', 1]])->get()->count();
            $value->sell = $sellProduct;
            $qty = DB::table('qty_adjustment')->select(DB::raw('sum(qty) as total'))->where([['product_id', '=', $value->id]])->first();
            $value->totalQty = $value->quantity_size;
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $value->main_img = $product_img[0]->image;
        }

        return response()->json(['status' => true, 'data' => $category, 'totalPage' => Ceil($categoryCount / $request->limit)]);
    }

    function product()
    {
        $category = DB::table('category')->where([['isActive', '=', 1]])->get();
        $fabric = DB::table('fabric')->where([['isActive', '=', 1]])->get();

        return view('backend.productList')
            ->with('category', $category)
            ->with('fabric', $fabric);
    }

    function editProduct(Request $request)
    {
        // dd($request->slug);
        $category = DB::table('category')->where([['isActive', '=', 1]])->get();
        $color = DB::table('color')->where([['isActive', '=', 1]])->get();
        $fabric = DB::table('fabric')->where([['isActive', '=', 1]])->get();
        $size = DB::table('size')->where([['isActive', '=', 1]])->get();
        $occasion = DB::table('occasion')->where([['isActive', '=', 1]])->get();
        $pattern = DB::table('pattern')->where([['isActive', '=', 1]])->get();
        $work = DB::table('work')->where([['isActive', '=', 1]])->get();
        $sleeve_type = DB::table('sleeve_type')->where([['isActive', '=', 1]])->get();
        $wash = DB::table('wash')->where([['isActive', '=', 1]])->get();
        $hook = DB::table('hook')->where([['isActive', '=', 1]])->get();

        $data = DB::table('product')->where([['slug', '=', $request->slug]])->first();
        $subCategory = DB::table('sub_category')->where([['category_id', '=', $data->category_id]])->get();

        $colorImg = DB::table('color')->whereIn('id', explode(',', $data->color_id))->get();
        $sizeData = DB::table('size_price')->select('size_price.*','size.name')->leftJoin('size', 'size.id', '=', 'size_price.size_id')->where([['product_id','=',$data->id]])->whereIn('size_id', explode(',', $data->size_id))->get();

        foreach ($colorImg as $key => $value) {
            $value->img = DB::table('product_img')->where([['color_id', '=', $value->id], ['product_id', '=', $data->id]])->orderBy('id', 'asc')->get();
        }

        return view('backend.editProduct')
            ->with('category', $category)
            ->with('fabric', $fabric)
            ->with('size', $size)
            ->with('sizeData', $sizeData)
            ->with('data', $data)
            ->with('subCategory', $subCategory)
            ->with('colorImg', $colorImg)
            ->with('color', $color)
            ->with('occasion', $occasion)
            ->with('pattern', $pattern)
            ->with('work', $work)
            ->with('sleeve_type', $sleeve_type)
            ->with('wash', $wash)
            ->with('hook', $hook);
    }

    function editProductData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'fabric_id' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'occasion_id' => 'required',
            'pattern_id' => 'required',
            'work_id' => 'required',
            'sleeve_id' => 'required',
            'wash_id' => 'required',
            'hook_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'specification' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'old_price' => 'required',
            'catelogue_price' => 'required',
            'catelogue_pis' => 'required',
            'discount' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'is_new' => 'required',
            'is_hot_deal' => 'required',
            'savePrice' => 'required',
            'package_weight' => 'required',
            'package_length' => 'required',
            'package_breadth' => 'required',
            'package_height' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $value = [
                'category_id' => $request->category_id,
                'sub_category_id' => $request->subcategory_id,
                'fabric_id' => $request->fabric_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'occasion_id' => $request->occasion_id,
                'pattern_id' => $request->pattern_id,
                'work_id' => $request->work_id,
                'sleeve_id' => $request->sleeve_id,
                'wash_id' => $request->wash_id,
                'hook_id' => $request->hook_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'sku' => $request->sku,
                'description' => $request->description,
                'specification' => $request->specification,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'save_price' => $request->savePrice,
                'catelogue_price' => $request->catelogue_price,
                'catelogue_pis' => $request->catelogue_pis,
                'is_featured' => $request->is_featured,
                'is_new' => $request->is_new,
                'is_hot_deal' => $request->is_hot_deal,
                'discount' => $request->discount,
                'status' => $request->status,
                'package_weight' => $request->package_weight,
                'package_length' => $request->package_length,
                'package_breadth' => $request->package_breadth,
                'package_height' => $request->package_height,
            ];

            $query = DB::table('product')->where([['id', '=', $request->productId]])->update($value);

            $query4 = '';
            $color = explode(',', $request->color_id);
            foreach ($color as $key => $value) {
                if ($request->has('colorImage_' . $value)) {
                    DB::table('product_img')->where([['product_id', '=', $request->productId], ['color_id', '=', $value]])->delete();
                    foreach ($request->file('colorImage_' . $value) as $key => $images) {
                        $imageName = 'image-' . time() . rand(1, 1000) . '.' . $images->extension();
                        $images->move(public_path('product_images'), $imageName);
                    //    dd($request->input('colorSku_' . $value));
                        $imageValue = [
                            'product_id' => $request->productId,
                            'color_id' => $value,
                            'color_sku' => $request->input('colorSku_' . $value),
                            'image' => "product_images/" . $imageName,
                            'added_datetime' => date('Y-m-d H:i:s'),
                        ];
                        // dd($imageValue);
                        $query4 = DB::table('product_img')->insertGetId($imageValue);
                        if (!$query && $query4) {
                            $query = $query4;
                        }
                    }
                }
            }

            $sizeDetails = json_decode($request->sizeDetails, true);
            $productSizeKey = [];
            $query1 = ''; 
            $query2 = '';
            foreach ($sizeDetails as $key => $value) {
                $getSizeCount = DB::table('size_price')->where([['product_id', '=', $request->productId], ['size_id', '=', $key]])->get()->count();
                $productSizeKey[] = $key;
                if ($getSizeCount > 0) {
                    if (isset($value)) {
                        $sizeValue = [
                            'quantity' => $value['quantity'],
                            'price' => $value['newprice'],
                            'old_price' => $value['oldprice'],
                        ];
                        $query1 = DB::table('size_price')->where([['product_id', '=', $request->productId], ['size_id', '=', $key]])->update($sizeValue);
                        if (!$query && $query1) {
                            $query = $query1;
                        }
                    }
                } else {
                    $sizeValue = [
                        'product_id' => $request->productId,
                        'quantity' => $value['quantity'],
                        'price' => $value['newprice'],
                        'old_price' => $value['oldprice'],
                        'size_id' => $key
                    ];
                    
                    $query2 = DB::table('size_price')->insertGetId($sizeValue);
                    if (!$query && $query2) {
                        $query = $query2;
                    }
                }
            }

            $query3 = DB::table('size_price')->whereNotIn('size_id', $productSizeKey)->update(['quantity' => 0, 'price' => 0, 'old_price' => 0,'isActive'=> 0]);
            if (!$query && $query3) {
                $query = $query3;
            }
            // dd($query, $query1, $query2, $query3);
            if ($query) {
                return response()->json(['status' => true, 'message' => 'Product has been succeessfully updated']);
            }
        }
    }

    function qtyAdjustment()
    {
        $productData = DB::table('product')->where([['isActive', '=', 1]])->get();
        return view('backend.qty_adjustment')->with('data', $productData);
    }

    function saveQtyAdjustment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            $value = [
                'product_id' => $request->product_id,
                'qty' => $request->quantity,
                'added_datetime' => date('Y-m-d H:i:s'),
            ];

            $query = DB::table('qty_adjustment')->insert($value);

            if ($query) {
                return response()->json(['status' => true, 'message' => 'Product has been succeessfully added ']);
            }
        }
        return response()->json(['status' => true, 'Product quantity has been successfully added']);
    }

    function fetchQty(Request $request)
    {
        $query = DB::table('qty_adjustment');

        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }

        if ($request->has('productId')) {
            $query->where([['product_id', '=', $request->productId]]);
        }
        $allCategory = $query->get();
        $categoryCount = $allCategory->count();

        $query = DB::table('qty_adjustment')->select('qty_adjustment.*', 'product.name')->join('product', 'product.id', '=', 'qty_adjustment.product_id');
        if (!empty($request->search)) {
            $query->orWhere('name', 'LIKE', "{$request->search}%");
        }

        if ($request->has('productId')) {
            $query->where([['product_id', '=', $request->productId]]);
        }

        if (!empty($request->sort)) {
            $query->orderBy('id', $request->sort);
        }
        $query->offset($request->offset);
        $query->limit($request->limit);
        $category = $query->get();

        return response()->json(['status' => true, 'data' => $category, 'totalPage' => Ceil($categoryCount / $request->limit)]);
    }

    function viewProduct(Request $request)
    {
        // dd($request->slug);
        $category = DB::table('category')->where([['isActive', '=', 1]])->get();
        $color = DB::table('color')->where([['isActive', '=', 1]])->get();
        $fabric = DB::table('fabric')->where([['isActive', '=', 1]])->get();
        $size = DB::table('size')->where([['isActive', '=', 1]])->get();
        $occasion = DB::table('occasion')->where([['isActive', '=', 1]])->get();
        $pattern = DB::table('pattern')->where([['isActive', '=', 1]])->get();
        $work = DB::table('work')->where([['isActive', '=', 1]])->get();
        $sleeve_type = DB::table('sleeve_type')->where([['isActive', '=', 1]])->get();
        $wash = DB::table('wash')->where([['isActive', '=', 1]])->get();
        $hook = DB::table('hook')->where([['isActive', '=', 1]])->get();

        $data = DB::table('product')->where([['slug', '=', $request->slug]])->first();
        $subCategory = DB::table('sub_category')->where([['category_id', '=', $data->category_id]])->get();

        $colorImg = DB::table('color')->whereIn('id', explode(',', $data->color_id))->get();
        $sizeData = DB::table('size_price')->select('size_price.*','size.name')->leftJoin('size', 'size.id', '=', 'size_price.size_id')->where([['product_id','=',$data->id]])->whereIn('size_id', explode(',', $data->size_id))->get();

        foreach ($colorImg as $key => $value) {
            $value->img = DB::table('product_img')->where([['color_id', '=', $value->id], ['product_id', '=', $data->id]])->orderBy('id', 'asc')->get();
        }

        return view('backend.viewProduct')
            ->with('category', $category)
            ->with('fabric', $fabric)
            ->with('size', $size)
            ->with('data', $data)
            ->with('subCategory', $subCategory)
            ->with('colorImg', $colorImg)
            ->with('color', $color)
            ->with('sizeData', $sizeData)
            ->with('occasion', $occasion)
            ->with('pattern', $pattern)
            ->with('work', $work)
            ->with('sleeve_type', $sleeve_type)
            ->with('wash', $wash)
            ->with('hook', $hook);
    }

    function filterProduct(Request $request)
    {

        $query = DB::table('product')
            ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug', 'product.price', 'product.old_price', 'product.save_price', 'product.catelogue_price', 'product.catelogue_pis', 'product.is_featured', 'product.is_new', 'product.discount', 'product.size_id', 'product.specification', 'fabric.name as fabric_name', 'product.description')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->join('fabric', 'fabric.id', '=', 'product.fabric_id')
            ->where([['product.isActive', '=', 1], ['product.status', '=', 2]])->orderBy('product.id', 'desc');


        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where([['product.price', '>=', $request->min_price]]);
        }

        if ($request->has('is_new') && !empty($request->is_new)) {
            $query->where([['product.is_new', '=', 1]]);
        }

        if ($request->has('is_hot_deal') && !empty($request->is_hot_deal)) {
            $query->where([['product.is_hot_deal', '=', 1]]);
        }

        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where([['product.price', '<=', $request->max_price]]);
        }

        if ($request->has('subCategory') && !empty($request->subCategory)) {
            $query->whereIn('product.sub_category_id', explode(',', $request->subCategory));
        }

        if ($request->has('fabric') && !empty($request->fabric)) {
            $query->whereIn('product.fabric_id', explode(',', $request->fabric));
        }

        if ($request->has('fabric') && !empty($request->fabric)) {
            $query->whereIn('product.fabric_id', explode(',', $request->fabric));
        }

        if ($request->has('color') && !empty($request->color)) {
            foreach (explode(",", $request->color) as $key => $value) {
                $query->whereRaw("FIND_IN_SET(" . $value . ", product.color_id)");
            }
        }

        if ($request->has('size') && !empty($request->size)) {
            foreach (explode(",", $request->size) as $key => $value) {
                $query->whereRaw("FIND_IN_SET(" . $value . ", product.size_id)");
            }
        }

        if ($request->has('offset') && !empty($request->offset)) {
            $query->skip($request->offset)->take($request->limit);
        } else {
            $query->take(12);
        }

        $featured = $query->get();
        //    dd($featured);
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

        return response()->json(['status' => true, 'data' => $featured]);
    }

    function adjust_qty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pid' => 'required',
            'qty' => 'required',
            'oldqty' => 'required',
            '_token' => 'required',
        ]);

        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
        }
    }

    function sizeStock(Request $request)
    {
        $sizeStock = DB::table('size_price')
            ->select('size_price.*', 'size.name', DB::raw('(SELECT ifnull(sum(quantity),0) FROM carts WHERE product_id = size_price.product_id and size_id = size_price.size_id)as totsize_quantity'))
            ->join('size', 'size.id', '=', 'size_price.size_id')
            ->where([['product_id', '=', $request->pid],['size_price.isActive', '=', 1]])->get();
        return response()->json(['status' => true, 'data' => $sizeStock]);
    }

    function editSizeStock(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'quantity' => 'sizeDetails',
            'price' => 'sizeDetails',
            'old_price' => 'sizeDetails',
        ]);
        if (!$validator->passes()) {
            $errorMessage = "";
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errorMessage = $value[0];
                break;
            }
            return response()->json(['status' => false, 'message' => $errorMessage]);
        } else {
            // $query = DB::table('size_price')->where([['product_id', '=', $request->product_id]]);
            $sizeDetails = json_decode($request->sizeDetails, true);
            foreach ($sizeDetails as $key => $value) {
                $getSizeCount = DB::table('size_price')->where([['product_id', '=', $request->product_id], ['size_id', '=', $key]])->get()->count();
                if ($getSizeCount > 0) {
                    if (isset($value)) {
                        $sizeValue = [
                            'quantity' => $value['quantity'],
                            'price' => $value['price'],
                            'old_price' => $value['old_price'],
                        ];
                        DB::table('size_price')->where([['product_id', '=', $request->product_id], ['size_id', '=', $key]])->update($sizeValue);
                    }
                } else {
                    $sizeValue = [
                        'product_id' => $request->product_id,
                        'quantity' => $value['quantity'],
                        'price' => $value['price'],
                        'old_price' => $value['old_price'],
                        'size_id' => $key
                    ];
                    DB::table('size_price')->insertGetId($sizeValue);
                }
            }

            return response()->json(['status' => true, 'message' => 'Size Price has been succeessfully updated']);
        }
    }
}
