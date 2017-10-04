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
            beforeSubmit: function ($element) {
            },
            afterSubmit: false,
            alterData: false,
            steps: false,
            ignoreInputs: []
        };

        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element
        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);

            $element.submit(function (e) {
                e.preventDefault();
                e.stopPropagation();
                submitHandler();
                return false;
            });

        };

        var getData = function () {
            var formData = $element.serializeArray();
            if (plugin.settings.alterData !== false) {
                return plugin.settings.alterData.apply($element, [formData]);
            }

            return ignoreInputs(formData);

        };

        var ignoreInputs = function (data) {

            if (!plugin.settings.ignoreInputs.length) {
                return data;
            }
            var newData = [];

            for (var i in  data) {
                var input = data[i];
                for (var j in plugin.settings.ignoreInputs) {
                    var ignoreName = plugin.settings.ignoreInputs[j];
                    if (input.name.indexOf(ignoreName) === -1) {
                        newData.push(input);
                    }
                }
            }
            return newData;
        };

        var stepsErrors = function (errors) {
            //erase all.
            $element.find('[aria-controls^=steps]').removeClass('text-danger');

            var localIndex = 0;
            formErrors($element, errors, function ($input, selector, index, total) {
                var $container = $input.closest('fieldset');
                var id = $container.attr('aria-labelledby');

                if (!id) {
                    return;
                }

                id = id.replace('-h-', '-t-');

                var $title = $element.find('#' + id);

                if ($title.length) {
                    if (!$title.hasClass('text-danger')) {
                        $title.addClass('text-danger');
                    }

                    if (localIndex == 0) {
                        $title.click();
                    }
                }

                localIndex++;
            });

        };

        var submitHandler = function () {
            $.ajax({
                url: $element.attr('action'),
                method: $element.attr('method'),
                data: getData(),
                dataType: 'json',
                beforeSend: function ($element) {
                    plugin.settings.beforeSubmit($element);
                },
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
                    // console.log(r, status, z);
                    if (plugin.settings.steps === true) {
                        stepsErrors(r.responseJSON.errors);
                    }
                    formErrors($element, r.responseJSON.errors);
                }
            });
        };


        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.form2 = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            if (undefined == $(this).data('form2')) {
                var plugin = new $.form2(this, options);
                $(this).data('form2', plugin).addClass('form2');
            }
        });
    }

})(jQuery);
