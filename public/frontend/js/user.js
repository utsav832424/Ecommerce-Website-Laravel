var csrf = $('input[name="_token"]').val();
$(function() {
    
    $('#users_form').on('submit', function(e) {
        e.preventDefault();
        
        var name = $('#users_name').val();
        var mobile = $('#mobile').val();
        var token = $('input[name="_token"]').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var action = $(this).attr('action');
        var Confirm_password = $('#Confirm_password').val();
        // console.log("Sahil",Confirm_password);
        if (name == "") {
            toastr.error('Please Enter Users Name')
        } else if (mobile == "") {
            toastr.error('Please Enter Mobile Number')
        } else if (email == "") {
            toastr.error('Please Enter Email')
        } else if (password == "") {
            toastr.error('Please Enter Password')
        } else if (Confirm_password == "") {
            toastr.error('Please Enter Confirm Password')
        } else if (Confirm_password != password) {
            toastr.error('Confirm Password must be same like to password')
        } else {
            var data = new FormData();
            data.append('name', name);
            data.append('mobile', mobile);
            data.append('_token', token);
            data.append('email', email);
            data.append('password', password);
            data.append('cpassword', Confirm_password);
            
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
                        if (res.redirect) {
                            setTimeout(() => {
                                window.location.href = res.url;
                            }, 2000);
                        }
                        
                    } else {
                        toastr.error(res.message);
                    }
                    
                }
            })
        }
    });
});
