/**
 * Created by DB2 on 23/03/2015.
 */
var initLogic = function() {
    return {
        init: function() {
            if (localStorage.getItem('sessionState') == 'true'){
                $('.profilePhoto').attr('src', 'assets/profilesIms/' + localStorage.getItem('codUser') + '.png');
                var personObJ = fnTraerInfoPersona();
                $('.userNameProfile').text(personObJ.NOMPERSONA + ' ' + personObJ.APE1PERSONA);
            }else{
                /*if (localStorage.getItem('blockSesionFlag') == 'true'){
                    $(location).attr('href','lock_screen.html');
                }else{*/
                    $(location).attr('href','login.html');
                /*}*/
            }
        }
    };
}();

var initComponents = function() {
    return {
        init: function() {
            $('.logout').click(function(){
                localStorage.clear();
            });

            $('.profilePhoto').click(function(){
                $('#profileModalInfo').modal('show');
            });

            var currentPHPFile =  window.location.pathname.replace('/db2_1/', '');
            $('.go-top').attr('href', currentPHPFile + '#');

            /*$('.blockSession').click(function(){
                localStorage.setItem('blockSesionFlag', 'true');
            });*/
        }
    };
}();

/*Funciones*/
function fnTraerInfoPersona(){
    var returnJSON;
    var JSONvar = {};

    JSONvar['genericMethod'] = 'selPersonaByID';
    JSONvar['numPersona'] = localStorage.getItem('usernumPersona');

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/personaObj.php',
        type:  'post',
        async: false,
        beforeSend: function () {
            /*Logic Here*/
        },
        success:  function (response) {
            returnJSON = JSON.parse(JSON.parse(response)[0]);
        }
    });

    return returnJSON;
}

/* Params : plantilla, JSON de valores
Funcion que recive una plantilla y los valores
* JSON para reemplaarlos en los token de la plantilla*/
function fnMakeHTML(str, col) {
    col = typeof col === 'object' ? col : Array.prototype.slice.call(arguments, 1);

    return str.replace(/\{\{|\}\}|\{(\w+)\}/g, function (m, n) {
        if (m == "{{") {
            return "{";
        }
        if (m == "}}") {
            return "}";
        }
        return col[n];
    });
}

/* Params : NA
 Funcion que limpia todos los elemntos input
 y textarea de div ForLoop
* */
function fnClearInputs(){
    var container, inputs, index;

    container = $('#for_loop');

    inputs = container.find('input');

    for (index = 0; index < inputs.length; ++index) {
        var controlid = inputs[index].id;
        $('#' + controlid).val("");
    }

    inputs = container.find('textarea');

    for (index = 0; index < inputs.length; ++index) {
        var controlid = inputs[index].id;
        $('#' + controlid).val("");
    }
}

/* Params : title, msg, img, stickyBool
Funcion que crea una alerta indicando
un error o un ejecucion exitosa en algun
proceso de la Aplicacion
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