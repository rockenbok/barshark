jQuery.validator.addMethod('answercheck', function (value, element) {
        return this.optional(element) || /^\bcat\b$/.test(value);
    }, "type the correct answer -_-");

// validate contact form
$(function() {
    $('#contact').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            message: {
                required: true
            },
            answer: {
                required: true,
                answercheck: true
            }
        },
        messages: {
            name: {
                required: "What's your name?",
                minlength: "Your name must consist of at least 2 characters."
            },
            email: {
                required: "Please enter your contact email address."
            },
            message: {
                required: "What would you like to talk about?",
            }
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                data: $(form).serialize(),
                url:"process.php",
                success: function() {
                    $('#loadingDiv').hide("fast");
                    $('#contact :input').attr('disabled', 'disabled');
                    $('#contact').fadeTo( "slow", 0.15, function() {
                        $(this).find(':input').attr('disabled', 'disabled');
                        $(this).find('label').css('cursor','default');
                        $('#success').fadeIn();
                    });
                },
                error: function() {
                    $('#loadingDiv').hide("fast");
                    $('#contact').fadeTo( "slow", 1, function() {
                        $('#error').fadeIn();
                    });
                },
                beforeSubmit: function(arr, $form, options) { 
                    $('#loadingDiv').show().html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                }
            });
        }
    });
});
