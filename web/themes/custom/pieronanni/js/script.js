jQuery('document').ready(function($) {

    $('body').on('click', '.project__open-deatails', function(){
        
        var nid = $(this).data('nid');

        $.ajax({
            url: '/ajax/project/details/'+nid,
            success: function(result){
                var output = '';
                output = output + '<div class="popup__scroller">';
                output = output + '<div class="popup container">';
                output = output + '<div class="popup__content">';

                output = output + '<div class="popup__title"><span>'+result[0].title+'</span><span class="popup__close" title="Close">[x]</span></div>';

                output = output + '<div class="row">';
                    output = output + '<div class="col-sm-4">';
                        output = output + '<div class="popup__image">'+result[0].field_image+'</div>';
                    output = output + '</div>'; // close col-sm-4

                    output = output + '<div class="col-sm-8">';
                        output = output + '<div class="popup__body">'+result[0].body+'</div>';
                        output = output + '<div class="popup__url"><a href="'+result[0].field_url+'" target="_blank">View site</a></div>';
                    output = output + '</div>'; // close col-sm-8
                output = output + '</div>'; // close row
                
                output = output + '</div>'; // close content
                output = output + '</div>'; // close popup
                output = output + '</div>'; // close scroller

                $('html').addClass('popup-open');
                $('body').append(output);

                setTimeout(function() {
                    $('.popup').addClass('in');
                }, 100);

                $('.popup__image ul').slick({
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true
                });
                
            }
        });

    });

    $('body').on('click', '.popup__close', function(){
        $('html').removeClass('popup-open');
        
        $('.popup').removeClass('in');

        setTimeout(function() {
            // $('.overlay').remove();
            $('.popup__scroller').remove();
        }, 500);
        
        
    });

    $('body').on('click', '.popup__scroller', function(e){
        if(e.target != this) return;
        $('.popup__close').trigger('click');
    });
});