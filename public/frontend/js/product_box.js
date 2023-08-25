$(function() {
    // var status = true;
    $('.js-label-wishlist').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).attr('data');
        var $this = $(this);
        $.ajax({
            url: `/addToWishlist`,
            method: 'post',
            data: {
                _token: _token,
                pid: product_id
            },
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    toastr.success(res.message);
                    $this.toggleClass('active');
                } else {
                    toastr.error(res.message);
                    if (res.redirect) {
                        setTimeout(() => {
                            window.location.href = res.url;
                        }, 2000);
                    }
                }
            }
        });
    });

    $('.delete-from-wishlist').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).data('productid');
        var $this = $(this);
        
        $.ajax({
            url: `/removeToWishlist`,
            method: 'post',
            data: {
                _token: _token,
                pid: product_id
            },
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    toastr.success(res.message);
                    $this.closest('.cart-table-prd').remove();
                } else {
                    toastr.error(res.message);
                    if (res.redirect) {
                        setTimeout(() => {
                            window.location.href = res.url;
                        }, 2000);
                    }
                }
            }
        });
    });

    $('.addtocart').on('click', function(){
        var productId = $(this).closest('.prd-inside').find('.color-swatch .active a').attr('pid');
        var colorId = $(this).closest('.prd-inside').find('.color-swatch .active a').attr('cid');
        var sizeId = $(this).closest('.prd-inside').find('.size-list .active a').data('value');
        if (sizeId == undefined) {
            toastr.error("Please select product size");
        } else {
            $.ajax({
                url: `/addToCard`,
                method: 'post',
                data: {
                    _token: _token,
                    pid: productId,
                    cid: colorId,
                    sid: sizeId,
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        window.location.reload();
                    } else {
                        if (res.url) {
                            window.location.href = res.url;
                        } else {
                            toastr.error(res.message);
                        }
                    }
                }
            });
        }
    });

    $('.product-listing').on('click', '.newaddtocart', function(){
        var productId = $(this).closest('.prd-inside').find('.color-swatch .active a').attr('pid');
        var colorId = $(this).closest('.prd-inside').find('.color-swatch .active a').attr('cid');
        var sizeId = $(this).closest('.prd-inside').find('.size-list .active a').data('value');
        if (sizeId == undefined) {
            toastr.error("Please select product size");
        } else {
            $.ajax({
                url: `/addToCard`,
                method: 'post',
                data: {
                    _token: _token,
                    pid: productId,
                    cid: colorId,
                    sid: sizeId,
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        window.location.reload();
                    } else {
                        if (res.url) {
                            window.location.href = res.url;
                        } else {
                            toastr.error(res.message);
                        }
                    }
                }
            });
        }
    });

    $('.cart-table-prd-action, .minicart-prd-action').on('click', '.icon-cross', function() {
        $this = $(this);
        var orderId = $(this).data('oid');
        $.ajax({
            url: `/removeCartProduct`,
            method: 'post',
            data: {
                _token: _token,
                oid: $(this).data('oid'),
            },
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    toastr.success(res.message);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });

    $('.increase').on('click', function() {
        var orderId = $(this).data('oid');
        $.ajax({
            url: `/increaseCartProductQty`,
            method: 'post',
            data: {
                _token: _token,
                oid: orderId,
            },
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    $('.card-total-price #ftotal').text(res.total_amount);
                    $('.minicart-total').text(res.total_amount);
                    $(`.cart-table-prd-${orderId} .cart-table-prd-price .subTotal`).text(res.data.amount);
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });

    $('.decrease').on('click', function() {
        var orderId = $(this).data('oid');
        $.ajax({
            url: `/decreaseCartProductQty`,
            method: 'post',
            data: {
                _token: _token,
                oid: orderId,
            },
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    $('.card-total-price #ftotal').text(res.total_amount);
                    $('.minicart-total').text(res.total_amount);
                    // $('.cart-table-prd-price .subTotal').text(res.data.amount);
                    $(`.cart-table-prd-${orderId} .cart-table-prd-price .subTotal`).text(res.data.amount);
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });

    $('#AddShippingAddress').on('click', function() {
        var type = $('input[type="radio"][name="type"]:checked').val().trim();
        if (type == 0) {
            var fullname = $('#fullname').val().trim();
            var email = $('#email').val().trim();
            var mobile = $('#mobile').val().trim();
            var flat_no = $('#flat_no').val().trim();
            var address = $('#address').val().trim();
            var country = $('#country').val().trim();
            var state = $('#state').val().trim();
            var city = $('#city').val().trim();
            var pincode = $('#pincode').val().trim();
    
            if (fullname == "") {
                toastr.error('Please enter fullname');
            } else if (email == "") {
                toastr.error('Please enter email');
            } else if (mobile == "") {
                toastr.error('Please enter mobile number');
            } else if (flat_no == "") {
                toastr.error('Please enter flat no');
            } else if (address == "") {
                toastr.error('Please enter address');
            } else if (country == "") {
                toastr.error('Please enter country');
            } else if (state == "") {
                toastr.error('Please enter state');
            } else if (city == "") {
                toastr.error('Please enter city');
            } else if (pincode == "") {
                toastr.error('Please enter pincode');
            } else {
                $.ajax({
                    url: `/addShippingAddress`,
                    method: 'post',
                    data: {
                        _token: _token,
                        type: type,
                        fullname: fullname,
                        email: email,
                        mobile: mobile,
                        flat_no: flat_no,
                        address: address,
                        country: country,
                        state: state,
                        city: city,
                        pincode: pincode,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            toastr.success(res.message);
                            $('#orderId').val(res.orderId);
                            $('.nav-tabs a[href="#step2"]').tab('show');
                            $('.nav-tabs a[href="#step2"]').closest('.nav-item').find('.nav-link').addClass('active');
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            }
        } else {
            var shipping = $('input[type="radio"][name="type"]:checked').data('shippingid');
            $.ajax({
                url: `/addShippingAddress`,
                method: 'post',
                data: {
                    _token: _token,
                    type: type,
                    shipping: shipping,
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        $('#orderId').val(res.orderId);
                        $('.nav-tabs a[href="#step2"]').tab('show');
                        $('.nav-tabs a[href="#step2"]').closest('.nav-item').find('.nav-link').addClass('active');
                    } else {
                        toastr.error(res.message);
                    }
                }
            });
        }
    });

    $('#placeOrder').on('click', function() {
        var paymentMethod = $('input[name="payment-method"]:checked').val();
        var orderId = $('#orderId').val();
        // console.log("paymentMethod", paymentMethod);
        if (paymentMethod == 1) {
            $.ajax({
                url: `/placeOrder`,
                method: 'post',
                data: {
                    _token: _token,
                    type: paymentMethod,
                    orderId: orderId,
                    name: $('#name').val(),
                    email: $('#email').val(),
                    mobile: $('#mobile').val(),
                    amount: $('#amount').val(),
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        setTimeout(() => {
                            window.location.href = res.url;
                        }, 1000);
                    } else {
                        toastr.error(res.message);
                    }
                }
            });
        } else {
        }
        return false;
    });

    $('#applyPromocode').on('click', function() {
        $('.nav-tabs a[href="#step4"]').tab('show');
        $('.nav-tabs a[href="#step4"]').closest('.nav-item').find('.nav-link').addClass('active');
    });

   
    $('.filter_data, .prd-grid').on('click', '.prd-inside .prd-info .prd-size .size-list li a', function() {
        var product_id = $(this).closest('.prd-inside').find('.color-swatch .active a').attr('pid');
        console.log("size value ",$(this).data('value'), product_id);
        $this = $(this);
        $.ajax({
            url: `/sizeWiseProductDetail`,
            method: 'post',
            data: {
                _token: _token,
                pid: product_id,
                sid: $(this).data('value'),
            },
            dataType: 'json',
            success: function(res) {
                $this.closest('.prd-info').find('.prd-price').find('.price-new').text(`1 pcs Price : ₹ ${res['data']['price']}`);
                $this.closest('.prd-info').find('.prd-price').find('.price-old').text(`₹ ${res['data']['old_price']}`);
            }
        });
    });
});