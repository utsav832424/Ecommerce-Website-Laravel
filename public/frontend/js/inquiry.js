var csrf = $('input[name="_token"]').val();
$(function() {
    $('#contact_form').on('submit', function(e) {
        e.preventDefault();
        
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();
        
        var token = $('input[name="_token"]').val();
        var action = $(this).attr('action');
    
        if (name == "") {
            toastr.error('Please Enter Name')
        }else if (email == "") {
            toastr.error('Please Enter Email')   
        }else if (message == "") {
            toastr.error('Please Enter Message')   
        }  
        else {
            var data = new FormData();
            data.append('name', name);
            data.append('email', email);
            data.append('message', message);
            data.append('_token', token);
    
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
                        window.location.reload();
                    } else {
                        toastr.error(res.message);
                    }
                    
                }
            })
        }
    });
});
