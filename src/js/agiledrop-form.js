jQuery(document).ready(function( $ ) {

    $('#agiledrop-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var name    = form.find('#name').val(),
            company = form.find( '#company' ).val(),
            email   = form.find( '#email' ).val(),
            subject = form.find( '#subject' ).val(),
            message = form.find( '#message' ).val(),
            ajaxUrl = form.data( 'url');

        if ( name === '') {
            $('#name').addClass('input-error');
            $('#name-error').text( 'Name field required' );
            return;
        }
        if ( company === '') {
            $('#company').addClass('input-error');
            $('#company-error').text( 'Company field required' );
            return;
        }
        if ( subject === '') {
            $('#subject').addClass('input-error');
            $('#subject-error').text( 'Subject field required' );
            return;
        }
        if ( email === '') {
            $('#email').addClass('input-error');
            $('#email-error').text( 'Email field required' );
            return;
        }
        if ( message === '') {
            $('#message').addClass('input-error');
            $('#message-error').text( 'Message field required' );
            return;
        }

        $.ajax({
            url: ajaxUrl,
            type: 'post',
            data: {
                name: name,
                company: company,
                email: email,
                subject: subject,
                message: message,
                action: 'agiledrop_save_form'
            },
            error: function ( response ) {
                $('#form-status').text( 'Something went wrong please try later.');
            },
            success: function( response ) {
                if ( response === false) {
                    $('#form-status').text( 'Something went wrong please try later.');
                }
                else {
                    $('#form-status').text( 'Your message was successfully send.');
                }
            }
        })

    })

});