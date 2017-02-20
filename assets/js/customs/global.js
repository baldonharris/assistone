$(document).ready(function(){    
    $('.collapse-link').click(function() {
        var temp_class = '';
        var x_panel = $(this).closest('.x_panel');
        if($(x_panel).attr('class').search('height') > 0) {
            temp_class = $(x_panel).attr('class').replace('x_panel ', '');
            $(x_panel).attr('temp-class', temp_class);
            $(x_panel).removeAttr('class').addClass('x_panel');
        } else {
            $(x_panel).removeAttr('class').addClass('x_panel '+temp_class);
            $(x_panel).removeAttr('temp-class');
        }
    });
});