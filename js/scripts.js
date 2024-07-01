"use strict";

var $ = $ || jQuery; // todo rewrite to async function

(function () {
    var link = document.createElement("link");
    link.href = "https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap";
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    document.getElementsByTagName("head")[0].appendChild(link);

    link.onload = function () {
        document.body.classList.add('loaded');
    };
})(); // }
//
//


$('.single-share').on('click', 'a', function (e) {
    e.preventDefault();
    window.open(this.href, 'targetWindow', 'toolbars=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1,width=640,height=320,left=300,top=200');
});
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
$('.quick-form').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var honeyPot = form.find('.fullname').val();

    if (honeyPot == "" || honeyPot == null) {
        jQuery.ajax({
            type: "POST",
            url: ajax_object.ajaxurl,
            data: form.serialize(),
            success: function success(data) {
                if (data.code == 200) {
                    form.hide();
                    form[0].reset();
                }

                form.next().html(data.text);
            }
        });
    }
});
$('.content__cta a').on('click', function (e) {
    e.preventDefault();
    $(this).hide();
    $(this).next().show();
});
"use strict";

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
    var siteHeader, container, button, menu, links, i, len;
    siteHeader = document.getElementsByClassName('site-branding')[0];

    if (!siteHeader) {
        return;
    }

    container = document.getElementById('site-navigation');

    if (!container) {
        return;
    }

    button = document.getElementById('menu-toggle');

    if ('undefined' === typeof button) {
        return;
    }

    menu = container.getElementsByTagName('ul')[0]; // Hide menu toggle button if menu is empty and return early.

    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');

    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function () {
        if (-1 !== container.className.indexOf('toggled')) {
            document.body.className = document.body.className.replace(' open-nav', '');
            button.className = button.className.replace(' active', '');
            container.className = container.className.replace(' toggled', '');
            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-expanded', 'false');
            siteHeader.setAttribute('aria-expanded', 'false');
        } else {
            document.body.className += ' open-nav';
            button.className += ' active';
            container.className += ' toggled';
            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-expanded', 'true');
            siteHeader.setAttribute('aria-expanded', 'true');
        }
    }; // Get all the link elements within the menu.


    links = menu.getElementsByTagName('a'); // Each time a menu link is focused or blurred, toggle focus.

    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }
    /**
     * Sets or removes .focus class on an element.
     */


    function toggleFocus() {
        var self = this; // Move up through the ancestors of the current link until we hit .nav-menu.

        while (-1 === self.className.indexOf('nav-menu')) {
            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }
    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */


    (function (container) {
        var touchStartFn,
            i,
            parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

        if ('ontouchstart' in window) {
            touchStartFn = function touchStartFn(e) {
                var menuItem = this.parentNode,
                    i;

                if (!menuItem.classList.contains('focus')) {
                    e.preventDefault();

                    for (i = 0; i < menuItem.parentNode.children.length; ++i) {
                        if (menuItem === menuItem.parentNode.children[i]) {
                            continue;
                        }

                        menuItem.parentNode.children[i].classList.remove('focus');
                    }

                    menuItem.classList.add('focus');
                } else {
                    menuItem.classList.remove('focus');
                }
            };

            for (i = 0; i < parentLink.length; ++i) {
                parentLink[i].addEventListener('touchstart', touchStartFn, false);
            }
        }
    })(container);
})();
"use strict";

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
    var isIe = /(trident|msie)/i.test(navigator.userAgent);

    if (isIe && document.getElementById && window.addEventListener) {
        window.addEventListener('hashchange', function () {
            var id = location.hash.substring(1),
                element;

            if (!/^[A-z0-9_-]+$/.test(id)) {
                return;
            }

            element = document.getElementById(id);

            if (element) {
                if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false);
    }
})();
