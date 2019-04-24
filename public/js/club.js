$("#button1").click(function() {
    $('html,body').animate({
            scrollTop: $("#club_disciplines").offset().top},
        'slow');
});

$("#button2").click(function() {
    $('html,body').animate({
            scrollTop: $("#club_bureau").offset().top},
        'slow');
});

$("#button3").click(function() {
    $('html,body').animate({
            scrollTop: $(".club_description").offset().top},
        'slow');
});