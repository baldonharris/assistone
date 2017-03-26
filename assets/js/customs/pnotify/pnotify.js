/**
 * Created by baldonharris on 26/03/2017.
 *
 * @param title = the title of pnotify to be displayed
 * @param text = the text message of pnotify
 * @param type = the type of pnotify: success or error
 */
var pnotify = function(title, text, type) {
    var opt = {
        title: (title) ? title : 'Unknown Title',
        text: (text) ? text : 'Unknown Message',
        type: (type) ? type : 'error',
        delay: 3000,
        animation: 'fade',
        mobile: {swipe_dismiss:true, styling:true},
        button: {closer:false, sticker:false},
        desktop: {desktop:true, fallback:true}
    };
    new PNotify(opt);
};