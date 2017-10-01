/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "gooAutComp" to the name of your plugin!
(function ($) {
    // here we go!
    $.gooAutComp = function (element, options) {
        var defaults = {
            container: '.placeContainer'
        };
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element

        var gac;

        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);

            initInputs();
            initGac();
        };

        var initInputs = function () {
            plugin.$container = $element.closest(plugin.settings.container);
            plugin.$street = plugin.$container.find('[name$="[street]"]');
            plugin.$number = plugin.$container.find('[name$="[number]"]');
            plugin.$locality = plugin.$container.find('[name$="[locality]"]');
            plugin.$county = plugin.$container.find('[name$="[county]"]');
            plugin.$country = plugin.$container.find('[name$="[country]"]');
            plugin.$postal_code = plugin.$container.find('[name$="[postal_code]"]');
        };

        var initGac = function () {
            gac = new google.maps.places.Autocomplete($element[0]);
            bindGacEvents();
        };

        var bindGacEvents = function () {

            gac.addListener('place_changed', function () {
                plugin.updatePlace();
            });

            $element.on('keydown', function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        };


        plugin.clearValues = function () {
            var defaultValue = null;
            plugin.$street.val(defaultValue);
            plugin.$number.val(defaultValue);
            plugin.$locality.val(defaultValue);
            plugin.$county.val(defaultValue);
            plugin.$country.val(defaultValue);
            plugin.$postal_code.val(defaultValue);

        };

        plugin.updatePlace = function () {

            plugin.clearValues();
            var place = gac.getPlace();
            var bucharestSector = false;

            for (var x in place.address_components) {
                var comp = place.address_components[x];
                var type = comp.types;

                if (type.includes('sublocality_level_1') === true &&
                    type.includes('political') === true && type.length === 3) {
                    bucharestSector = comp.long_name;
                }

                switch (true) {
                    case type.includes('street_number') === true && type.length === 1:
                        fillNumber(comp.long_name);
                        break;
                    case type.includes('postal_code') === true && type.length === 1:
                        fillPostalCode(comp.long_name);
                        break;
                    case type.includes('route') === true && type.length === 1:
                        fillStreet(comp.long_name);
                        break;
                    case
                    type.includes('locality') === true &&
                    type.includes('political') === true && type.length === 2:
                        fillLocality(comp.long_name);
                        break;
                    case
                    (
                        type.includes('administrative_area_level_1') === true &&
                        type.includes('political') === true && type.length === 2
                    )
                        // ||
                        // (
                        //     type.includes('sublocality_level_1') === true &&
                        //     type.includes('political') === true && type.length === 3
                        // )
                    :
                        fillCounty(comp.long_name);
                        break;
                    case
                    type.includes('country') === true &&
                    type.includes('political') === true && type.length === 2:
                        fillCountry(comp.long_name);
                        break;
                }
            }

            if (bucharestSector !== false) {
                fillCounty(bucharestSector);
            }
        };

        var fillStreet = function (val) {
            plugin.$street.val(val);
        };
        var fillNumber = function (val) {
            plugin.$number.val(val);
        };

        var fillLocality = function (val) {
            plugin.$locality.val(val);
        };

        var fillCounty = function (val) {
            plugin.$county.val(val);
        };
        var fillCountry = function (val) {
            plugin.$country.val(val);
        };
        var fillPostalCode = function (val) {
            plugin.$postal_code.val(val);
        };

        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.gooAutComp = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            if (undefined == $(this).data('gooAutComp')) {
                var plugin = new $.gooAutComp(this, options);
                $(this).data('gooAutComp', plugin);
            }
        });
    }

})(jQuery);
