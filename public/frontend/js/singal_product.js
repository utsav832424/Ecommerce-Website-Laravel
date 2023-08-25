$(function() {

    const stars = document.querySelectorAll(".prd-rating i");
    stars.forEach((star,index1) => {
        star.addEventListener("click",()=>{
            stars.forEach((star,index2) => {
                index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
            });
        });
    });
    

    $('.prd-size').on('click', '.size-list li a', function() {
        var pid = $('.color-list .active a').attr('pid');
        console.log("size value ",$(this).data('value'), pid);
        $.ajax({
            url: `/sizeWiseProductDetail`,
            method: 'post',
            data: {
                _token: _token,
                pid: pid,
                sid: $(this).data('value'),
            },
            dataType: 'json',
            success: function(res) {
                $('#ap').text(res['data']['price']);
                $('#op').text(res['data']['old_price']);
            }
        });
    });

    $('.singal_product_add_to_cart').on('click', function() {
        var pid = $('.color-list .active a').attr('pid');
        var cid = $('.color-list .active a').attr('cid');
        var sid = $('.size-list .active a').data('value');
        var qty = $('.qty-changer .qty-input').val();

        if (cid == undefined) {
            toastr.error('Please select color');
        } else if (sid == undefined) {
            toastr.error('Please select size');
        } else {
            console.log(pid, cid, sid, qty);
    
            $.ajax({
                url: `/singalProductAddToCard`,
                method: 'post',
                data: {
                    _token: _token,
                    pid: pid,
                    cid: cid,
                    sid: sid,
                    qty: qty,
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
    $('#product_review_image_preview_section').on('change', '.mainColorSelectcontent .reviewImgFileInput', function () {
        $(this).closest('div').parent().find('.selectColorImgPreviewSection').html("");
        var total_file = this.files.length;
        for (var i = 0; i < total_file; i++) {
            $(this).closest('div').parent().find('.selectColorImgPreviewSection').append("<img src='" + URL.createObjectURL(this.files[i]) + "'>");
        }
    });
});