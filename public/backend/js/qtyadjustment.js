var csrf = $('input[name="_token"]').val();
var pageIndex = 0;
var editId = 0;
var categorySearch = "";
var maincategoryId = "";
$(function() {

    $('.select2-example').select2({
        placeholder: 'Select'
    });

    fetchCategory();

    $('#qtyadjustment_form').on('submit', function(e) {
        e.preventDefault();
        
        var product_id = $('#product-name').val();
        var quantity = $('#quantity').val();
        var token = $('input[name="_token"]').val();
        var action = $(this).attr('action');

        if (product_id == "") {
            toastr.error('Please Select Product Name');
        } else if (quantity == "") {
            toastr.error('Please Enter Quantity');
        } else {
            var data = new FormData();
            data.append('product_id', product_id);
            data.append('quantity', quantity);
            data.append('_token', token);
            
            if (editId != 0) {
                action = action.replace("qty_adjustment", "updateSize");
                data.append('editId', editId);
            }
    
            $.ajax({
                url: action,
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        $('#staticBackdrop').modal('hide');
                        fetchCategory();
                    } else {
                        toastr.error(res.message);
                    }
                    
                }
            })
        }
    });

    $('#categoriesTable tbody').on('click','.dropdown-item.edit', function() {
        $('#staticBackdropLabel').html("Edit Quantity");
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

    $('#AddCategoryBtn').click(function() {
        $('#staticBackdropLabel').html("Add Quantity");
        $('#staticBackdrop').find('.modal-footer').find('.btn-success').text('Add');
        editId = 0;
        $('#name').val("");
        $('#color').val("");
        $('#isActive').prop('checked', false);
        $('#staticBackdrop').modal('show');
    });

    $(".pagination").on('click', '.page-link', function() {
        // console.log($(this).data('page'));
        pageIndex = $(this).data('page');
        fetchCategory();
    });

    $('#categorySearch').on('keyup', function() {
        categorySearch = $(this).val().trim();
        fetchCategory();
    });

    $('#perPageItem').on('change', function() {
        pageIndex = 0;
        fetchCategory();
    });

    $('#categoryDropDown').on('change', function() {
        maincategoryId = $(this).val();
        fetchCategory();
    });

    $('.number-field').on('keypress', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
});

function fetchCategory() {
    $.ajax({
        url: '/admin/fetchQty',
        method: 'post',
        dataType: 'json',
        data: {
            "_token": csrf,
            "limit": $('#perPageItem').val(),
            "offset": $('#perPageItem').val() * pageIndex,
            "search": categorySearch,
            "sort": $('#sortOrder').val(),
            "mainCategoryId":maincategoryId
        },
        success: function(res) {
            var html = '';
            res.data.forEach((element, index) => {
                html += `<tr>
                    <td>${$('#perPageItem').val() * pageIndex + (index + 1)}</td>
                    <td>${element.name}</td>
                    <td>${element.qty}</td>
                    <td>${moment(element.added_datetime).format('DD-MM-YYYY h:mm:ss A')}</td>
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