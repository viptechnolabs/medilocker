function getEmailPopup(action, checkEmailAction, userId, userType) {
    $.ajax({
        url: action,
        type: "post",
        data: {
            userId: userId,
            userType: userType,
        },
        success: function (data) {
            $('#updateEmailPopup').html(data);
            $('#changeEmailModal').modal(true)

            emailPopupValidation(checkEmailAction, userId, userType);
        },
        error: function (error) {
            console.log(error);
        }
    })
}

function emailPopupValidation(checkEmailAction, userId, userType) {
    $('#changeEmailForm').validate({
        errorElement: 'span',
        errorClass: 'validation-error',
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: checkEmailAction,
                    type: "post",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        userType: userType,
                        email: function () {
                            return $("#email").val();
                        },
                        id: function () {
                            return userId
                        }
                    }
                }
            }
        },
        messages: {
            email: {
                required: "Please enter new email",
                remote: "This email already registered with us."
            }
        },
        submitHandler: function (form) {
            verificationEmail();
        },
        success: function (result) {
            console.log(result);
        },
        error: function (error) {
            console.log(error);
            $("#changeEmailModal").modal('hide');
        }
    });
}
