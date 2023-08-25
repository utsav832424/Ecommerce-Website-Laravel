<?php

use App\Http\Controllers\backend\index as BackendIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fronted\index;
use App\Http\Controllers\backend\product;
use App\Http\Controllers\Category;
use App\Http\Controllers\Users;
use App\Http\Controllers\Inquiry;
use App\Http\Controllers\Order;
use FontLib\Table\Type\name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [index::class, 'home'])->name('home');

Route::get('/product', function () {
    return view('singal_product');
});
Route::get('/product/{slug}',[index::class, 'product_detail']);
Route::post('/sizeWiseProductDetail',[index::class, 'sizeWiseProductDetail']);
// Route::get('/change-password/{slug}',[index::class, 'change_password']);
Route::get('/sub-category/{slug}',[index::class, 'sub_category_product']);
Route::get('/contactus',[Users::class,'contactus']);
Route::get('/wishlist', function () {
    return view('frontend.wishlist');
})->middleware('userAuth');
Route::get('/aboutus', function () {
    return view('frontend.aboutus');
});
Route::get('/account_details', function () {
    return view('frontend.account_details');
})->middleware('userAuth');
Route::get('/my_address', function () {
    return view('frontend.my_address');
})->middleware('userAuth');
Route::get('/my_wishlist', [Users::class,'userWishList'])->middleware('userAuth');
Route::post('/removeToWishlist', [Users::class,'userRemoveWishList'])->middleware('userAuth');
Route::post('/changepassword', [Users::class,'changepassword'])->middleware('userAuth')->name('changepassword');
Route::post('/increaseCartProductQty', [Users::class,'increaseCartProductQty'])->middleware('userAuth');
Route::post('/decreaseCartProductQty', [Users::class,'decreaseCartProductQty'])->middleware('userAuth');
Route::post('/addShippingAddress', [Users::class,'addShippingAddress'])->middleware('userAuth')->name('addShipping');
Route::post('/removeCartProduct', [Users::class,'removeCartProduct'])->middleware('userAuth');
Route::post('/placeOrder', [Users::class,'placeOrder'])->middleware('userAuth');
Route::get('/checkPayment/{orderNumber}', [Users::class,'checkPayment'])->middleware('userAuth');
Route::get('/orderDetails/{orderNumber}', [Order::class,'userOrderDetails'])->middleware('userAuth');
Route::post('/addreview', [Users::class,'addreview'])->middleware('userAuth')->name('productReview');

Route::get('/downloadInvoice/{orderNumber}', [Order::class,'downloadInvoice'])->middleware('userAuth')->name('userInvoice');
Route::get('/trackshipment/{slug}',[Order::class, 'trackShipmentUser'])->middleware('userAuth')->name('usertrackshipment');
Route::post('/filterProduct', [product::class, 'filterProduct']);
Route::get('/view_cart', function () {
    return view('frontend.view_cart');
})->middleware('userAuth');
Route::get('/checkout', function () {
    return view('frontend.checkout');
})->middleware('userAuth');
Route::get('/my_order_history', function () {
    return view('frontend.my_order_history');
})->middleware('userAuth');
Route::get('/change_password', function () {
    return view('frontend.change_password');
})->middleware('userAuth');
Route::get('/offers', function () {
    return view('frontend.offers');
});
/* Route::get('/new_arrivals', function () {
    return view('frontend.new_arrivals');
}); */


