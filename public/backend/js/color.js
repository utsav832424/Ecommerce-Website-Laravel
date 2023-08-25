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

    $('#color_form').on('submit', function(e) {
        e.preventDefault();
        
        var name = $('#name').val();
        var color = $('#color').val();
        var active = $('#isActive').is(":checked");
        var token = $('input[name="_token"]').val();
        var action = $(this).attr('action');

        if (name == "") {
            toastr.error('Please Enter Color Name')
        } else if (color == "") {
            toastr.error('Please Select Color')
        } else {
            var data = new FormData();
            data.append('name', name);
            data.append('color', color);
            data.append('_token', token);
            data.append('isActive', (active) ? 1 : 0);
            if (editId != 0) {
                action = action.replace('addColor', 'updateColor');
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
        $('#staticBackdropLabel').html("Edit Color");
        $('#staticBackdrop').find('.modal-footer').find('.btn-success').text('Save');
        editId = $(this).closest('tr').data('id');
        console.log(editId);
        var name = $(this).closest('tr').children().eq(1).text();
        var color = $(this).closest('tr').children().eq(2).data('color');
        var active = $(this).closest('tr').children().eq(3).text();
        $('#name').val(name);
        $('#color').val(color);

        if (active.trim() == "Active") {
            $('#isActive').prop('checked', true);
        } else {
            $('#isActive').prop('checked', false);
        }
        $('#staticBackdrop').modal('show');
    });

    $('#AddCategoryBtn').click(function() {
        $('#staticBackdropLabel').html("Add Color");
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
});

function fetchCategory() {
    $.ajax({
        url: '/admin/fetchColor',
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
                html += `<tr data-id="${element.id}">
                    <td>${$('#perPageItem').val() * pageIndex + (index + 1)}</td>
                    <td>${element.name}</td>
                    <td data-color="${element.color_code}"><p style="height: 25px;width:25px;border-radius: 15px;border: 1px solid rgba(0,0,0, 0.2);background-color: ${element.color_code};"></p></td>`;
                if (element.isActive == 1) {
                    html += `<td>
                        <span class="badge bg-success">Active</span>
                    </td>`;
                } else {
                    html += `<td>
                        <span class="badge bg-danger">Deactive</span>
                    </td>`;
                }
                
                html +=  `<td class="text-end">
                        <div class="d-flex">
                            <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item edit">Edit</a>
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