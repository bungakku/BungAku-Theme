/**
 * Customizer preview enhancements for BungAku-Theme
 * Handles live updates for site description hiding on tablet/mobile,
 * and live updates for tagline alignment.
 *
 * @package BungAku_Theme
 */
(function($, api) {
    'use strict';

    var $style = $('<style id="bungaku-theme-hide-description-preview"></style>').appendTo('head');

    function updateDescriptionVisibility() {
        var hideTablet = api('bungaku_theme_hide_description_tablet').get();
        var hideMobile = api('bungaku_theme_hide_description_mobile').get();
        var css = '';

        if (hideTablet) {
            css += '@media (min-width: 481px) and (max-width: 768px) { .site-description { display: none !important; } } ';
        }
        if (hideMobile) {
            css += '@media (max-width: 480px) { .site-description { display: none !important; } } ';
        }

        $style.html(css);
    }

    api('bungaku_theme_hide_description_tablet', function(setting) {
        setting.bind(updateDescriptionVisibility);
    });
    api('bungaku_theme_hide_description_mobile', function(setting) {
        setting.bind(updateDescriptionVisibility);
    });

    // No initial updateDescriptionVisibility() call: the settings are not registered in the preview yet when this runs (api( id ) is undefined, so .get() threw and the tagline code below was never reached), and the server already renders the current state.

    var validTaglineAlign = ['left', 'center', 'right'];

    function updateTaglineAlign(value) {
        if (validTaglineAlign.indexOf(value) === -1) {
            value = 'center';
        }
        // 1.7.83: start/end, as in inc/customizer-css.php, so the preview follows the text direction too.
        if (value === 'left') {
            value = 'start';
        } else if (value === 'right') {
            value = 'end';
        }
        document.documentElement.style.setProperty('--mec-tagline-align', value);
    }

    api('bungaku_theme_tagline_align', function(setting) {
        updateTaglineAlign(setting.get());
        setting.bind(updateTaglineAlign);
    });

})(jQuery, wp.customize);
