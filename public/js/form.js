$(function () {
    Form.setFocus();
    $("form .alert").hide();
});

var Form = {
    validate: function (isAjax) {        
        var isValid = true;
        $('form *').filter(':input').each(function () {
            var el = this;
            if ($("#" + el.id + "_div").hasClass('required')) {
                if ($.trim(el.value) == '') {
                    $("#" + el.id + "_div").addClass('error');
                    $("#" + el.id + "_alert").removeClass('hidden');
                    $("#" + el.id + "_alert").addClass('visible');
                    isValid = false;
                } else {    
                    $("#" + el.id + "_div").removeClass('error');
                    $("#" + el.id + "_alert").addClass('hidden');
                    $("#" + el.id + "_alert").removeClass('visible');
                }
            }    
        });        

        $('.error').find('input:text, input:password, textarea').first().focus();
        if (!isValid) return false;

        $('#saveNew').val(saveNew);
        if (!isAjax) $("form")[0].submit();          
        return isValid;
    },
    setFocus: function () {
        //$("form input:text, input:password, textarea").first().focus(); 
        $('form').find("input:visible:first").focus(); 
    },
    getValues: function () {
        
    }
}

function clear() { //TODO Add reset for numeric and combobox.
    $('form *').filter(':input').each(function () {
        var el = this;
        el.value = ''; 
        $("#" + el.id + "_div").removeClass('error');
        $("#" + el.id + "_alert").addClass('hidden');
        $("#" + el.id + "_alert").removeClass('visible');
    }); 
    Form.setFocus();
}

