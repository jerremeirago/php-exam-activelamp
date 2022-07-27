$(document).ready(function(){
    var urlShortenerForm = $('#form-url-shortener'); 
    var errorArea = $('#url-error-message');
    var successText = $('.success-area #text');

     urlShortenerForm.on('submit', function(e){
        
        e.preventDefault();
        var ajaxOptions = {
            url : '/',
            method: 'POST',
            data : $(this).serialize()
        };

        $.ajax(ajaxOptions).done(function(data){
            if (data.status == 'success') {

                // show success area
                $('.success-area').removeClass('d-none');

                // hide existing errors
                errorArea.fadeOut();

                successText.fadeOut();
                successText.fadeIn();
                successText.val(data.shortenUrl);
            } else {

                errorArea.fadeOut();
                errorArea.fadeIn();
                errorArea.text(data.error);
            }
        });
     });
});
