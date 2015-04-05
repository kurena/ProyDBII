/*matProfesor_Controller
  JS que controla a la vista (php) y conserva
  la lógica en un solo archivo.

  Daniel Fernandez Solano
*/
var initmatProfesorControls = function(){
    return {
        init: function(){
            $('#formfecNaci').datepicker();

            fnCargarProfesores();

            $("#addProfesorBtn").click(function(){
                fnClearInputs();
                $('.findPerson').removeAttr("disabled");
                $("#formCedula").removeAttr("disabled");
                $(".sendUpdUser").hide();
                $(".sendNewUser").show();
                $("#newProfesorModal").modal("show");
            });

            $('.sendUpdUser').click(function () {
                var JSONvar = {};

                JSONvar['genericMethod'] = 'uptPerson';
                JSONvar["cedPersonaIn"] = $('#formCedula').val();
                JSONvar["nomPersonaIn"] = $('#formnombre').val();
                JSONvar["ape1PersonaIn"] = $('#formape1').val();
                JSONvar["ape2PersonaIn"] = $('#formape2').val();
                JSONvar["fecNaciPersonaIn"] = $('#formfecNaci').val();
                JSONvar["telPersonaIn"] = $('#formtel').val();
                JSONvar["domiPersonaIn"] = $('#formdireccion').val();
                JSONvar["correoPersonaIn"] = $('#formemail').val();

                console.log(JSONvar.genericMethod);

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/matProfesor_Logic.php',
                    type:  'post',
                    beforeSend: function () {
                        //Logic Here
                    },
                    success:  function (response) {
                        console.log(response);
                        fnCargarProfesores();
                    }
                }).done(function() {});
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
                JSONvar["tipPersonaIn"] = 'prof';
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
                        fnCargarProfesores();
                    }
                }).done(function() {});
            });
        }
    };
}();

function fnCargarProfesores(){
    $('#profesoresTable').dataTable().fnDestroy();
    $('#profesoresTable > tbody').html("");

    var dataTable = $('#profesoresTable').dataTable();

     var JSONvar = {};

    JSONvar['genericMethod'] = 'listar';

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matProfesor_Logic.php',
        type:  'post',
        beforeSend: function () {
          //Logic Here
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                data = JSON.parse(obj);
                dataTable.fnAddData(['<img src="assets/profilesIms/' + data.CODUSUARIO + '.png" class="img-circle profilePhoto" width="40">',
                                     data.CEDPERSONA,
                                     data.NOMPERSONA,
                                     data.APE1PERSONA,
                                     data.APE2PERSONA,
                                     data.TELPERSONA,
                                     data.CORREOPERSONA]);
            });

            $(dataTable.fnGetNodes()).find('td').click(function (event) {
                currRoutePos = dataTable.fnGetPosition($(this).parent()[0]);
                currRouteData = dataTable.fnGetData(currRoutePos);
                fnLoadProfesorInfo(currRouteData[1]);
            });
        }
    }).done(function() {});
}

function fnLoadProfesorInfo(cedProfesor){
    $('.findPerson').attr("disabled", true);
    $("#formCedula").attr("disabled", true);
    $(".sendUpdUser").show();
    $(".sendNewUser").hide();

    var JSONvar = {};
    JSONvar['genericMethod'] = 'selPersonaByID';
    JSONvar['cedProfesorIN'] = cedProfesor;

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matProfesor_Logic.php',
        type:  'post',
        beforeSend: function () {
            /*Logic Here*/
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                var data = JSON.parse(obj);
                $("#formCedula").val(data.CEDPERSONA);
                $("#formnombre").val(data.NOMPERSONA);
                $("#formape1").val(data.APE1PERSONA);
                $("#formape2").val(data.APE2PERSONA);
                $("#formdireccion").val(data.DOMIPERSONA);
                $("#formtel").val(data.TELPERSONA);
                $("#formemail").val(data.CORREOPERSONA);
                $("#formfecNaci").val(data.FECNACIMIENTO);
                $("#newProfesorModal").modal("show");
            });
        }
    }).done(function() {});
}

function fnClearInputs(){
    var container, inputs, index;

    container = $('#for_loop');

    inputs = container.find('input');

    for (index = 0; index < inputs.length; ++index) {
        var controlid = inputs[index].id;
        $('#' + controlid).val("");
    }
}