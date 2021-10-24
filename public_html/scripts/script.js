$(document).ready(function() {
    $('.navbar-wrap-gamburger').click(function(event) {
        $('.navbar-wrap-gamburger, .navbar, .menu').toggleClass('active');
        $('body').toggleClass('lock');
    });
    $('.menu-button').click(function(event) {
        $('.navbar-wrap-gamburger, .navbar, .menu').toggleClass('active');
        $('body').toggleClass('lock');
    });
    $('.logo_navbar__logo').click(function(event) {
        $('.navbar-wrap-gamburger, .navbar, .menu').toggleClass('active');
        $('body').toggleClass('lock');
    });
});