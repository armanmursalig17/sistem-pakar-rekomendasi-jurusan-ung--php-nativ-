$(document).ready(function() {
   
    $('.hero-content > *').each(function(index) {
        $(this).css('animation-delay', (index * 0.3) + 's');
    });
});