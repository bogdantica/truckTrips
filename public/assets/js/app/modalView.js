/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "modalView" to the name of your plugin!
(function ($) {
    // here we go!
    $.modalView = function (element, options) {
        var defaults = {
            elementSelector: '',
            event: 'click',
            url: '',
            params: {},
            method: 'GET',
            before: function ($element) {
            },
            after: function ($element, data) {
            },
            beforeModalSubmit: function ($form, $element) {
            },
            afterModalSubmit: function ($form, $r, $element) {
            },
            updateElement: 'select',
            parentSelector: '.form-group',
            value: 'id',
            text: 'name'

        };
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element
        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);
            handle();
        };

        var handle = function () {
            $element.on('click', function () {
                $.ajax({
                    method: plugin.settings.method,
                    url: plugin.settings.url,
                    data: plugin.settings.params,
                    beforeSend: function () {
                        plugin.settings.before($element);
                    },
                    success: function (data) {
                        var $data = $(data);

                        plugin.settings.after($element, $data);

                        generateModal($data);
                    }
                })
            });
        };

        var generateModal = function ($data) {


            var $modal = $(window.html.modal);

            $modal.find('.modal-content').html($data.find(plugin.settings.elementSelector));

            var scriptsSelector = plugin.settings.elementSelector + 'Scripts';

            var scripts = $data.find(scriptsSelector);
            if (!scripts.length) {
                scripts = $data.filter(scriptsSelector)
            }

            // $modal.find('.panel-heading');

            $modal.append(scripts);

            console.log($modal.find('form'));

            $modal.find('form').form2({
                beforeSubmit: function ($form) {
                    plugin.settings.beforeModalSubmit($form, $element);
                },

                afterSubmit: function ($form, $r) {

                    if (plugin.settings.updateElement) {

                        var value = $r[plugin.settings.value];
                        var text = $r[plugin.settings.text];
                        var $select = $element.closest(plugin.settings.parentSelector).find(plugin.settings.updateElement);

                        console.log($select);
                        if ($r.isNew == true) {
                            $select.append('<option value="' + value + '">' + text + '</option>')
                        }

                        $select.val(value)
                            .change();
                    }

                    plugin.settings.afterModalSubmit($form, $r, $element);
                    $modal.modal('hide');
                }
            });

            $(document).find('body').append($modal);

            $modal.modal('show');
        };

        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.modalView = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            if (undefined == $(this).data('modalView')) {
                var plugin = new $.modalView(this, options);
                $(this).data('modalView', plugin);
            }
        });
    }

})(jQuery);


window.html.modal = '<div class="modal fade" id="{id}"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> <h4 class="modal-title"></h4> </div> <div class="modal-body"></div> <div class="modal-footer"> <button type= "button" class = "btn btn-default" data-dismiss="modal" > Close </button><button type="button" class = "btn btn-submit">Save</button> </div> </div> </div> </div>';