Route::get('/all_product',[index::class, 'all_product']);
Route::get('/removeAllCartProduct',[Users::class, 'clearCartProduct'])->middleware('userAuth');
Route::get('/hot_deals',[Users::class, 'hotDeals']);
Route::get('/new_arrivals',[Users::class, 'newArrivals']);
Route::post('/fetchOrder', [Order::class, 'fetchorder'])->middleware('userAuth');
Route::get('/all_product/{field}/{value}', [index::class, 'filter_product']);
Route::post('/addinquiry', [Inquiry::class, 'saveinquiry'])->name('addinquiry');
Route::post('/addToWishlist', [Users::class, 'userProductAddToWishList'])->name('addToWishlist');
Route::post('/addToCard', [Users::class, 'addToCard'])->name('addToCard');
Route::post('/singalProductAddToCard', [Users::class, 'singalProductAddToCard']);
Route::get('/logout', [Users::class, 'logout'])->name('logout');
Route::get('/login', function () {
    if (Session()->has('userData')) {
        return redirect()->route('home');
    } else {
        return view('frontend.login');
    }
    
})->name('userLogin');
Route::get('/register', function () {
    return view('frontend.register');
});
Route::get('/forgot', function () {
    return view('frontend.forgot');
});
Route::post('/forgot', [Users::class,'forgot'])->name('forgot');
Route::get('/resetpassword', function () {
    return view('frontend.resetpassword');
});
Route::post('/resetpassword', [Users::class,'resetpassword'])->name('resetpassword');
Route::post('/addusers', [Users::class, 'saveusers'])->name('addUsers');
Route::post('/login', [Users::class, 'login'])->name('login');

