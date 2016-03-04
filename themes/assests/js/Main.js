$(window).scroll(function()
{
    if ($(this).scrollTop() > (400)) {
        $('#MainMenu').addClass("MenuFixed").fadeIn();
        $('#MainMenu').css({
            "box-shadow": "0px 1px 4px 0px #333333"
        });
        $('#wrap_center').css({
            "background-attachment": "fixed",
            "margin-top": "5px"
        });
    } else {
        $('#MainMenu').removeClass("MenuFixed");
        $('#wrap_center').css({
            "margin-top": "0px",
            "background-attachment": "inherit"
        });
    }
});
$(document).ready(function() {
    $('#Login').on('click', function() {
        $('#Login_open').slideToggle("slow");
    });
});
