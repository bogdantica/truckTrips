/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "replaceMe" to the name of your plugin!
(function ($) {
    // here we go!
    $.replaceMe = function (element, options) {
        var defaults = {
        };
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element

        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);
        };
        plugin.init();

    }

    // add the plugin to the jQuery.fn object
    $.fn.replaceMe = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            var $this = $(this);
            if (undefined == $this.data('replaceMe')) {
                var plugin = new $.replaceMe(this, options);
                $this.data('replaceMe', plugin)
                    .addClass('replaceMe');
            }
        });
    }

})(jQuery);
