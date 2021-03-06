// Auto update layout
if (window.layoutHelpers) {
    window.layoutHelpers.setAutoUpdate(true);
}

// Collapse menu
(function () {
    if (
        $("#layout-sidenav").hasClass("sidenav-horizontal") ||
        window.layoutHelpers.isSmallScreen()
    ) {
        return;
    }

    try {
        window.layoutHelpers.setCollapsed(
            localStorage.getItem("layoutCollapsed") === "true",
            false
        );
    } catch (e) {}
})();

$(function () {
    // Initialize sidenav
    $("#layout-sidenav").each(function () {
        new SideNav(this, {
            orientation: $(this).hasClass("sidenav-horizontal")
                ? "horizontal"
                : "vertical",
        });
    });

    // Initialize sidenav togglers
    $("body").on("click", ".layout-sidenav-toggle", function (e) {
        e.preventDefault();
        window.layoutHelpers.toggleCollapsed();
        if (!window.layoutHelpers.isSmallScreen()) {
            try {
                localStorage.setItem(
                    "layoutCollapsed",
                    String(window.layoutHelpers.isCollapsed())
                );
            } catch (e) {}
        }
    });
    // Swap dropdown menus in RTL mode
    if ($("html").attr("dir") === "rtl") {
        $("#layout-navbar .dropdown-menu").toggleClass("dropdown-menu-right");
    }
});

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// window.axios = require('axios');
//
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

// let token = document.head.querySelector('meta[name="csrf-token"]');
//
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
