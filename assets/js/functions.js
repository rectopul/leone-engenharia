jQuery( document ).ready(function($) {
    jQuery('.content-center').each( function(){
        let width = $(this).innerWidth() / 2
        $(this).css({
            marginTop : (0 - $(this).innerHeight())/2,
            marginLeft : (0 - $(this).innerWidth())/2
        })
        console.log(width)
    })
});