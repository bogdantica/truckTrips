function formErrors($form, errors) {

    $form.find('.has-error').removeClass('has-error');
    $form.find('.ajaxError').remove();

    for (var errorKey in errors) {

        var array = errorKey.split('.');
        var inputSelector = '';

        if (array.length) {
            var arraySelector = '';
            for (arrayKey in array) {
                var value = array[arrayKey];
                if (arrayKey == 0) {
                    arraySelector += value;
                } else {
                    arraySelector += '[' + value + ']';
                }
            }
            inputSelector = arraySelector;
        } else {
            inputSelector = errorKey;
        }

        var inputErrors = errors[errorKey];

        for (var inputErrorKey in inputErrors) {
            var inputError = inputErrors[inputErrorKey];
            inputSelector = '[name="' + inputSelector + '"]';

            var $input = $form.find(inputSelector);

            if ($input.prop('type') != 'text') {
                $input = $input.first(':checked');
            }

            var firstParent = $input.parent();
            if (firstParent.prop('nodeName') == "LABEL") {
                firstParent.parent().addClass('has-error');
                $('<p class="help-block m-b-0 ajaxError">' + inputError + '</p>').insertAfter(firstParent);
            } else {
                firstParent.addClass('has-error');
                firstParent.append('<p class="help-block m-b-0 ajaxError">' + inputError + '</p>');
            }
        }
    }

}

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}