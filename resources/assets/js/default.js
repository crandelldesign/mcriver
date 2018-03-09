// Default Scripts
$(document).ready(function() {

    // Load Modal
    if((window.location.href.indexOf('?login') != -1) && (typeof loggedin === 'undefined')) {
        $('#loginModal').modal('show');
    }

    // Forgot Password
    $('#forgot-password-modal-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(), // serializes the form's elements.
            success: function(data)
            {
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
