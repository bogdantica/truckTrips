/**
 * Created by tkagnus on 27/09/2017.
 */
/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "services" to the name of your plugin!
(function ($) {
    // here we go!
    $.services = function (element, options) {
        var defaults = {
            newServiceAction: '.newServiceAction',
            newServiceContainer: '.tripServicesContainer',
            deleteServiceAction: '.deleteServiceAction',
            clearServiceAction: '.clearServiceAction',

            price: '[name$="[price]"]',
            quantity: '[name$="[quantity]"]',
            total: '[name$="[total]"]'
        };

        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element

        var currentIndex = 0;
        var $newAction;
        var $mainContainer;
        var $container;
        var $deleteAction;
        var $clearAction;
        var $price;
        var $quantity;
        var $total;

        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);
            initElements();
            initEvents();
        };

        var initElements = function () {
            $newAction = $element.find(plugin.settings.newServiceAction);
            $mainContainer = $element.closest('.servicesContainer');
            $container = $mainContainer.find(plugin.settings.newServiceContainer);
            $deleteAction = $element.find(plugin.settings.deleteServiceAction);
            $clearAction = $element.find(plugin.settings.clearServiceAction);
            $price = $element.find(plugin.settings.price);
            $quantity = $element.find(plugin.settings.quantity);
            $total = $element.find(plugin.settings.total);
        };

        var initEvents = function () {
            $newAction.click(function () {
                plugin.newService();
            });
            $deleteAction.click(function () {
                plugin.deleteService();
            });
            $clearAction.click(function () {
                $element.find('[name^="services[new][currentIndex]"]')
                    .val(null);
                plugin.removeErrors();
            });
            $price.keyup(function () {
                plugin.total();
            });
            $quantity.keyup(function () {
                plugin.total();
            });
        };
        plugin.newService = function () {

            plugin.removeErrors();

            var $inputs = $element.find('input');

            var complete = true;

            $inputs.each(function () {
                var $this = $(this);

                var $div = $this.closest('div');
                var $help = $div.find('.help-block');
                if ($this.val()) {
                    $div.removeClass('has-error');
                    $help.remove();
                    return;
                }

                complete = false;
                if (!$div.hasClass('has-error')) {
                    $div.addClass('has-error');
                }

                if (!$help.length) {
                    $('<p class="help-block m-b-0 ajaxError">This field is required.</p>')
                        .insertAfter($this);
                }
            });

            if (!complete) {
                return false;
            }

            var $newService = $element.clone();

            $newService.find('input').each(function () {
                var $this = $(this);
                var newName = $this.prop('name');
                newName = newName.replace('currentIndex', currentIndex);

                $this.prop('name', newName);
            });

            $newService.data('serviceIndex', currentIndex);
            $newService.find(plugin.settings.newServiceAction).remove();
            $newService.find(plugin.settings.clearServiceAction).remove();
            $newService.find(plugin.settings.deleteServiceAction).show();
            $newService.services();


            if ($mainContainer.find('.serviceItem').length - 1 == 0) {
                $mainContainer.find('.labels.header').fadeIn(1000);
            }

            $newService.hide().appendTo($container).fadeIn(1000);

            plugin.clearValues();
            currentIndex++;
        };

        plugin.removeErrors = function () {
            $element.find('.has-error').removeClass('has-error')
                .find('.help-block')
                .remove();
        };

        plugin.clearValues = function () {
            $element.find('input').val(null);
        };

        plugin.deleteService = function () {
            $element.fadeOut(500, function () {
                $(this).remove();
            });

            //todo1
            // if ($mainContainer.find('.serviceItem').length == 0) {
            //     $mainContainer.find('.labels.header').fadeOut(500);
            // }

        };

        plugin.total = function () {

            var quantity = $quantity.val();
            var price = $price.val();

            if (quantity && price) {
                var total = parseFloat(price) * parseFloat(quantity);
                $total.val(Math.round(total * 10000) / 10000);
            }

            if (!quantity || !price) {
                $total.val(null);
            }
        };

        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.services = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            var $this = $(this);
            if (undefined == $this.data('services')) {
                var plugin = new $.services(this, options);
                $this.data('services', plugin)
                    .addClass('services');
            }
        });
    }

})(jQuery);
