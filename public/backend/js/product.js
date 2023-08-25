let descriptionEditor;
let specificationEditor;
var pageIndex = 0;
$(function () {

    ClassicEditor
        .create(document.querySelector('#descriptionEditor'))
        .then(newEditor => {
            descriptionEditor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#specificationEditor'))
        .then(newEditor => {
            specificationEditor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    $('#mainCategoryDropDown').on('change', function () {
        var data = new FormData();
        data.append('mainCategoryId', $(this).val());
        data.append('_token', $('input[name="_token"]').val());

        $.ajax({
            url: "/admin/getSubCategoryByMainCategory",
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                var html = `<option value="">Select Sub Category</option>`;
                res.data.forEach(element => {
                    html += `<option value="${element.id}">${element.name}</option>`;
                });
                $('#subCategoryDropDown').html(html);
            }
        });
    });

    $('#product_img').on('change', function () {
        $('#product_image_preview_section').html("");
        var total_file = document.getElementById("product_img").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#product_image_preview_section').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
        }
    });

    $('.color-checkbox-element').on('click', function () {
        if ($(this).is(':checked')) {
            var html = `<div class="col-md-6" style="width: 49%;">
                            <div class="mainColorSelectcontent" style="display: flex;
                            flex-direction: column;
                            gap: 8px;">
                                <label class="form-check-label">${$(this).closest('div').children('.form-check-label').text()}</label>
                                <input type="text" class="form-control color-sku" id="product_color_sku" placeholder="color sku">
                                <input type="file" multiple class="form-control colorImgFileInput" data-colorId="${$(this).closest('div').children('.color-checkbox-element').data('value')}" data-colorName="${$(this).closest('div').children('.form-check-label').text()}" id="color_${$(this).closest('div').children('.color-checkbox-element').data('value')}_img">
                            </div>
                            <div class="selectColorImgPreviewSection"></div>
                        </div>`;
            $('#product_color_image_preview_section').append(html);
        } else {
            if ($('body').find('#productId').val() == undefined) {
                $('#product_color_image_preview_section').find('.mainColorSelectcontent').find(`#color_${$(this).closest('div').children('.color-checkbox-element').data('value')}_img`).parent().parent().remove();
            } else {
                $this = $(this);
                var colorId = $(this).closest('div').children('.color-checkbox-element').data('value');

                $.ajax({
                    url: "/admin/deleteAllColorImg",
                    method: 'post',
                    data: {
                        colorId: colorId,
                        productId: $('#productId').val(),
                        _token: $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            $('#product_color_image_preview_section').find('.mainColorSelectcontent').find(`#color_${$this.closest('div').children('.color-checkbox-element').data('value')}_img`).parent().parent().remove();
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            }
        }
    });

    $('#product_color_image_preview_section').on('change', '.mainColorSelectcontent .colorImgFileInput', function () {
        $(this).closest('div').parent().find('.selectColorImgPreviewSection').html("");
        var total_file = this.files.length;
        for (var i = 0; i < total_file; i++) {
            $(this).closest('div').parent().find('.selectColorImgPreviewSection').append("<img src='" + URL.createObjectURL(this.files[i]) + "'>");
        }
    });

    $('#product_name').on('blur', function () {
        var productName = $(this).val();
        productName = productName.replace(/[^a-zA-Z ]/g, "");
        productName = productName.split(' ').join('-');
        productName = productName.toLowerCase();
        $('#product_slug').val(productName);
    });

    $('#product_add').on('click', function () {
        var categoryId = $('#mainCategoryDropDown').val();
        var SubCategoryId = $('#subCategoryDropDown').val();
        var fabricId = $('#fabric').val();
        var occasion_id = $('#occasion').val();
        var pattern_id = $('#pattern').val();
        var work_id = $('#work').val();
        var sleeve_id = $('#sleeve').val();
        var wash_id = $('#wash').val();
        var hook_id = $('#hook').val();
        var name = $('#product_name').val();
        var slug = $('#product_slug').val();
        var sku = $('#product_sku').val();
        var quantity = $('#product_quantity').val();
        var price = $('#product_price').val();
        var oldPrice = $('#product_old_price').val();
        var cateloguePrice = $('#catelogue_price').val();
        var cateloguePie = $('#catelogue_pie').val();
        var productDiscount = $('#product_discount').val();
        var savePrice = $('#product_save_price').val();
        var status = $('#status').val();
        var isFeatured = $('#is_featured').is(':checked');
        var isNew = $('#is_new').is(':checked');
        var isHotDeal = $('#is_hot_deal').is(':checked');
        var package_weight = $('#product_weight').val();
        var package_length = $('#product_length').val();
        var package_breadth	 = $('#product_breadth').val();
        var package_height = $('#product_height').val();
        var size = [];
        var color = [];
        var colorImage = [];
        var description = descriptionEditor.getData();
        var specification = specificationEditor.getData();
        var token = $('input[name="_token"]').val();

        $('.size-checkbox-element').each(function () {
            if ($(this).is(':checked')) {
                size.push($(this).data('value'));
            }
        });

        $('.color-checkbox-element').each(function () {
            if ($(this).is(':checked')) {
                color.push($(this).data('value'));
            }
        });

        $('#product_color_image_preview_section .colorImgFileInput').each(function () {
            var total_file = this.files.length;
            var obj = {};
            obj['color_name'] = $(this).data('colorname');
            obj['color_id'] = $(this).data('colorid');
            obj['img'] = [];
            for (var i = 0; i < total_file; i++) {
                obj['img'].push(this.files[i]);
            }
           
            colorImage.push(obj);
            colorImage.forEach(element => {
                if(element.img.length == 0){
                    toastr.error("Please Upload Images");
                }
             });
            console.log(`Total : ${total_file}`);
        });
        console.log(`color : ${colorImage.length}`);
        // console.log(categoryId, SubCategoryId, fabricId, size.join(','), color.join(','), colorImage, name, slug, description, specification, quantity, price, oldPrice, cateloguePrice, cateloguePie, productDiscount, status, isFeatured, isNew);

        if (categoryId == "") {
            toastr.error("Please Select Category");
        } else if (SubCategoryId == "") {
            toastr.error("Please Select Sub Category");
        } else if (fabricId == "") {
            toastr.error("Please Select Fabric");
        } else if (occasion_id == "") {
            toastr.error("Please Select Occasion");
        } else if (pattern_id == "") {
            toastr.error("Please Select Pattern");
        } else if (work_id == "") {
            toastr.error("Please Select Work");
        } else if (sleeve_id == "") {
            toastr.error("Please Select Sleeve");
        } else if (wash_id == "") {
            toastr.error("Please Select Wash");
        } else if (hook_id == "") {
            toastr.error("Please Select Hook");
        } else if (size.length == 0) {
            toastr.error("Please Select Size");
        } else if (color.length == 0) {
            toastr.error("Please Select Color");
        } else if (colorImage.length == 0) {
            toastr.error("Please Upload Color Images");
        }
        /* else if (colorImage.length > 0) {
           var status = true;
           var color_id = 0;
           color.forEach(element => {
               var image = colorImage.filter((x) => x.color_id == element)[0];
               if (image.img.length == 0) {
                   status = false;
                   color_id = image.color_id;
                   return false;
               }
           });
           if (color_id > 0) {
               var imageData = colorImage.filter((x) => x.color_id == color_id)[0];
               toastr.error(`Please Upload ${imageData.color_name} Color Images`);
           }
       }  */
        else if (name == "") {
            toastr.error("Please Enter Name");
        } else if (slug == "") {
            toastr.error("Please Enter Slug");
        } else if (sku == "") {
            toastr.error("Please Enter SKU");
        } else if (description == "") {
            toastr.error("Please Enter Description");
        } else if (specification == "") {
            toastr.error("Please Enter Specification");
        } else if (quantity == "") {
            toastr.error("Please Enter Quantity");
        } else if (price == "") {
            toastr.error("Please Enter Price");
        } else if (oldPrice == "") {
            toastr.error("Please Enter Old Price");
        } else if (cateloguePrice == "") {
            toastr.error("Please Enter Catelogue Price");
        } else if (cateloguePie == "") {
            toastr.error("Please Enter Catelogue Pis");
        } else if (productDiscount == "") {
            toastr.error("Please Enter Discount");
        } else if (status == "") {
            toastr.error("Please Select Status");
        } else if (package_weight == "") {
            toastr.error("Please Select Product Weight");
        }  else if (package_length == "") {
            toastr.error("Please Select Product Length");
        }  else if (package_breadth == "") {
            toastr.error("Please Select Product Breadth");
        }  else if (package_height == "") {
            toastr.error("Please Select Product Height");
        } else {
            var productData = new FormData();
            productData.append('category_id', categoryId);
            productData.append('subcategory_id', SubCategoryId);
            productData.append('fabric_id', fabricId);
            productData.append('size_id', size.join(','));
            productData.append('color_id', color.join(','));
            productData.append('occasion_id', occasion_id);
            productData.append('pattern_id', pattern_id);
            productData.append('work_id', work_id);
            productData.append('sleeve_id', sleeve_id);
            productData.append('wash_id', wash_id);
            productData.append('hook_id', hook_id);
            $('#product_color_image_preview_section .colorImgFileInput').each(function () {
                var total_file = this.files.length;
                var obj = {};
                obj['color_id'] = $(this).data('colorid');
                for (var i = 0; i < total_file; i++) {
                    productData.append(`colorImage_${$(this).data('colorid')}[]`, this.files[i]);
                }
                productData.append(`colorSku_${$(this).data('colorid')}`, $(this).closest('.mainColorSelectcontent').find('.color-sku').val());
            });
            // productData.append('colorImage', JSON.stringify(colorImage));
            var sizeDetails = {};
            $('#sizeDetailsTable tbody tr').each(function() {
                console.log($(this).data('id'));
                console.log($(this).find('.size-quantity').val());
                console.log($(this).find('.size-oldprice').val());
                console.log($(this).find('.size-newprice').val());
                sizeDetails[$(this).data('id')] = {
                    'quantity' : $(this).find('.size-quantity').val(),
                    'oldprice' : $(this).find('.size-oldprice').val(),
                    'newprice' : $(this).find('.size-newprice').val(),
                };
                    
            });
            productData.append('sizeDetails', JSON.stringify(sizeDetails));

            productData.append('name', name);
            productData.append('slug', slug);
            productData.append('sku', sku);
            productData.append('description', description);
            productData.append('specification', specification);
            productData.append('quantity', quantity);
            productData.append('price', price);
            productData.append('old_price', oldPrice);
            productData.append('catelogue_price', cateloguePrice);
            productData.append('catelogue_pis', cateloguePie);
            productData.append('discount', productDiscount);
            productData.append('status', status);
            productData.append('savePrice', savePrice);
            productData.append('is_featured', isFeatured ? 1 : 0);
            productData.append('is_new', isNew ? 1 : 0);
            productData.append('is_hot_deal', isHotDeal ? 1 : 0);
            productData.append('_token', token);
            productData.append('package_weight', package_weight);
            productData.append('package_length', package_length);
            productData.append('package_breadth', package_breadth);
            productData.append('package_height', package_height);
            $(this).prop('disabled', true);

            $.ajax({
                url: "/admin/addProduct",
                method: 'post',
                data: productData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        toastr.success(res.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    } else {
                        toastr.error(res.message);
                    }
                }
            });
        }

    });

    $('#product_update').on('click', function () {
        var categoryId = $('#mainCategoryDropDown').val();
        var SubCategoryId = $('#subCategoryDropDown').val();
        var fabricId = $('#fabric').val();
        var occasion_id = $('#occasion').val();
        var pattern_id = $('#pattern').val();
        var work_id = $('#work').val();
        var sleeve_id = $('#sleeve').val();
        var wash_id = $('#wash').val();
        var hook_id = $('#hook').val();
        var name = $('#product_name').val();
        var slug = $('#product_slug').val();
        var sku = $('#product_sku').val();
        var quantity = $('#product_quantity').val();
        var price = $('#product_price').val();
        var oldPrice = $('#product_old_price').val();
        var cateloguePrice = $('#catelogue_price').val();
        var cateloguePie = $('#catelogue_pie').val();
        var productDiscount = $('#product_discount').val();
        var savePrice = $('#product_save_price').val();
        var status = $('#status').val();
        var isFeatured = $('#is_featured').is(':checked');
        var isNew = $('#is_new').is(':checked');
        var isHotDeal = $('#is_hot_deal').is(':checked');
        var package_weight = $('#product_weight').val();
        var package_length = $('#product_length').val();
        var package_breadth	 = $('#product_breadth').val();
        var package_height = $('#product_height').val();
        var size = [];
        var color = [];
        var colorImage = [];
        var description = descriptionEditor.getData();
        var specification = specificationEditor.getData();
        var token = $('input[name="_token"]').val();

        $('.size-checkbox-element').each(function () {
            if ($(this).is(':checked')) {
                size.push($(this).data('value'));
            }
        });

        $('.color-checkbox-element').each(function () {
            if ($(this).is(':checked')) {
                color.push($(this).data('value'));
            }
        });

        $('#product_color_image_preview_section .colorImgFileInput').each(function () {
            var total_file = this.files.length;
            var obj = {};
            obj['color_name'] = $(this).data('colorname');
            obj['color_id'] = $(this).data('colorid');
            obj['img'] = [];
            for (var i = 0; i < total_file; i++) {
                obj['img'].push(this.files[i]);
            }
            colorImage.push(obj);
        });

        // console.log(categoryId, SubCategoryId, fabricId, size.join(','), color.join(','), colorImage, name, slug, description, specification, quantity, price, oldPrice, cateloguePrice, cateloguePie, productDiscount, status, isFeatured, isNew);

        if (categoryId == "") {
            toastr.error("Please Select Category");
        } else if (SubCategoryId == "") {
            toastr.error("Please Select Sub Category");
        } else if (fabricId == "") {
            toastr.error("Please Select Fabric");
        } else if (occasion_id == "") {
            toastr.error("Please Select Occasion");
        } else if (pattern_id == "") {
            toastr.error("Please Select Pattern");
        } else if (work_id == "") {
            toastr.error("Please Select Work");
        } else if (sleeve_id == "") {
            toastr.error("Please Select Sleeve");
        } else if (wash_id == "") {
            toastr.error("Please Select Wash");
        } else if (hook_id == "") {
            toastr.error("Please Select Hook");
        } else if (size.length == 0) {
            toastr.error("Please Select Size");
        } else if (color.length == 0) {
            toastr.error("Please Select Color");
        } else if (colorImage.length == 0) {
            toastr.error("Please Upload Color Images");
        }
        /* else if (colorImage.length > 0) {
           var status = true;
           var color_id = 0;
           color.forEach(element => {
               var image = colorImage.filter((x) => x.color_id == element)[0];
               if (image.img.length == 0) {
                   status = false;
                   color_id = image.color_id;
                   return false;
               }
           });
           if (color_id > 0) {
               var imageData = colorImage.filter((x) => x.color_id == color_id)[0];
               toastr.error(`Please Upload ${imageData.color_name} Color Images`);
           }
       }  */
        else if (name == "") {
            toastr.error("Please Enter Name");
        } else if (slug == "") {
            toastr.error("Please Enter Slug");
        } else if (sku == "") {
            toastr.error("Please Enter SKU");
        } else if (description == "") {
            toastr.error("Please Enter Description");
        } else if (specification == "") {
            toastr.error("Please Enter Specification");
        } else if (quantity == "") {
            toastr.error("Please Enter Quantity");
        } else if (price == "") {
            toastr.error("Please Enter Price");
        } else if (oldPrice == "") {
            toastr.error("Please Enter Old Price");
        } else if (cateloguePrice == "") {
            toastr.error("Please Enter Catelogue Price");
        } else if (cateloguePie == "") {
            toastr.error("Please Enter Catelogue Pis");
        } else if (productDiscount == "") {
            toastr.error("Please Enter Discount");
        } else if (status == "") {
            toastr.error("Please Select Status");
        }  else if (package_weight == "") {
            toastr.error("Please Select Product Weight");
        }  else if (package_length == "") {
            toastr.error("Please Select Product Length");
        }  else if (package_breadth == "") {
            toastr.error("Please Select Product Breadth");
        }  else if (package_height == "") {
            toastr.error("Please Select Product Height");
        } 
        else {
            var productData = new FormData();
            productData.append('category_id', categoryId);
            productData.append('subcategory_id', SubCategoryId);
            productData.append('fabric_id', fabricId);
            productData.append('size_id', size.join(','));
            productData.append('color_id', color.join(','));
            productData.append('occasion_id', occasion_id);
            productData.append('pattern_id', pattern_id);
            productData.append('work_id', work_id);
            productData.append('sleeve_id', sleeve_id);
            productData.append('wash_id', wash_id);
            productData.append('hook_id', hook_id);
            $('#product_color_image_preview_section .colorImgFileInput').each(function () {
                var total_file = this.files.length;
                var obj = {};
                obj['color_id'] = $(this).data('colorid');
                for (var i = 0; i < total_file; i++) {
                    productData.append(`colorImage_${$(this).data('colorid')}[]`, this.files[i]);
                }
                console.log($(this).closest('.mainColorSelectcontent').find('.edit_color_sku').val());
                productData.append(`colorSku_${$(this).data('colorid')}`, $(this).closest('.mainColorSelectcontent').find('.edit_color_sku').val());
            });
            var sizeDetails = {};
            $('#sizeDetailsEditTable tbody tr').each(function() {
                sizeDetails[$(this).data('id')] = {
                    'quantity' : $(this).find('.size-quantity').val(),
                    'oldprice' : $(this).find('.size-oldprice').val(),
                    'newprice' : $(this).find('.size-newprice').val(),
                };
                    
            });
            productData.append('sizeDetails', JSON.stringify(sizeDetails));
            // productData.append('colorImage', JSON.stringify(colorImage));
            productData.append('name', name);
            productData.append('slug', slug);
            productData.append('sku', sku);
            productData.append('description', description);
            productData.append('specification', specification);
            productData.append('quantity', quantity);
            productData.append('price', price);
            productData.append('old_price', oldPrice);
            productData.append('catelogue_price', cateloguePrice);
            productData.append('catelogue_pis', cateloguePie);
            productData.append('discount', productDiscount);
            productData.append('status', status);
            productData.append('savePrice', savePrice);
            productData.append('is_featured', isFeatured ? 1 : 0);
            productData.append('is_new', isNew ? 1 : 0);
            productData.append('is_hot_deal', isHotDeal ? 1 : 0);
            productData.append('package_weight', package_weight);
            productData.append('package_length', package_length);
            productData.append('package_breadth', package_breadth);
            productData.append('package_height', package_height);
            productData.append('_token', token);
            productData.append('productId', $('#productId').val());
            $(this).prop('disabled', true);

            $.ajax({
                url: "/admin/editProduct",
                method: 'post',
                data: productData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        toastr.success(res.message);
                        setTimeout(() => {
                            window.location.href = '/admin/product';
                        }, 500);
                    } else {
                        toastr.error(res.message);
                    }
                }
            });
        }

    });

    $('#product_old_price').on('blur', function () {
        var oldPrice = $(this).val();
        var price = $('#product_price').val();
        $('#product_save_price').val(oldPrice - price);
    });

    $('#sizeDetailsTable').on('blur', 'tr .size-newprice', function () {
        var newPrice = $(this).val();
        var price = $(this).closest('tr').find('.size-oldprice').val();
        $(this).closest('tr').find('.savePrice').text(price - newPrice);
    });

    $('.number-field').on('keypress', function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $('.deleteColorImg').on('click', function () {
        $this = $(this);
        var colorImgId = $(this).data('colorimgid');

        $.ajax({
            url: "/admin/deleteColorImg",
            method: 'post',
            data: {
                colorImgId: colorImgId,
                _token: $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    $this.closest('.editColorImageListSection').remove();
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });

    $('.size-checkbox-element').click(function () {
        var sizeName = $(this).closest('.form-check').find('.form-check-label').text();
        var sizetrim = sizeName.replace(/\s/g,'');
        var sizeid = $(this).attr("data-value");
        if ($(this).is(':checked')) {
            var html = `<tr class='size_${sizetrim}_size_details_row' data-id="${sizeid}" style="text-align: center;">
                <td class="text-start">${sizeName}</td>
                <td><input type="text" class="form-control size-quantity" id="size_${sizetrim}_product_quantity"></td>
                <td><input type="text" class="form-control size-oldprice" id="size_${sizetrim}_product_oldprice"></td>
                <td><input type="text" class="form-control size-newprice" id="size_${sizetrim}_product_newprice"></td>
                <td class='savePrice'>0</td>
            </tr>`;
            $('#sizeDetailsTable').append(html);
       
        } else {
            $('#sizeDetailsTable').find(`.size_${sizetrim}_size_details_row`).remove();
        }
    });
    $('.size-checkbox-element').click(function () {
        var sizeName = $(this).closest('.form-check').find('.form-check-label').text();
        var sizetrim = sizeName.replace(/\s/g,'');
        var sizeid = $(this).attr("data-value");
        if ($(this).is(':checked')) {
            var html = `<tr class='size_${sizetrim}_size_details_row' data-id="${sizeid}" style="text-align: center;">
                <td class="text-start">${sizeName}</td>
                <td><input type="text" class="form-control size-quantity" id="size_${sizetrim}_product_quantity"></td>
                <td><input type="text" class="form-control size-oldprice" id="size_${sizetrim}_product_oldprice"></td>
                <td><input type="text" class="form-control size-newprice" id="size_${sizetrim}_product_newprice"></td>
                <td class='savePrice'>0</td>
            </tr>`;
            $('#sizeDetailsEditTable').append(html);
       
        } else {
            $('#sizeDetailsEditTable').find(`.size_${sizetrim}_size_details_row`).remove();
        }
    });
});

function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="' + e.target.result + '" width="450" height="300"/>');
        };
        reader.readAsDataURL(input.files[0]);
    }
}