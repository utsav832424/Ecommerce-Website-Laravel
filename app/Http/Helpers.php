<?php
use Illuminate\Support\Facades\DB;

class Helper {

    public static function getAllActiveCategory(){
        $category = DB::table('category')->where([['isActive', '=', 1]])->get();

        foreach ($category as $key => $value) {
            $subcategory = DB::table('sub_category')->where([['isActive', '=', 1],['isDelete', '=', 0],['category_id','=',$value->id]])->get();
            $subcategorycount = $subcategory->count();
            if ($subcategorycount > 0) {
                ?>
            <li>
                <a href="/all_product/category/<?= $value->slug;?>" title="<?= $value->name; ?>"><?= $value->name; ?></a>
                <ul class="nav-level-3">
                    <?php
                    foreach ($subcategory as $subkey => $subvalue) {
                        ?>
                        <li><a href="/all_product/sub-category/<?= $subvalue->slug;?>" title="<?= $subvalue->name; ?>"><?= $subvalue->name; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <?php
            } else {
                ?>
            <li>
                <a href="/all_product/category/<?= $value->slug;?>" title="<?= $value->name; ?>"><?= $value->name; ?></a>
            </li>
            <?php
            }
        }
    }

    public static function getCategory() {
        $category = DB::table('category')->where([['isActive', '=', 1]])->get();
        return $category;
    }

    public static function getSubCategory() {
        $subcategory = DB::table('sub_category')->where([['isActive', '=', 1]])->get();
        return $subcategory;
    }

    public static function getFabric() {
        return DB::table('fabric')->where([['isActive', '=', 1]])->get();
    }

    public static function getColor() {
        return DB::table('color')->where([['isActive', '=', 1]])->get();
    }

    public static function getSize() {
        return DB::table('size')->where([['isActive', '=', 1]])->get();
    }

    public static function getNumberCartProduct() {
        if (Session()->has('userData')) {
            $userData = Session::get('userData');
            return DB::table('carts')->where(
                [
                    ['isActive', '=', 1],
                    ['user_id', '=', $userData->id],
                    ['shipping_id', '=', 0],
                    ['status', '=', 0],
                    ['payment_method', '=', null]
                ])->get()->count();
        }
        return 0;
    }

    public static function getCartProductAmount() {
        if (Session()->has('userData')) {
            $userData = Session::get('userData');
            return DB::table('carts')->where(
                [
                    ['isActive', '=', 1],
                    ['user_id', '=', $userData->id],
                    ['shipping_id', '=', 0],
                    ['status', '=', 0],
                    ['payment_method', '=', null]
                ])->sum('total_amount');
        }
        return 0;
    }

    public static function getCartProduct() {
        if (Session()->has('userData')) {
            $userData = Session::get('userData');
            $cartData = DB::table('carts')
            ->select('carts.id', 'carts.quantity', 'carts.amount', 'carts.total_amount', 'product.name', 'product.slug', 'product.slug', 'size.name as size_name', 'color.name as color_name', 'carts.product_id', 'carts.color_id')
            ->join('product', 'product.id', '=', 'carts.product_id')
            ->join('size', 'size.id', '=', 'carts.size_id')
            ->join('color', 'color.id', '=', 'carts.color_id')
            ->where(
                [
                    ['carts.isActive', '=', 1],
                    ['user_id', '=', $userData->id],
                    ['shipping_id', '=', 0],
                    ['carts.status', '=', 0],
                    ['payment_method', '=', null]
                ])->orderBy('carts.id', 'desc')->get();

            foreach ($cartData as $key => $value) {
                $productImg = DB::table('product_img')->where([['product_id', '=', $value->product_id],['color_id', '=', $value->color_id]])->orderBy('id', 'asc')->first();
                ?>
                <div class="minicart-prd minicart-prd-<?= $value->id; ?>">
                    <div class="minicart-prd-image">
                        <a href="/product/<?= $value->slug; ?>">
                            <img src="<?= $productImg->image; ?>" data-srcset="<?= $productImg->image; ?>" class=" lazyloaded" alt="" srcset="<?= $productImg->image; ?>">
                        </a>
                    </div>
                    <div class="minicart-prd-name">
                        <h5><a href="/product/<?= $value->slug; ?>"><?= $value->name; ?></a></h5>
                        <h4>Color : <b><?= $value->color_name; ?></b> / Size : <b><?= $value->size_name; ?></b></h4>                                                
                    </div>
                    <div class="minicart-prd-qty">
                        <div class="qty qty-changer">
                            <fieldset>
                                <span>qty: </span> 
                                <input type="text" class="qty-input" value="1" name="qty" data-min="1" readonly=""> 
                            </fieldset>
                        </div>
                    </div>
                    <div class="minicart-prd-price"><span>Price:</span> <b>₹ <?= $value->amount; ?></b></div>
                    <div class="minicart-prd-price"><span>Subtotal:</span> <b>₹ <?= $value->total_amount; ?></b></div>
                    <div class="minicart-prd-action" style="width: 20px;">
                        <a href="javascript:void(0);" class="icon-cross" data-oid="<?= $value->id; ?>"></a>
                    </div>
                </div>
                <?php
            }
        }
    }

    public static function getShoppingCartProduct() {
        if (Session()->has('userData')) {
            $userData = Session::get('userData');
            $cartData = DB::table('carts')
            ->select('carts.id', 'carts.quantity', 'carts.price as orderPrice', 'carts.amount', 'carts.total_amount', 'product.name', 'product.slug', 'product.slug', 'size.name as size_name', 'color.name as color_name', 'carts.product_id', 'carts.color_id')
            ->join('product', 'product.id', '=', 'carts.product_id')
            ->join('size', 'size.id', '=', 'carts.size_id')
            ->join('color', 'color.id', '=', 'carts.color_id')
            ->where(
                [
                    ['carts.isActive', '=', 1],
                    ['user_id', '=', $userData->id],
                    ['shipping_id', '=', 0],
                    ['carts.status', '=', 0],
                    ['payment_method', '=', null]
                ])->orderBy('carts.id', 'desc')->get();

            foreach ($cartData as $key => $value) {
                $productImg = DB::table('product_img')->where([['product_id', '=', $value->product_id],['color_id', '=', $value->color_id]])->orderBy('id', 'asc')->first();
                ?>
                <div class="cart-table-prd cart-table-prd-<?= $value->id; ?>">
                    <div class="cart-table-prd-image">
                        <img src="<?= $productImg->image; ?>" alt="">
                    </div>
                    <div class="cart-table-prd-name">
                        <h3><?= $value->name; ?></h3>
                        <h4>Color : <b><?= $value->color_name; ?></b> / Size : <b><?= $value->size_name; ?></b></h4>
                    </div>
                    
                    <div class="cart-table-prd-qty">
                        <div class="qty qty-changer">
                            <fieldset>
                                <span>qty: </span>
                                <input type="button" value="‒" data="1" class="decrease" data-oid="<?= $value->id; ?>"> 
                                <input type="number" style="width: 42px;text-align: center;border:0;font-size: 12px;" class="qty-input" value="<?= $value->quantity; ?>" name="qty" min="1" data-oid="<?= $value->id; ?>">
                                <input type="button" value="+" data="1" class="increase" data-oid="<?= $value->id; ?>">
                            </fieldset>
                        </div>
                    </div>
                    <div class="cart-table-prd-price"><span>price:</span> <b>₹ <?= $value->orderPrice; ?></b></div>
                    <div class="cart-table-prd-price"><span>Subtotal:</span> <b>₹ <span class="subTotal"><?= $value->total_amount; ?></span></b></div>
                    <div class="cart-table-prd-action">
                        <a href="javascript:void(0);" class="icon-cross" data-oid="<?= $value->id; ?>"></a>
                    </div>
                </div>
                <?php
            }
        }
    }

    public static function getCheckoutProduct() {
        if (Session()->has('userData')) {
            $userData = Session::get('userData');
            $cartData = DB::table('carts')
            ->select('carts.id', 'carts.quantity', 'carts.price as orderPrice', 'carts.amount', 'carts.total_amount', 'product.name', 'product.slug', 'product.slug', 'size.name as size_name', 'color.name as color_name', 'carts.product_id', 'carts.color_id')
            ->join('product', 'product.id', '=', 'carts.product_id')
            ->join('size', 'size.id', '=', 'carts.size_id')
            ->join('color', 'color.id', '=', 'carts.color_id')
            ->where(
                [
                    ['carts.isActive', '=', 1],
                    ['user_id', '=', $userData->id],
                    ['shipping_id', '=', 0],
                    ['carts.status', '=', 0],
                    ['payment_method', '=', null]
                ])->orderBy('carts.id', 'desc')->get();

            foreach ($cartData as $key => $value) {
                $productImg = DB::table('product_img')->where([['product_id', '=', $value->product_id],['color_id', '=', $value->color_id]])->orderBy('id', 'asc')->first();
                ?>
                <div class="cart-table-prd">
                    <div class="cart-table-prd-image">
                        <a href="#"><img src="<?= $productImg->image; ?>" alt=""></a>
                    </div>
                    <div class="cart-table-prd-name">
                        <h2><a href="/product/<?= $value->slug; ?>"><?= $value->name; ?></a></h2>
                    </div>
                    <div class="cart-table-prd-qty"><b><?= $value->quantity; ?></b></div>
                    <div class="cart-table-prd-price"><b>₹ <?= $value->orderPrice; ?></b></div>
                </div>
                <?php
            }
        }
    }

    public static function getUserShippingAddress() {
        $userData = Session::get('userData');
        $shippingData = DB::table('shipping')->where([['user_id', '=', $userData->id]])->get();

        foreach ($shippingData as $key => $value) {
        ?>
            <div class="form-group">
                <div class="product-radio">
                    <input type="radio" style="display: none;" class="addr" data-shippingId="<?= $value->id; ?>" id="ad<?= $value->id; ?>" name="type" value="<?= $value->id; ?>" <?= ($key == 1) ? "checked" : ""; ?>>
                    <label for="ad<?= $value->id; ?>">
                        Name: <?= $value->name; ?><br>
                        Email: <?= $value->email;?><br>
                        Mobile: <?= $value->mobile;?><br>
                        Address: <?= $value->flat_no.$value->address.', '.$value->city.', '.$value->state.', '.$value->country.'. '.$value->pincode;?><br>
                    </label>
                </div>
            </div>
        <?php
        }
    }

    public static function getSiteData($field) {
        $data = DB::table('site_setting')->where([['id','=',1]])->first();

        return $data->$field;
    }
}
?>