var $ = $ || jQuery;

// todo rewrite to async function
(function() {
    var link = document.createElement( "link" );
    link.href = "https://fonts.googleapis.com/earlyaccess/opensanshebrew.css&display=swap";
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    document.getElementsByTagName( "head" )[0].appendChild( link );
    link.onload = function() {document.body.classList.add('loaded')};
})()

// }
//
//
$('.single-share').on('click', 'a', function (e) {
    e.preventDefault();
    window.open(this.href, 'targetWindow', 'toolbars=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1,width=640,height=320,left=300,top=200');
})

var toc = document.querySelector('#rightBar');

if (toc) {
    window.addEventListener('scroll', function () {
        var entryContent = document.querySelector('.entry-content');

        if (scrollY > entryContent.offsetTop - 100 && scrollY < entryContent.offsetHeight + 500) {
            toc.classList.add('active');
        } else {
            toc.classList.remove('active');
        }
    });
}

var usefulLinks = document.querySelector('#nav_menu-2');

if (usefulLinks) {
    var usefulLinksPosition = usefulLinks.offsetTop;
    window.addEventListener('scroll', function () {

        if (scrollY > usefulLinksPosition) {
            usefulLinks.classList.add('active');
        } else {
            usefulLinks.classList.remove('active');
        }
    });
}
jQuery(function ($) {
    $('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

            if (target.length) {
                if ($('.post__toc-link').hasClass('active')) {
                    jQuery('.post__toc-link').removeClass('active');
                }

                $(this).addClass('active');
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
                return false;
            }
        }
    });
});
var headers = $('h2');
var navigation = jQuery('.post__toc');
jQuery(window).on('scroll', function () {
    var cur_pos = $(this).scrollTop();
    headers.each(function () {
        var top1 = $(this).offset().top - 200,
            bottom = top1 + $(this).outerHeight();

        if (cur_pos >= top1 && cur_pos <= bottom) {
            navigation.find('a').removeClass('active');
            navigation.find('a[href="#' + $(this).attr('id') + '"]').addClass('active');
        }
    });
});


$('.quick-form').submit(function(e){
    e.preventDefault();
    var form = $(this);
    let honeyPot = form.find('.fullname').val();

    if ( honeyPot == "" || honeyPot == null ){

        jQuery.ajax({
            type: "POST",
            url: ajax_object.ajaxurl,
            data: form.serialize(),
            success: function(data) {
                if(data.code == 200) {
                    form.hide();
                    form[0].reset();
                }
                form.next().html(data.text);


            }
        });
    }
})

$('.content__cta a').on('click', function (e){
    e.preventDefault();
    $(this).hide();
    $(this).next().show();
})
