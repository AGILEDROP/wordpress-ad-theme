jQuery(document).ready(function( $ ) {
    $('#agiledrop-work-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var name        = form.find('#name').val(),
            surname     = form.find( '#surname').val(),
            email       = form.find( '#email' ).val(),
            cv          = form.find( '#cv' ).prop("files")[0],
            social      = form.find( '#social' ).val(),
            experience1 = form.find( '#experience1' ).val(),
            experience2 = form.find( '#experience2' ).val(),
            dataProcessing = form.find( '#obdelava-podatkov').prop("checked"),
            ajaxUrl  = form.data( 'url');

        if ( name === '') {
            $('#name-error').css("display", "grid");
            $('#name-error').text( 'Name field required' );
            return;
        }
        if ( surname === '') {
            $('#surname-error').css("display", "grid");
            $('#surname-error').text( 'Surname field required' );
            return;
        }
        if ( email === '') {
            $('#email-error').css("display", "grid");
            $('#email-error').text( 'Email field required' );
            return;
        }
        if ( experience1 === '' ) {
            $('#experience1-error').css("display", "grid");
            $('#experience1-error').text('Experience field required');
            return;
        }
        if ( experience2 === '' ) {
            $('#experience2-error').css("display", "grid");
            $('#experience2-error').text('Experience field required');
            return;
        }

        $.ajax({
            url: ajaxUrl,
            type: 'post',

            data: {
                name: name,
                surname: surname,
                email: email,

                social: social,
                experience1: experience1,
                experience2: experience2,
                dataProcessing: dataProcessing,
                action: 'agiledrop_save_work_form'
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

    });
});

