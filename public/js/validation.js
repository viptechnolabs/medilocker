let validator;


validator = $('#hospitalDetailsUpdate').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 50,
            not_empty: true,
        },
        details: {
            required: true,
            maxlength: 250,
            not_empty: true,
        },
        register_no: {
            required: true,
            alpha_numeric: true,
            maxlength: 25,
            not_empty: true,
        },
        fex_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty: true,
        }
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter hospital name",
            maxlength: "Please enter maximum 50 characters.",
        },
        details: {
            required: "Please enter hospital details",
            maxlength: "Please enter maximum 250 characters.",
        },
        register_no: {
            required: "Please enter hospital register no",
            maxlength: "Please enter maximum 25 characters.",
        },
        fex_no: {
            required: "Please enter hospital fex no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        pin_code: {
            required: "Please enter hospital pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        address: {
            required: "Please enter hospital address",
            maxlength: "Please enter maximum 500 characters.",
        }
    }
});

validator = $('#addStaff').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty: true,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty: true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty: true,
        },
        state: {
            required: true,
            not_empty: true,
        },
        city: {
            required: true,
            not_empty: true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        aadhaar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        role: {
            required: true,
            not_empty: true,
        },
        gender: {
            required: true,
            not_empty: true,
        },
        dob: {
            required: true,
            not_empty: true,
        },
        avatar: {
            required: true,
            not_empty: true,
        },
        document_pic: {
            required: true,
            not_empty: true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter user name",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please select state",
        },
        city: {
            required: "Please enter city",
        },
        address: {
            required: "Please enter user address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhaar_no: {
            required: "Please enter aadhaar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        gender: {
            required: "Please enter gender",
        },
        dob: {
            required: "Please enter date of birth",
        },
        profile_photo: {
            required: "Please upload profile photo",
        },
        document: {
            required: "Please upload document photo",
        },
    }
});

validator = $('#staffDetailsUpdate').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty: true,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty: true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty: true,
        },
        state: {
            required: true,
            not_empty: true,
        },
        city: {
            required: true,
            not_empty: true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        aadhaar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty: true,
        },
        role: {
            required: true,
            not_empty: true,
        },
        gender: {
            required: true,
            not_empty: true,
        },
        dob: {
            required: true,
            not_empty: true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter user name",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please select state",
        },
        city: {
            required: "Please enter city",
        },
        address: {
            required: "Please enter user address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhaar_no: {
            required: "Please enter aadhaar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        gender: {
            required: "Please enter gender",
        },
        dob: {
            required: "Please enter date of birth",
        },
    }
});
