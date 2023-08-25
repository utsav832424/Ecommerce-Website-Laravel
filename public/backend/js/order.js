var csrf = $('input[name="_token"]').val();
var pageIndex = 0;
var editId = 0;
var categorySearch = "";
var maincategoryId = "";
var courier = [];
var orderid;
$(function () {

    $('.select2-example').select2({
        placeholder: 'Select'
    });

    // fetchCategory();

    $('#categoriesTable tbody').on('click', '.dropdown-item.edit', function () {
        $('#staticBackdropLabel').html("Edit Fabric");
        $('#staticBackdrop').find('.modal-footer').find('.btn-success').text('Save');
        editId = $(this).closest('tr').children().eq(0).text();
        var name = $(this).closest('tr').children().eq(1).text();
        var active = $(this).closest('tr').children().eq(2).text();
        $('#name').val(name);

        if (active.trim() == "Active") {
            $('#isActive').prop('checked', true);
        } else {
            $('#isActive').prop('checked', false);
        }
        $('#staticBackdrop').modal('show');
    });

    $('#AddCategoryBtn').click(function () {
        $('#staticBackdropLabel').html("Add Fabric");
        $('#staticBackdrop').find('.modal-footer').find('.btn-success').text('Add');
        editId = 0;
        $('#name').val("");
        $('#isActive').prop('checked', false);
        $('#staticBackdrop').modal('show');
    });

    $('#AcceptOrderbtn').click(function () {
        $('#staticBackdrop').modal('show');
    });

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
    
    $('#selectAllPendingOrder').click(function() {
        var html = '';
        if($(this).is(':checked')){
            $('tr td input').attr('checked',true);
            html+=`
                <div class="shipO">
                    <button class="shiporder">Shipped All Order</button>
                </div>  
            `;
            $('#pending').append(html);
        }else{
            $('tr td input').attr('checked',false);
            $('#pending ').find('.shipO button').remove();
        }
    })

    $('.nav.nav-pills .nav-item').on('click', '.nav-link', function () {
        var tabName = $(this).attr('href').substring(1, $(this).attr('href').length);
        if ($(this).attr('href') == '#pending') {

            $.ajax({
                url: '/admin/sortOrder',
                method: 'post',
                dataType: 'json',
                data: {
                    "_token": csrf,
                    "status": 1,
                },
                success: function (res) {
                    var html = '';

                    if (res.data.length > 0) {
                        res.data.forEach((element, index) => {
                            html += `<tr>
                        <td>
                            <input type="checkbox" class="form-check-input color-checkbox-element" data-oid="${element.id}">
                        <td>
                            <div class="prdetail">
                                <div class="img"><img src="/${element.image}" class="imgsection"></div>
                                <div class="nameprdeatil">
                                    <p class="namepr">${element.name}</p>
                                    <div class="orderdetil">Order ID : ${element.order_number}</div>
                                </div>
                            </div> 
                        </td>
                        <td>${element.color_sku}</td>
                        <td>${element.sku}</td>
                        <td>${element.quantity}</td>
                        <td>${element.sizeName}</td>
                    
                        <td class="text-end">
                            <div class="d-flex">
                                    <button class="btnaccept" data-cid="${element.id}">Accept</button>
                                    <button class="btncancel" data-cid="${element.id}">Cancel</button>
                            </div>
                        </td>
                    </tr>`;
                            //     html += `<div class="col-lg-4 col-md-6">
                            //     <div class="card border">
                            //         <div class="card-body">
                            //             <div class="detailsection">
                            //                 <div class="img"><img src="/${element.image}" class="imgsection"></div>
                            //                 <div class=""><h6 class="card-title">${element.name}</h6>
                            //                     <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;${element.order_number}</p>
                            //                     <p class="cardtxt"> <strong>Size:</strong> &nbsp;${element.sizeName}</p>
                            //                     <p class="cardtxt"> <strong>Color:</strong> &nbsp;${element.colorName}</p>
                            //                     <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;${element.sku}</p>
                            //                     <p class="cardtxt"> <strong>QTY: </strong> &nbsp;${element.quantity}</p>
                            //                 </div>
                            //             </div>


                            //             <div class="btn2">
                            //                 <a href="#" class="btn btn-success accept_order" data-cid="${element.id}" style="width: 100%;">Accept Order</a>
                            //                 <a href="#" class="btn btn-primary cancel_order" data-cid="${element.id}" style="width: 100%">Cancel Order</a>
                            //             </div>

                            //         </div>
                            //     </div>
                            // </div>`;
                        });
                    } else {
                        html += `<tr><td colspan='8'>Pending order list is empty</td></tr>`;
                    }
                    $(`#${tabName} .table-responsive table tbody`).html(html);
                }
            });
        } else if ($(this).attr('href') == '#readytoshop') {
            $.ajax({
                url: '/admin/sortOrder',
                method: 'post',
                dataType: 'json',
                data: {
                    "_token": csrf,
                    "status": 2,
                },
                success: function (res) {
                    var html = '';
                    if (res.data.length > 0) {
                        res.data.forEach((element, index) => {
                            html += `
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input color-checkbox-element" id="color">
                                   </td>
                                    <td>
                                        <div class="prdetail">
                                            <div class="img"><img src="/${element.image}" class="imgsection"></div>
                                            <div class="nameprdeatil">
                                                <p class="namepr">${element.name}</p>
                                                <div class="orderdetil">Order ID : ${element.order_number}</div>
                                            </div>
                                        </div> 
                                    </td>
                                    <td>${element.color_sku}</td>
                                    <td>${element.sku}</td>
                                    <td>${element.quantity}</td>
                                    <td>${element.sizeName}</td>
                                   
                                    <td class="text-end">
                                        <div class="d-flex">
                                            
                                                <a href="${element.ship_label}" target="_blank"><button class="btnlabel" data-cid="${element.id}"><span class="material-icons">vertical_align_bottom</span>Label</button></a>
                                                <div class="readydownload">Downloaded</div>
                                        </div>
                                    </td>
                                </tr>`;
                            //     html += `<div class="col-lg-4 col-md-6">
                            //     <div class="card border">
                            //         <div class="card-body">
                            //             <div class="detailsection">
                            //                 <div class="img"><img src="/${element.image}" class="imgsection"></div>
                            //                 <div class=""><h6 class="card-title">${element.name}</h6>
                            //                     <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;${element.order_number}</p>
                            //                     <p class="cardtxt"> <strong>Size:</strong> &nbsp;${element.sizeName}</p>
                            //                     <p class="cardtxt"> <strong>Color:</strong> &nbsp;${element.colorName}</p>
                            //                     <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;${element.sku}</p>
                            //                     <p class="cardtxt"> <strong>QTY: </strong> &nbsp;${element.quantity}</p>
                            //                 </div>
                            //             </div>


                            //             <div class="btn2">
                            //                 <a href="#" class="btn btn-primary shipped_order" data-cid="${element.id}" style="width: 110px;">
                            //                     <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Label
                            //                 </a>
                            //             </div>

                            //         </div>
                            //     </div>
                            // </div>`;
                        });
                    } else {
                        html += `<tr><td colspan='8'>No shipping Porduct</td></tr>`;
                        //     html += `<div class="row emptyProduct">
                        //     <div class="card border, rs_size">
                        //         <div class="card-body">
                        //             <div class="detailsection">
                        //                 <h3>Ready to ship product is empty</h3>
                        //             </div>
                        //         </div>
                        //     </div>
                        // </div>`;
                    }
                    $(`#${tabName} .table-responsive table tbody`).html(html);
                }
            });
        } else if ($(this).attr('href') == '#shipped') {
            $.ajax({
                url: '/admin/sortOrder',
                method: 'post',
                dataType: 'json',
                data: {
                    "_token": csrf,
                    "status": 3,
                },
                success: function (res) {
                    var html = '';
                    if (res.data.length > 0) {
                        res.data.forEach((element, index) => {
                            html += `
                                <tr>
                                    <td>
                                        <div class="prdetail">
                                            <div class="img"><img src="/${element.image}" class="imgsection"></div>
                                            <div class="nameprdeatil">
                                                <p class="namepr">${element.name}</p>
                                                <div class="orderdetil">Order ID : ${element.order_number}</div>
                                            </div>
                                        </div> 
                                    </td>
                                    <td>${element.color_sku}</td>
                                    <td>${element.sku}</td>
                                    <td>${element.quantity}</td>
                                    <td>${element.sizeName}</td>
                                    <td class="text-end">
                                        <a href="/admin/trackshipment/${element.awb_number}"><button class="btndelhivry"><span class="material-icons">local_shipping</span>Xpressbees</button></a>
                                    </td>
                                </tr>`;
                            //     html += `<div class="col-lg-4 col-md-6">
                            //     <div class="card border">
                            //         <div class="card-body">
                            //             <div class="detailsection">
                            //                 <div class="img"><img src="/${element.image}" class="imgsection"></div>
                            //                 <div class=""><h6 class="card-title">${element.name}</h6>
                            //                     <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;${element.order_number}</p>
                            //                     <p class="cardtxt"> <strong>Size:</strong> &nbsp;${element.sizeName}</p>
                            //                     <p class="cardtxt"> <strong>Color:</strong> &nbsp;${element.colorName}</p>
                            //                     <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;${element.sku}</p>
                            //                     <p class="cardtxt"> <strong>QTY: </strong> &nbsp;${element.quantity}</p>
                            //                 </div>
                            //             </div>

                            //         </div>
                            //     </div>
                            // </div>`;
                        });
                    } else {
                        html += `<tr><td colspan='8'>Shipping Porduct is empty.</td></tr>`;
                        //     html += `<div class="row emptyProduct">
                        //     <div class="card border, rs_size">
                        //         <div class="card-body">
                        //             <div class="detailsection">
                        //                 <h3>The shipped product is empty</h3>
                        //             </div>
                        //         </div>
                        //     </div>
                        // </div>`;
                    }
                    $(`#${tabName} .table-responsive table tbody`).html(html);
                }
            });
        } else if ($(this).attr('href') == '#cancelled') {
            $.ajax({
                url: '/admin/sortOrder',
                method: 'post',
                dataType: 'json',
                data: {
                    "_token": csrf,
                    "status": 4,
                },
                success: function (res) {
                    var html = '';
                    if (res.data.length > 0) {
                        res.data.forEach((element, index) => {
                            html += `
                                    <tr>
                                        <td>
                                            <div class="prdetail">
                                                <div class="img"><img src="/${element.image}" class="imgsection"></div>
                                                <div class="nameprdeatil">
                                                    <p class="namepr">${element.name}</p>
                                                    <div class="orderdetil">Order ID : ${element.order_number}</div>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>${element.color_sku}</td>
                                        <td>${element.sku}</td>
                                        <td>${element.quantity}</td>
                                        <td>${element.sizeName}</td>
                                    </tr>`;
                            //     html += `<div class="col-lg-4 col-md-6">
                            //     <div class="card border">
                            //         <div class="card-body">
                            //             <div class="detailsection">
                            //                 <div class="img"><img src="/${element.image}" class="imgsection"></div>
                            //                 <div class=""><h6 class="card-title">${element.name}</h6>
                            //                     <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;${element.order_number}</p>
                            //                     <p class="cardtxt"> <strong>Size:</strong> &nbsp;${element.sizeName}</p>
                            //                     <p class="cardtxt"> <strong>Color:</strong> &nbsp;${element.colorName}</p>
                            //                     <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;${element.sku}</p>
                            //                     <p class="cardtxt"> <strong>QTY: </strong> &nbsp;${element.quantity}</p>
                            //                 </div>
                            //             </div>

                            //         </div>
                            //     </div>
                            // </div>`;
                        });
                    } else {
                        html += `<tr><td colspan='5'>No one cancel product.</td></tr>`;
                        //     html += `<div class="row emptyProduct">
                        //     <div class="card border, rs_size">
                        //         <div class="card-body">
                        //             <div class="detailsection">
                        //                 <h3>A canceled product is empty</h3>
                        //             </div>
                        //         </div>
                        //     </div>
                        // </div>`;
                    }
                    $(`#${tabName} .table-responsive table tbody`).html(html);
                }
            });
        } else if ($(this).attr('href') == '#onhold') {
            $.ajax({
                url: '/admin/sortOrder',
                method: 'post',
                dataType: 'json',
                data: {
                    "_token": csrf,
                    "status": 0,
                },
                success: function (res) {
                    var html = '';
                    if (res.data.length > 0) {
                        res.data.forEach((element, index) => {
                            html += `<div class="col-lg-4 col-md-6">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="detailsection">
                                        <div class="img"><img src="/${element.image}" class="imgsection"></div>
                                        <div class=""><h6 class="card-title">${element.name}</h6>
                                            <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;${element.order_number}</p>
                                            <p class="cardtxt"> <strong>Size:</strong> &nbsp;${element.sizeName}</p>
                                            <p class="cardtxt"> <strong>Color:</strong> &nbsp;${element.colorName}</p>
                                            <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;${element.sku}</p>
                                            <p class="cardtxt"> <strong>QTY: </strong> &nbsp;${element.quantity}</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>`;
                        });
                    } else {
                        html += `<div class="row emptyProduct">
                        <div class="card border, rs_size">
                            <div class="card-body">
                                <div class="detailsection">
                                    <h3>The product on hold is empty</h3>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    }
                    $(`#${tabName} .row`).html(html);
                }
            });
        }
    });

    $('#pending').on('click','.btnaccept',function() {
        orderid = $(this).data('cid');
        console.log($(this).data('cid'));
        $.ajax({
            url: '/admin/changeOrderStatus',
            method: 'post',
            dataType: 'json',
            data: {
                "_token": csrf,
                "status": 2,
                "order_id": $(this).data('cid'),
            },
            success: function (res) {
                if (res.status) {
                    toastr.success(res.message);
                    $('.nav-link.active').trigger('click');
                    var html = '';
                    // res['courier']['courier_data'].forEach(element => {
                    //     html += `<option value="${element.id}">${element.name}</option>`;
                    // });
                    // courier = res['courier']['courier_data'];
                    // $('#courier-name').html(html);
                    // $('#staticBackdrop').modal('show');
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });

    // $('#pending').on('click', '.btnaccept', function(){
        // orderid = $(this).data('cid');
        // $.ajax({
        //     url: '/admin/changeOrderStatus',
        //     method: 'post',
        //     dataType: 'json',
        //     data: {
        //         "_token": csrf,
        //         "status": 2,
        //         "order_id": $(this).data('cid'),
        //     },
        //     success: function (res) {
        //         if (res.status) {
        //             toastr.success(res.message);
        //             $('.nav-link.active').trigger('click');
        //             var html = '';
        //             // res['courier']['courier_data'].forEach(element => {
        //             //     html += `<option value="${element.id}">${element.name}</option>`;
        //             // });
        //             // courier = res['courier']['courier_data'];
        //             // $('#courier-name').html(html);
        //             // $('#staticBackdrop').modal('show');
        //         } else {
        //             toastr.error(res.message);
        //         }
        //     }
        // });
    // });

    // $('#staticBackdrop').on('change','#courier-name',function() {
    //     // console.log(courier, $('#courier-name').find(":selected").val());
    //     // console.log(courier.filter(x => x.id == $('#courier-name').find(":selected").val()));
    //     var courier_data = courier.filter(x => x.id == $('#courier-name').find(":selected").val());

    //     $('.min_weight').text(courier_data[0]['min_weight']);
    //     $('.real_time').text(courier_data[0]['realtime_tracking']);
    //     $('.delivery_boy').text(courier_data[0]['delivery_boy_contact']);
    //     $('.pod').text(courier_data[0]['pod_available']);
    //     $('.call_before').text(courier_data[0]['call_before_delivery']);

    // });

    // $('#staticBackdrop').on('click','#AddShipment',function() {
    //     var courier_awb = courier.filter(x => x.id == $('#courier-name').find(":selected").val());
    //     console.log(courier_awb[0]['id']);
    //     $.ajax({
    //         url: '/admin/shipment',
    //         method: 'post',
    //         dataType: 'json',
    //         data: {
    //             "_token": csrf,
    //             "order_id": orderid,
    //             "courier_id": courier_awb[0]['id'],
    //         },
    //         success: function (res) {
    //             if (res.status) {
    //                 toastr.success(res.message);
    //                 $('.nav-link.active').trigger('click');
    //             } else {
    //                 toastr.error(res.message);
    //             }
    //         }
    //     });
    // });

    $('#pending').on('click', '.btncancel', function(){
        $.ajax({
            url: '/admin/changeOrderStatus',
            method: 'post',
            dataType: 'json',
            data: {
                "_token": csrf,
                "status": 4,
                "order_id": $(this).data('cid'),
            },
            success: function (res) {
                if (res.status) {
                    toastr.success(res.message);
                    $('.nav-link.active').trigger('click');
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });

    $('#readytoshop').on('click', '.btnlabel', function(){
        $.ajax({
            url: '/admin/changeOrderStatus',
            method: 'post',
            dataType: 'json',
            data: {
                "_token": csrf,
                "status": 3,
                "order_id": $(this).data('cid'),
            },
            success: function (res) {
                if (res.status) {
                    toastr.success(res.message);
                    $('.nav-link.active').trigger('click');
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });
});

function fetchCategory() {
    $.ajax({
        url: '/admin/fetchOrder',
        method: 'post',
        dataType: 'json',
        data: {
            "_token": csrf,
            "limit": $('#perPageItem').val(),
            "offset": $('#perPageItem').val() * pageIndex,
            "search": categorySearch,
            "sort": $('#sortOrder').val(),
            "mainCategoryId": maincategoryId
        },
        success: function (res) {
            var html = '';
            res.data.forEach((element, index) => {
                html += `<tr>
                    <td>${$('#perPageItem').val() * pageIndex + (index + 1)}</td>
                    <td>${element.order_number}</td>
                    <td>${element.name}</td>
                    <td>&#8377; ${element.total_amount}</td>
                    <td>${element.payment_method}</td>
                    <td>${element.payment_status}</td>
                    <td>${moment(element.added_datetime).format('DD-MM-YYYY h:mm:ss A')}</td>
                    <td><a href="/admin/orderDetails/${element.order_number}"><i class="bi bi-receipt"></i></a></td>
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