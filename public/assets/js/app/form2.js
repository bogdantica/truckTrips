/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "form2" to the name of your plugin!
(function ($) {
//    http://bootstrap-notify.remabledesigns.com/
    // here we go!
    $.form2 = function (element, options) {
        var defaults = {
            afterSubmit: false
        };
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element
        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);

            plugin.form = $element;

            plugin.form.submit(function (e) {
                submitHandler();
                return false;
            });

        };

        var submitHandler = function () {
            $.ajax({
                url: plugin.form.attr('action'),
                method: plugin.form.attr('method'),
                data: plugin.form.serialize(),
                dataType: 'json',
                success: function (r, status, x) {
                    if (plugin.settings.afterSubmit) {

                        if (typeof r == 'string') {
                            r = $(r);
                        }

                        plugin.settings.afterSubmit($element, r);
                    } else {
                        if (r.redirect) {
                            window.location = r.redirect;
                        }
                    }
                },
                error: function (r, status, z) {
                    //todo
                    console.log(r, status, z);
                    formErrors($element, r.responseJSON.errors);
                }
            });
        };

        plugin.init();

    }

    // add the plugin to the jQuery.fn object
    $.fn.form2 = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            if (undefined == $(this).data('form2')) {
                var plugin = new $.form2(this, options);
                $(this).data('form2', plugin);
            }
        });
    }

})(jQuery);
