<?php

namespace App\Http\Controllers\fronted;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class index extends Controller
{
    //

    public function home() {
        $featured = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.is_featured', '=', 1],['product.status','=',2]])->limit(12)->orderBy('product.id', 'desc')->get();
        
        $latest = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();

        $kurti = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 3],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();

        $top = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 6],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();

        $tshirt = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 2],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();
        
        $salwarsuitandgown = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 5],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();
       
        $womenshorts = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 9],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();
       
        $sarees = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 7],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();
        
        $westernwear = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 9],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();
       
        $salwarkameez = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 4],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();

        $lehengacholi = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 8],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();
        
        $shirts = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 1],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();
        
        $womenlehengacholi = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', 8],['product.status','=',2]])->orderBy('id', 'desc')->limit(12)->get();

        $userData = Session::get('userData');
    
        foreach ($featured as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        
        foreach ($latest as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($top as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($kurti as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($tshirt as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($salwarsuitandgown as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($womenshorts as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($sarees as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        
        foreach ($westernwear as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($salwarkameez as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        
        foreach ($lehengacholi as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($shirts as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }

        foreach ($womenlehengacholi as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        // dd(Session::all());
        return view('frontend.index')
                ->with('latest',$latest)
                ->with('kurti',$kurti)
                ->with('top',$top)
                ->with('tshirt',$tshirt)
                ->with('womenshorts',$womenshorts)
                ->with('sarees',$sarees)
                ->with('salwarkameez',$salwarkameez)
                ->with('womenlehengacholi',$womenlehengacholi)
                ->with('shirts',$shirts)
                ->with('lehengacholi',$lehengacholi)
                ->with('westernwear',$westernwear)
                ->with('salwarsuitandgown',$salwarsuitandgown)
                ->with('featured',$featured);
    }
    
    function product_detail(Request $request){
        $featured = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id','product.specification','fabric.name as fabric_name', 'product.description','product.color_id', 'product.sub_category_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->join('fabric', 'fabric.id', '=', 'product.fabric_id')
        ->where([['product.isActive', '=', 1],['product.slug', '=', $request->slug]])->get(); 
        // ,['product.status','=',2]

        $userData = Session::get('userData');

        foreach ($featured as $key => $value) {
            $product_img = DB::table('product_img')
            ->select('product_img.image','color.name', 'product_img.color_id', 'product_img.product_id')
            ->join('color', 'color.id', '=', 'product_img.color_id')
            ->where([['product_img.product_id', '=', $value->id]])
            ->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $allImage = DB::table('product_img')->select('product_img.image','color.name')
            ->join('color', 'color.id', '=', 'product_img.color_id')->where([['product_id',$value->id]])->get();
            // $color = DB::table('color')->whereIn('id',explode(',',$value->color_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $value->img = $product_img;
            $value->size = $size;
            $value->price = $sizeDetail->price;
            $value->old_price = $sizeDetail->old_price;
            $value->quantity = $sizeDetail->quantity;
            $value->product_img = $allImage;
            $value->main_img = $product_img[0]->image;
        }
        $relatedProduct = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id','product.specification','fabric.name as fabric_name', 'product.description','product.color_id')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->join('fabric', 'fabric.id', '=', 'product.fabric_id')
        ->where([['product.isActive', '=', 1],['product.sub_category_id', '=', $featured[0]->sub_category_id],['product.id', '!=', $featured[0]->id]])->limit(12)->orderBy('product.id', 'desc')->get(); 
        
        // dd($featured[0]);
        // print_r($featured);
        foreach ($relatedProduct as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
        }
        
        $review = DB::table('user_review')
        ->select('user_review.*','users.name')
        ->join('users', 'users.id', '=', 'user_review.userid')
        ->where([['user_review.isActive', '=', 1],['user_review.product_id', '=', $featured[0]->id]])->orderBy('user_review.id', 'desc')->get(); 
        // $review[0]->added_datetime = date('d-m-Y', strtotime($review[0]->added_datetime));
        foreach ($review as $key => $value) {
            $reviewimage = DB::table('product_review')->where([['review_id', '=', $value->id]])->get();
            $value->added_datetime = date('d-m-Y', strtotime($value->added_datetime));
            $value->img = $reviewimage;
            // dd($review);
        }
       
        $review_star1 = DB::table('user_review')->where([['isActive','=',1],['star','=',1],['product_id','=', $featured[0]->id]])->get()->count();
        $review_star2 = DB::table('user_review')->where([['isActive','=',1],['star','=',2],['product_id','=', $featured[0]->id]])->get()->count();
        $review_star3 = DB::table('user_review')->where([['isActive','=',1],['star','=',3],['product_id','=', $featured[0]->id]])->get()->count();
        $review_star4 = DB::table('user_review')->where([['isActive','=',1],['star','=',4],['product_id','=', $featured[0]->id]])->get()->count();
        $review_star5 = DB::table('user_review')->where([['isActive','=',1],['star','=',5],['product_id','=', $featured[0]->id]])->get()->count();
        $totalreview_user = DB::table('user_review')->where([['isActive','=',1],['product_id','=', $featured[0]->id]])->get()->count();
        $totalreview = ($review_star5 * 5) + ($review_star4 * 4) +($review_star3 * 3) +($review_star2 * 2) +($review_star1 * 1);
       
        return view('frontend.singal_product')
                ->with('data',$featured[0])
                ->with('reletedData',$relatedProduct)
                ->with('review',$review)
                ->with('review_star1',$review_star1)
                ->with('review_star2',$review_star2)
                ->with('review_star3',$review_star3)
                ->with('review_star4',$review_star4)
                ->with('review_star5',$review_star5)
                ->with('totalreview_user',$totalreview_user)
                ->with('ceilreview',($totalreview_user > 0) ? Ceil($totalreview/$totalreview_user) : 0);
    }

    function filter_product(Request $request) {
        if ($request->field == "sub-category") {
            $featured = DB::table('product')
            ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id','product.specification','fabric.name as fabric_name', 'product.description')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->join('fabric', 'fabric.id', '=', 'product.fabric_id')
            ->where([['product.isActive', '=', 1],['sub_category.slug', '=', $request->value],['product.status','=',2]])->orderBy('product.id', 'desc')->limit(12)->get();
        } else if ($request->field == "category") {
            $featured = DB::table('product')
            ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id','product.specification','fabric.name as fabric_name', 'product.description')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->join('fabric', 'fabric.id', '=', 'product.fabric_id')
            ->where([['product.isActive', '=', 1],['category.slug', '=', $request->value],['product.status','=',2]])->orderBy('product.id', 'desc')->limit(12)->get();
        } else {
            $featured = DB::table('product')
            ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id','product.specification','fabric.name as fabric_name', 'product.description')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->join('fabric', 'fabric.id', '=', 'product.fabric_id')
            ->where([['product.isActive', '=', 1],['product.status','=',2]])->orderBy('product.id', 'desc')->limit(12)->get();
        }

        $userData = Session::get('userData');

        foreach ($featured as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        // dd($featured);
        // print_r($featured);
        $title = "";
        if ($request->field == "sub-category") {
            $category = DB::table('sub_category')->where([['slug', '=', $request->value]])->get();
            $title = $category[0]->name;
        } else if ($request->field == "category") {
            $category = DB::table('category')->where([['slug', '=', $request->value]])->get();
            $title = $category[0]->name;
        }

        return view('frontend.all_product')
                ->with('title', ($request->value == "") ? "ALL PRODUCTS" : $title)
                ->with('data',$featured);
    }

    function all_product(Request $request) {
        $featured = DB::table('product')
        ->select('sub_category.name as sub_catagory_name', 'sub_category.slug as sub_catagory_slug', 'category.name as category_name', 'product.id', 'product.name', 'product.slug','product.price','product.old_price','product.save_price','product.catelogue_price','product.catelogue_pis','product.is_featured','product.is_new','product.discount','product.size_id','product.specification','fabric.name as fabric_name', 'product.description')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->join('fabric', 'fabric.id', '=', 'product.fabric_id')
        ->where([['product.isActive', '=', 1],['product.status','=',2]])->orderBy('product.id', 'desc')->limit(12)->get();

        $userData = Session::get('userData');

        foreach ($featured as $key => $value) {
            $product_img = DB::table('product_img')->where([['product_id', '=', $value->id]])->groupBy('color_id')->get();
            $size = DB::table('size')->whereIn('id',explode(',',$value->size_id))->get();
            if (Session()->has('userData')) {
                $wishList = DB::table('wishlists')->where([['product_id', '=', $value->id], ['user_id','=',$userData->id]])->get();
                $value->wishProductStatus = ($wishList->count() > 0) ? true : false;
            } else {
                $value->wishProductStatus = false;
            }
            $sizeDetail = DB::table('size_price')->where([['product_id','=',$value->id]])->orderBy('id','asc')->first();
            $value->img = $product_img;
            $value->size = $size;
            $value->main_img = $product_img[0]->image;
            $value->price = (isset($sizeDetail->price)) ? $sizeDetail->price : 0;
            $value->old_price = (isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0;
            $value->save_price = ((isset($sizeDetail->old_price)) ? $sizeDetail->old_price : 0) - ((isset($sizeDetail->price)) ? $sizeDetail->price : 0);
        }
        // dd($featured);
        // print_r($featured);
        $title = "";
        if ($request->field == "sub-category") {
            $category = DB::table('sub_category')->where([['slug', '=', $request->value]])->get();
            $title = $category[0]->name;
        } else if ($request->field == "category") {
            $category = DB::table('category')->where([['slug', '=', $request->value]])->get();
            $title = $category[0]->name;
        }

        return view('frontend.all_product')
                ->with('title', "ALL PRODUCTS")
                ->with('data',$featured);
    }

    function sizeWiseProductDetail(Request $request) {

        $sizeDetail = DB::table('size_price')->where([['product_id','=',$request->pid], ['size_id','=',$request->sid]])->first();

        return response()->json(['status' => true, 'data' => $sizeDetail]);
    }
}
