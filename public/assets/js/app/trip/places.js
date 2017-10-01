/**
 * Created by tkagnus on 27/09/2017.
 */
/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "places" to the name of your plugin!
(function ($) {
    // here we go!
    $.places = function (element, options) {
        var defaults = {
            newPlaceAction: '.newPlaceAction',
            newPlaceContainer: '.tripPlacesContainer',
            deletePlaceAction: '.deletePlaceAction'
        };
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element

        var currentIndex = 0;
        var $newAction;
        var $container;
        var $mainContainer;
        var $deleteAction;

        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);
            initElements();
            initEvents();
        };

        var initElements = function () {
            $newAction = $element.find(plugin.settings.newPlaceAction);
            $mainContainer = $element.closest('.placesContainer');

            $container = $mainContainer.find(plugin.settings.newPlaceContainer);

            $deleteAction = $element.find(plugin.settings.deletePlaceAction);
        };

        var initEvents = function () {
            $newAction.click(function () {
                plugin.newPlace();
            });
            $deleteAction.click(function () {
                plugin.deletePlace();
            });
        };
        plugin.newPlace = function () {

            plugin.removeErrors();

            var $inputs = $element.find('[name$="[locality]"],[name$="[county]"],[name$="[country]"]');

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


            var $newPlace = $element.clone();

            $newPlace.find('input,textarea,select').each(function () {
                var $this = $(this);
                var newName = $this.prop('name');
                newName = newName.replace('currentIndex', currentIndex);

                $this.prop('name', newName);
            });

            //todo remove specific class

            $newPlace.data('serviceIndex', currentIndex);
            $newPlace.find(plugin.settings.newPlaceAction).remove();
            $newPlace.find(plugin.settings.deletePlaceAction).closest('.row').show();

            $newPlace.places();
            $newPlace.hide().appendTo($container).fadeIn(1000);
            $('html, body').animate({
                scrollTop: $newPlace.offset().top
            }, 1000);

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

        plugin.deletePlace = function () {
            $element.fadeOut(500, function () {
                $(this).remove();
            });

            //todo1
            // if ($mainContainer.find('.serviceItem').length == 0) {
            //     $mainContainer.find('.labels.header').fadeOut(500);
            // }

        };

        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.places = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            var $this = $(this);
            if (undefined == $this.data('places')) {
                var plugin = new $.places(this, options);
                $this.data('places', plugin)
                    .addClass('places');
            }
        });
    }

})(jQuery);
