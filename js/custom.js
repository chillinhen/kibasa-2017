jQuery(document).ready(function ($) {
    // run test on initial page load (and put firstly in document)
    checkSize();
    // run test on resize of the window
    $(window).resize(checkSize);

//some tweaks for smaller windows
    function checkSize() {
        if ($(".toggle-nav").css("display") == "block") {
            
            $('.languages-menu').affix({
                offset: 50
            })
        } else {

            }
            //switch justified nav
            //$('.row.navigation ul.nav.navbar-nav').addClass('nav-tabs').addClass('nav-justified').removeClass('navbar-nav');
            //$('.current_page_item').parent('ul').parent('li').addClass('active');
            //$('li.active').parent('ul').parent('li').addClass('active').parent('ul').parent('li').addClass('active');

        }
        
    //small Tweak for navigation facebook link
    $("#navigation ul.nav > li.facebook a").attr('target','_blank');
    $("#navigation ul.nav > li.facebook a:contains('kibasa')").html(function(_, html) {
       return html.replace(/(kibasa)/g, '<span>$1</span>');
    });
    $('#menu-footer-menu li.facebook > a').wrapInner('<span></span>');

});

