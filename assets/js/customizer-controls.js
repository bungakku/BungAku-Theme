/**
 * Customizer controls: warnings for the site title accent (added in 1.8.0).
 * Warns when the accent colour is hard to read on the header background and
 * when the accent text does not occur in the site title.
 *
 * @package BungAku_Theme
 */
(function(api) {
    'use strict';

    var strings = window.bungakuThemeControls || {};

    // WCAG relative luminance of a #rgb or #rrggbb colour, or null when it is not one.
    function luminance(hex) {
        hex = String(hex || '').replace('#', '');
        if (hex.length === 3) {
            hex = hex.replace(/(.)/g, '$1$1');
        }
        if (!/^[0-9a-f]{6}$/i.test(hex)) {
            return null;
        }
        var channels = [0, 2, 4].map(function(start) {
            var value = parseInt(hex.substr(start, 2), 16) / 255;
            return value <= 0.03928 ? value / 12.92 : Math.pow((value + 0.055) / 1.055, 2.4);
        });
        return 0.2126 * channels[0] + 0.7152 * channels[1] + 0.0722 * channels[2];
    }

    function contrast(first, second) {
        var a = luminance(first);
        var b = luminance(second);
        if (null === a || null === b) {
            return null;
        }
        return (Math.max(a, b) + 0.05) / (Math.min(a, b) + 0.05);
    }

    // WordPress stores the site name HTML-escaped (St Mary&#039;s); compare the text as it reads.
    function decodeEntities(value) {
        var holder = document.createElement('textarea');
        holder.innerHTML = String(value || '');
        return holder.value;
    }

    function setWarning(control, code, message) {
        if (!control) {
            return;
        }
        if (message) {
            control.notifications.add(new api.Notification(code, { type: 'warning', message: message }));
        } else {
            control.notifications.remove(code);
        }
    }

    api.bind('ready', function() {
        function update() {
            var text = String(api('bungaku_theme_title_accent_text').get() || '').trim();
            var colorMessage = '';
            var textMessage = '';

            if (text) {
                var ratio = contrast(
                    api('bungaku_theme_title_accent_color').get() || '#cc4a0a',
                    api('bungaku_theme_header_bg').get() || '#ffffff'
                );
                // The title is large text (3:1); below 4.5:1 it would not pass for body text.
                if (null !== ratio && ratio < 4.5) {
                    colorMessage = (ratio < 3 ? strings.contrastLow : strings.contrastLarge).replace('%s', ratio.toFixed(2));
                }
                if (decodeEntities(api('blogname').get()).toLowerCase().indexOf(text.toLowerCase()) === -1) {
                    textMessage = strings.accentMissing;
                }
            }

            setWarning(api.control('bungaku_theme_title_accent_color'), 'bungaku_theme_low_contrast', colorMessage);
            setWarning(api.control('bungaku_theme_title_accent_text'), 'bungaku_theme_accent_missing', textMessage);
        }

        [
            'bungaku_theme_title_accent_text',
            'bungaku_theme_title_accent_color',
            'bungaku_theme_header_bg',
            'blogname'
        ].forEach(function(id) {
            api(id, function(setting) {
                setting.bind(update);
            });
        });

        update();
    });

})(wp.customize);
