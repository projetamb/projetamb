$(function () {
    $('#carousel').carousel({
        interval:5000,
        pause: "false"
    });
    $('#playBtn').click(function () {
        $('#carousel').carousel('cycle');
    });
    $('#pauseBtn').click(function () {
        $('#carousel').carousel('pause');
    });
});
  


