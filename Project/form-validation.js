
$(function() {

  $('#formValidation').validate({

    rules: {
      firstname: "required",
      username: "required",
      lastname: "required",
      menuItem: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },

    submitHandler: function(form) {
      form.submit();
    }
  });
});
