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
