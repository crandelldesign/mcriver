// Default Scripts
$(document).ready(function() {

    // Forgot Password
    $('#forgot-password-modal-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log(data.error); // show response from the php script.
                if (data.error) {
                    $('#forgot-password-modal').find('.alert-success').hide();
                    $('#forgot-password-modal').find('.alert-danger').show().html(data.message);
                } else {
                    $('#forgot-password-modal').find('.alert-danger').hide();
                    $('#forgot-password-modal').find('.alert-success').show().html(data.message);
                }
            }
        });
    });

});
