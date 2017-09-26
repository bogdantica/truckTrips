/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "replaceMe" to the name of your plugin!
(function ($) {
    // here we go!
    $.replaceMe = function (element, options) {
        var defaults = {
            endpoint: 'https://maps.googleapis.com/maps/api/place/queryautocomplete/json',
            key: 'AIzaSyAJu5BXndY7H-p-dOd2hr5quwaTIhUiX0k'

        };
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element

        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);
            plugin.container = $element.closest('.placeContainer');

            $element.on('keyup keypress', function () {
                var $this = $(this);
                search($this.val());
            });
        };

        var search = function (keyword) {

        };



        plugin.init();

    }

    // add the plugin to the jQuery.fn object
    $.fn.replaceMe = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            if (undefined == $(this).data('replaceMe')) {
                var plugin = new $.replaceMe(this, options);
                $(this).data('replaceMe', plugin);
            }
        });
    }

})(jQuery);
