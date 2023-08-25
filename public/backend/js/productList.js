var csrf = $('input[name="_token"]').val();
var pageIndex = 0;
var editId = 0;
var categorySearch = "";
var maincategoryId = "";
var fabricId = "";
var pid = "";

$(function () {
    $('.select2-example').select2({
        placeholder: 'Select'
    });

    fetchCategory();

    $(".pagination").on('click', '.page-link', function () {
        // console.log($(this).data('page'));
        pageIndex = $(this).data('page');
        fetchCategory();
    });

    $('#categorySearch').on('keyup', function () {
        categorySearch = $(this).val().trim();
        fetchCategory();
    });

    $('#perPageItem').on('change', function () {
        pageIndex = 0;
        fetchCategory();
    });

    $('#categoryDropDown').on('change', function () {
        maincategoryId = $(this).val();
        fetchCategory();
    });

    $('#fabric').on('change', function () {
        fabricId = $(this).val();
        fetchCategory();
    });

    // $('#categoriesTable tbody').on('click', '.viewQuantity .fa-pencil-square-o', function() {
    //     $(this).closest('.viewQuantity').hide();
    //     $(this).closest('.quantitySection').find('.editQuantity').css({'display' : 'flex'});
    // });

    $('#categoriesTable tbody').on('click', '.editQuantity .save', function () {
        var newQty = $(this).closest('.editQuantity').find('input').val();
        var oldQty = $(this).closest('.quantitySection').find('.viewQuantity span').text();
        var id = $(this).data('id');
        console.log("newQty", newQty, id, oldQty);
        var qty = 0;
        if (oldQty > newQty) {
            qty = oldQty - newQty;
            qty = qty * (-1);
        }
        if (oldQty < newQty) {
            qty = newQty - oldQty;
        }

        $.ajax({
            url: '/admin/qty_adjustment',
            method: 'post',
            dataType: 'json',
            data: {
                "_token": csrf,
                "product_id": id,
                "quantity": qty,
            },
            success: function (res) {
                fetchCategory();
            }
        });
    });

    $('#categoriesTable tbody').on('click', '.viewQuantity .fa-pencil-square-o', function () {
        pid = $(this).data("id");
        console.log(`pid : ${pid}`);
        // $('#staticBackdropLabel').html("Edit Quantity");
        // $('#staticBackdrop').find('.modal-footer').find('.btn-success').text('Edit');
        $('#staticBackdrop').modal('show');
        fecthsizeStock();
    });

    $('#sizestockTable').on('blur','tr #size_product_oldprice',function(){
        var oldprice = $(this).val();
        var price = $(this).closest('tr').find('#size_product_newprice').val();
        $(this).closest('tr').find('.savePrice').text(oldprice-price);
    });

    $('#size_quantity').on('submit',function(e){
        e.preventDefault();
        
        var action = $(this).attr('action');
        var productData = new FormData();
        var sizeDetails = {};
        $('#sizestockTable tbody tr').each(function() {
            sizeDetails[$(this).data('id')] = {
                'size_id':  $(this).data('id'),
                'quantity' : $(this).find('#size_product_quantity').val(),
                'price' : $(this).find('#size_product_newprice').val(),
                'old_price' : $(this).find('#size_product_oldprice').val(),
            };
                
        });
        productData.append('_token', csrf);
        productData.append('sizeDetails', JSON.stringify(sizeDetails));
        productData.append('product_id', pid);
       
        $.ajax({
            url: action,
            method: 'post',
            data: productData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status) {
                    toastr.success(res.message);
                    $('#staticBackdrop').modal('hide');
                } else {
                    toastr.error(res.message);
                }
            }
        })
    });
});

function fecthsizeStock() {
    $.ajax({
        url: '/admin/sizeStock',
        method: 'post',
        dataType: 'json',
        data: {
            "_token": csrf,
            "pid": pid
        },
        success: function (res) {
            var html = '';
            
            res.data.forEach((element) => {
                console.log(element);
                html += `
                <tr class='size_size_details_row' data-id="${element.size_id}" data-productid="${element.product_id}" style="text-align: center;">
                    <td class="text-start">${element.name}</td>
                    <td><input type="text"  value="${element.quantity}" id="size_product_quantity"></td>
                    <td><input type="text" value="${element.old_price}" id="size_product_oldprice" ></td>
                    <td><input type="text" value="${element.price}" id="size_product_newprice" ></td>
                    <td class='savePrice'>${element.old_price - element.price}</td>
                </tr>`;
                
            });
            $('#sizestockTable tbody').html(html);
        
        }
       
    });
}

function fetchCategory() {
    $.ajax({
        url: '/admin/fetchProduct',
        method: 'post',
        dataType: 'json',
        data: {
            "_token": csrf,
            "limit": $('#perPageItem').val(),
            "offset": $('#perPageItem').val() * pageIndex,
            "search": categorySearch,
            "sort": $('#sortOrder').val(),
            "category_id": maincategoryId,
            "fabric_id": fabricId
        },
        success: function (res) {
            var html = '';
            res.data.forEach((element, index) => {
                html += `<tr>
                    <td>${$('#perPageItem').val() * pageIndex + (index + 1)}</td>
                    <td><img src="/${element.main_img}"class="js-prd-img lazyload"style="height: 50px;"></td>
                    <td>${element.name}</td>
                    <td>${element.sku == null ? '' : element.sku}</td>
                    <td>
                        <div class="quantitySection">
                            <div class="viewQuantity">
                                <span>${element.totalQty}</span>
                                <i class="fa fa-pencil-square-o" data-id="${element.id}"></i>
                            </div>
                            <div class="editQuantity">
                                <input type="text" value="${element.totalQty}" class="form-controll">
                                <span class="badge bg-success save" data-id="${element.id}">Save</span>
                            </div>
                        </div>
                    </td>
                    <td>${element.sell}</td>
                    <td>${element.price}</td>
                    <td>${element.catelogue_price}</td>
                    <td>${element.catelogue_pis}</td>`;
                if (element.totalQty > element.sell) {
                    html += `<td><span class="text-success">In Stock</span></td>`;
                } else {
                    html += `<td><span class="text-danger">Out Of Stock</span></td>`;
                }
                if (element.isActive == 1) {
                    html += `<td>
                        <span class="badge bg-success">Active</span>
                    </td>`;
                } else {
                    html += `<td>
                        <span class="badge bg-danger">Deactive</span>
                    </td>`;
                }
                html += `<td class="text-end">
                        <div class="d-flex">
                            <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="/admin/viewProduct/${element.slug}" class="dropdown-item view">View</a>
                                    <a href="/admin/editProduct/${element.slug}" class="dropdown-item edit">Edit</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>`;
            });
            $('#categoriesTable tbody').html(html);

            var navHtml = `<li class="page-item">
                                <a class="page-link" data-page="0" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>`;
            for (let index = 0; index < res.totalPage; index++) {
                if (pageIndex == index) {
                    navHtml += `<li class="page-item active"><a class="page-link" data-page="${index}">${index + 1}</a></li>`;
                } else {
                    navHtml += `<li class="page-item"><a class="page-link" data-page="${index}">${index + 1}</a></li>`;
                }
            }

            navHtml += `<li class="page-item">
                            <a class="page-link" data-page="${res.totalPage - 1}" aria-label="Next">
                                <span aria-hidden="true">»</span>
                            </a>
                        </li>`;
            $('.pagination').html(navHtml);
        }
    });
}