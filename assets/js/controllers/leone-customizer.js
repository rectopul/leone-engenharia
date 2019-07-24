jQuery( document ).ready(function($) {
    wp.customize('leone_ourcompany_content', function(control) {        
        control.bind(function( controlValue ) {
            console.log('admin page')
            if( controlValue ) {
                // If the switch is on, add the search icon
                $('.leone-sobre').append('<small>Continue Lendo...</small>')
            }
            else {
                // If the switch is off, remove the search icon
                $('.leone-sobre').append('<del>Nada salvo</del>')
            }
       });
    });
 });