Route::get('/admin-login', function() {
    if (Session()->has('adminData')) {
        return redirect()->route('dashboard');
    } else {
        return view('backend.login');
    }
})->name('admin-login');
Route::post('/admin-login',[Users::class,'loginSubmit'])->name('loginsubmit');
Route::group(['prefix'=>'/admin','middleware'=>['adminAuth']], function(){
    Route::get('/dashboard', [BackendIndex::class, 'home'])->name('dashboard');
    Route::get('/addProduct', [product::class, 'addProduct']);
    Route::post('/editProduct', [product::class, 'editProductData']);
    Route::get('/editProduct/{slug}', [product::class, 'editProduct']);
    Route::get('/categories', [product::class, 'categories']);
    Route::get('/sub_categories', [Category::class, 'subCategory']);
    Route::post('/addCategory', [Category::class, 'saveCategory'])->name('addCategory');
    Route::post('/addSubCategory', [Category::class, 'saveSubCategory'])->name('addSubCategory');
    Route::post('/updateCategory', [Category::class, 'updateCategory']);
    Route::post('/fetchCategory', [Category::class, 'fetchCategory']);
    Route::post('/fetchSubCategory', [Category::class, 'fetchSubCategory']);
    Route::post('/updateSubCategory', [Category::class, 'updateSubCategory']);
    Route::get('/fabric', function() {
        return view('backend.fabric');
    });
    Route::get('/inquiry', function() {
        return view('backend.inquiry_list');
    });
    Route::get('/users', function() {
        return view('backend.customer_list');
    });
    /* Route::get('/order', function() {
        return view('backend.order_list');
    }); */
    Route::get('/order', [Order::class, 'order']);
    Route::post('/sortOrder', [Order::class, 'sortOrder']);
    Route::get('/qty_adjustment', [product::class, 'qtyAdjustment']);
    Route::post('/qty_adjustment', [product::class, 'saveQtyAdjustment'])->name('qty_adjustment');
    Route::post('/adjust_qty', [product::class, 'adjust_qty'])->name('adjust_qty');
    Route::post('/fetchQty', [product::class, 'fetchQty']);
    Route::post('/fetchFabric', [Category::class, 'fetchFabric']);
    Route::post('/fetchinquiry', [Category::class, 'fetchinquiry']);
    Route::post('/fetchcustomer', [Category::class, 'fetchcustomer']);
    Route::post('/addFabric', [Category::class, 'saveFabric'])->name('addFabric');
    Route::post('/updateFabric', [Category::class, 'updateFabric']);
    Route::get('/color', function() {
        return view('backend.color');
    });
    Route::post('/addColor', [Category::class, 'saveColor'])->name('addColor');
    Route::post('/updateColor', [Category::class, 'updateColor']);
    Route::post('/deleteColorImg', [Category::class, 'deleteColorImg']);
    Route::post('/deleteAllColorImg', [Category::class, 'deleteAllColorImg']);
    Route::post('/fetchColor', [Category::class, 'fetchColor']);
    Route::get('/size', function() {
        return view('backend.size');
    });
   
    Route::get('/viewProduct/{slug}', [product::class, 'viewProduct']);
    Route::post('/addSize', [Category::class, 'saveSize'])->name('addSize');
    Route::post('/updateSize', [Category::class, 'updateSize']);
    Route::post('/fetchSize', [Category::class, 'fetchSize']);
    Route::post('/sizeStock', [product::class, 'sizeStock']);
    Route::post('/editSizeStock', [product::class, 'editSizeStock'])->name('editSizeStock');
    
    Route::post('/getSubCategoryByMainCategory', [product::class, 'getSubcategory']);
    
    Route::post('/addProduct', [product::class, 'saveProduct'])->name('addProduct');
    Route::get('/product', [product::class, 'product']);
    Route::post('/fetchProduct', [product::class, 'fetchProduct']);
    // Route::get('/ViewProduct/{id}', [product::class, 'viewProduct']);
    Route::get('/occasion', function() {
        return view('backend.occasion');
    });
    Route::post('/addOccasion', [Category::class, 'saveOccasion'])->name('addOccasion');
    Route::post('/updateOccasion', [Category::class, 'updateOccasion']);    
    Route::post('/fetchOccasion', [Category::class, 'fetchOccasion']);

    Route::get('/pattern', function() {
        return view('backend.pattern');
    });
    Route::post('/addPattern', [Category::class, 'savePattern'])->name('addPattern');
    Route::post('/updatePattern', [Category::class, 'updatePattern']);    
    Route::post('/fetchPattern', [Category::class, 'fetchPattern']);

    Route::get('/work', function() {
        return view('backend.work');
    });
    Route::post('/addWork', [Category::class, 'saveWork'])->name('addWork');
    Route::post('/updateWork', [Category::class, 'updateWork']);    
    Route::post('/fetchWork', [Category::class, 'fetchWork']);

    Route::get('/sleeve_type', function() {
        return view('backend.sleeve_type');
    });
    Route::post('/addSleeve', [Category::class, 'saveSleeve'])->name('addSleeve');
    Route::post('/updateSleeve', [Category::class, 'updateSleeve']);    
    Route::post('/fetchSleeve', [Category::class, 'fetchSleeve']);

    Route::get('/wash', function() {
        return view('backend.wash');
    });
    Route::post('/addWash', [Category::class, 'saveWash'])->name('addWash');
    Route::post('/updateWash', [Category::class, 'updateWash']);    
    Route::post('/fetchWash', [Category::class, 'fetchWash']);

    Route::get('/hook', function() {
        return view('backend.hook');
    });
    Route::post('/addHook', [Category::class, 'saveHook'])->name('addHook');
    Route::post('/updateHook', [Category::class, 'updateHook']);    
    Route::post('/fetchHook', [Category::class, 'fetchHook']);

    Route::get('/logout', [Users::class, 'adminLogout']);
    Route::get('/orderDetails/{orderNumber}', [Order::class, 'orderDetails']);
    Route::post('/fetchOrder', [Order::class,'fetchOrder']);
    Route::post('/changeOrderStatus', [Order::class,'changeOrderStatus']);
    Route::get('/fetchOrderDetails/{orderNumber}', [Order::class,'fetchOrderDetails']);
    Route::post('/shipment', [Order::class,'readyToShip']);

    Route::get('/downloadInvoice/{orderNumber}', [Order::class,'downloadInvoice']);
    Route::get('/setting', [Users::class, 'getSetting']);
    Route::post('/setting', [Users::class, 'editSetting'])->name('site_update');

    Route::get('/trackshipment/{slug}',[Order::class, 'trackShipment']);
      
    
});
Route::fallback(function () {
    return redirect()->route('home');
});