/**
 * Created by DB2 on 21/03/2015.
 */

function fnShowMessage(title, msg, img, stickyBool){
    $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: title,
        // (string | mandatory) the text inside the notification
        text: msg,
        // (string | optional) the image to display on the left
        image: img,
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: stickyBool,
        // (int | optional) the time you want it to be alive for before fading out
        time: 1000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
    });
}