let changePasswordValidator;

function changePasswordClick(action) {
    changePasswordValidator = $('#changePassword').validate({
        errorElement: 'span',
        errorClass: 'validation-error',
        rules: {
            currentPassword: {
                required: true,
                remote: {
                    url: action,
                    type: "post",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        userType: $("#userType").val(),
                        currentPassword: function () {
                            return $("#currentPassword").val();
                        }
                    }
                }
            },
            password: {
                required: true
            },
            confirmPassword: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            currentPassword: {
                required: "Please enter current password",
                remote: "Password does not match"
            },
            password: {
                required: "Please enter new password"
            },
            confirmPassword: {
                required: "Please enter retype new password",
                equalTo: "Confirm password does not match",
            }
        }
    });
}

$('#change_pass_modal').on('hidden.bs.modal', function () {
    changePasswordValidator.destroy();
    $('#change_password_form').trigger("reset");
})
