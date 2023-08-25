var pageIndex = 0;
$(function() {
    fetchOrder();
});

function fetchOrder() {
    $.ajax({
        url: '/fetchOrder',
        method: 'post',
        dataType: 'json',
        data: {
            "_token": _token,
            "limit": 10,
            "offset": $('#perPageItem').val() * pageIndex,
            // "search": categorySearch,
            "sort": $('#sortOrder').val(),
            // "mainCategoryId":maincategoryId
        },
        success: function(res) {
            var html = '';
            res.data.forEach(element => {
                html += `<tr>
                    <td>${element.id}</td>
                    <td>${element.order_number}</td>
                    <td>${moment(element.added_datetime).format('DD-MM-YYYY h:mm:ss A')}</td>
                    <td>${(element.status == 1) ? 'Paid':'Unpaid'}</td>
                    <td>&#8377; ${element.total_amount}</td>`;
                
                html +=  `<td class="text-end">
                                <a href="/orderDetails/${element.order_number}">
                                    <i class="fa fa-file-text-o"></i>
                                </a>
                            </td>
                        </tr>`;
            });
            $('#orderTable tbody').html(html);

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