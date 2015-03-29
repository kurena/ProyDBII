/**
 * Created by DB2 on 14/03/2015.
 */
var initBackDroop = function() {
    return {
        init: function() {
            $.backstretch([
                "assets/img/login-bg2.jpg"
                , "assets/img/login-bg3.jpg"
                , "assets/img/login-bg4.jpg"
            ], {duration: 3000, fade: 1500});
        }
    };
}();

var initControls = function() {
    return {
        init: function() {
            $('#formfecNaci').datepicker();

            $('.acceder').click(function(){
                if ($('.codUsuario').val() != '' || $('.passUsuario').val() != ''){
                    var JSONvar = {};
                    JSONvar['genericMethod'] = 'acceder';
                    JSONvar['codUsuario'] = $('.codUsuario').val();
                    JSONvar['passUsuario'] = $('.passUsuario').val();

                    $.ajax({
                        data:  JSONvar,
                        url:   'assets/php/login.php',
                        type:  'post',
                        beforeSend: function () {
                            /*Logic Here*/
                        },
                        success:  function (response) {
                            var result = JSON.parse(response);
                            switch (result.resultQuery){
                                case 'FU':
                                    localStorage.setItem('codUser', $('.codUsuario').val());
                                    localStorage.setItem('tipUser', result.tipUser);
                                    localStorage.setItem('usernumPersona', result.usernmPersona);
                                    localStorage.setItem('sessionState', true);
                                    $(location).attr('href','index.html');
                                    break;
                                case 'NFU':
                                    fnShowMessage('Nueva Notificación.', 'Nombre de usuario Incorrecto o no existe el Usuario.', 'assets/img/warninAlert.png', false);
                                    break;
                                case 'IP':
                                    fnShowMessage('Nueva Notificación.', 'Contraseña incorrecta.', 'assets/img/errorAlert.png', false);
                                    break;
                            }
                        }
                    }).done(function() {});
                }else{
                    fnShowMessage('Nueva Notificación.', 'Existen espacios en Blanco.', 'assets/img/warninAlert.png', false);
                }
            });

            $('.findPerson').click(function(){
                $('.findPerson').attr("disabled", true);
                $('.findPerson').text('Buscando..');
                var JSONvar = {};
                JSONvar['genericMethod'] = 'buscarCedula';
                JSONvar['cedulaFind'] = $('#formCedula').val();

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/login.php',
                    type:  'post',
                    beforeSend: function () {
                        /*Logic Here*/
                    },
                    success:  function (response) {
                        var data = JSON.parse(response);
                        if (data.result == 'succes'){
                            var res = data.nombre.split(" ");
                            var nombre = res[0] + ' ' + res[1];
                            data.nombre = nombre;
                            $('#formnombre').val(data.nombre);
                            $('#formape1').val(data.ape1);
                            $('#formape2').val(data.ape2);
                            $('#formdireccion').val(data.residencia);
                        }else{
                            console.log(data);
                        }
                    }
                }).done(function() {
                    $('.findPerson').removeAttr("disabled");
                    $('.findPerson').text('');
                    $('.findPerson').append( "<i class='fa fa-search'></i> Buscar" );
                });
            });

         $('.sendNewUser').click(function () {
             var JSONvar = {};
             var userName = $('#formnombre').val().substring(0, 1) + $('#formape1').val() + $('#formape2').val().substring(0, 1);

             JSONvar['genericMethod'] = 'createPersonUser';
             JSONvar["cedPersonaIn"] = $('#formCedula').val();
             JSONvar["nomPersonaIn"] = $('#formnombre').val();
             JSONvar["ape1PersonaIn"] = $('#formape1').val();
             JSONvar["ape2PersonaIn"] = $('#formape2').val();
             JSONvar["fecNaciPersonaIn"] = $('#formfecNaci').val();
             JSONvar["telPersonaIn"] = $('#formtel').val();
             JSONvar["domiPersonaIn"] = $('#formdireccion').val();
             JSONvar["correoPersonaIn"] = $('#formemail').val();
             JSONvar["numBecaPersonaIn"] = '1';
             JSONvar["paisPersonaIn"] = '1';
             JSONvar["tipPersonaIn"] = 'estu';
             JSONvar["numCatPersonaIn"] = 'null';
             JSONvar["numGraAcaPersonaIn"] = 'null';
             JSONvar["numNotaPersonaIn"] = 'null';
             JSONvar["codUserIn"] = userName.toLowerCase();
             JSONvar["passUserIn"] = 'progra';

             $.ajax({
                 data:  JSONvar,
                 url:   'assets/php/login.php',
                 type:  'post',
                 beforeSend: function () {
                     //Logic Here
                 },
                 success:  function (response) {
                    console.log(response);
                 }
             }).done(function() {});
         });
        }
    };
}();