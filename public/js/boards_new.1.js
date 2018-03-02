$(function () {
    $('#dataForm').form(rules);
    $("form input:text, input:password, textarea").first().focus();
    $("form .alert").hide();
});

var SaveProject = {
    validate: function () {        
        var valid = true;
        $('form *').filter(':input').each(function () {
            var el = this;
            if ($("#" + el.id + "_div").hasClass('required')) {
                if ($.trim(el.value) == '') {
                    $("#" + el.id + "_div").addClass('error');
                    $("#" + el.id + "_alert").removeClass('hidden');
                    $("#" + el.id + "_alert").addClass('visible');
                    valid = false;
                } else {    
                    $("#" + el.id + "_div").removeClass('error');
                    $("#" + el.id + "_alert").addClass('hidden');
                    $("#" + el.id + "_alert").removeClass('visible');
                }
            }    
        });                

        $('.error').find('input:text, input:password, textarea').first().focus();
        if (!valid) return false;

        $(form)[0].submit();
    }
}