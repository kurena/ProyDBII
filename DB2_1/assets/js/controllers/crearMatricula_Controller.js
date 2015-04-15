/*crearMatricula_Controller
  JS que controla a la vista (php) y conserva
  la lógica en un solo archivo.

  Daniel Fernandez Solano
*/

var initcrearMatricula_Controls = function(){
    return {
        init: function(){
            $('#gruposDo').dataTable();

            $('.findPerson').click(function(){
                fnCargarProfesores();
                $('#findEstudiantesModal').modal('show');
            });

            $('.findCatedra').click(function(){
                fnCargarCatedras();
                $('#findCatedraModal').modal('show');
            });

            $('.sendMatricula').click(function(){
                fnGestionarMatricula();
            });

            $('#rootwizard').bootstrapWizard({
                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    switch (index) {
                        case 0:
                            $('.nextbtn').html('Siguiente');
                            break;
                        case 1:
                            if($("#formCedula").val() == "" || $('#formcodCatedra').val() == ""){
                                fnShowMessage('Sistema de Matriculas', 'Debe de Indicar un Estudiante y una Catedra.', 'assets/img/errorAlert.png', false);
                                $(".previousbtn").trigger( "click" );
                            }else{
                                $('.nextbtn').html('Siguiente');
                                fnCargarCarreras();
                            }
                            break;
                        case 2:
                            var dataTable = $('#gruposDo').dataTable();
                            var rowCount = dataTable.fnGetData().length;
                            if(rowCount == 0){
                                fnShowMessage('Sistema de Matriculas', 'Debe de Indicar Materias a Matricular.', 'assets/img/errorAlert.png', false);
                                $(".previousbtn").trigger( "click" );
                            }else{
                                $('.nextbtn').html('Finalizar');
                                fnGetCostoMatricula();
                            }
                            break;
                    }
                    var $current = index+1;
                    var $percent = ($current/$total) * 100;
                }
            });
        }
    };
}();

function fnCargarProfesores(){
    $('#profesoresTable').dataTable().fnDestroy();
    $('#profesoresTable > tbody').html("");

    var dataTable = $('#profesoresTable').dataTable();

    var JSONvar = {};

    JSONvar['genericMethod'] = 'listarPersonas';

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matricula_Logic.php',
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

    $('#findEstudiantesModal').modal('hide');
}

function fnCargarCatedras(){
    $("#catedrasTable").dataTable().fnDestroy();
    $('#catedrasTable > tbody').html("");

    var dataTable = $('#catedrasTable').dataTable();

    var JSONvar = {};
    JSONvar['genericMethod'] = 'listar';
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matCatedra_Logic.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                data = JSON.parse(obj);
                dataTable.fnAddData([data.NUMCATEDRA,
                    data.NOMCATEDRA,
                    data.DETCATEDRA,
                    data.CORDINADOR,
                    data.NUMCOORDINADOR]);
            });

            $(dataTable.fnGetNodes()).find('td').click(function (event) {
                currRoutePos = dataTable.fnGetPosition($(this).parent()[0]);
                currRouteData = dataTable.fnGetData(currRoutePos);
                fnGetCatedra( currRouteData );
            });
        }
    }).done(function() {});
}

function fnGetCatedra( catedraData ){
    $("#formCoordinador").val(catedraData[3] + '-' + catedraData[4]);

    $('#formcodCatedra').val(catedraData[0]);

    $('#formnomCatedra').val(catedraData[1]);

    $('#formdesCatedra').val(catedraData[2]);

    $('#findCatedraModal').modal('hide');
}

function fnCargarCarreras(){
    $('#gruposExist').dataTable().fnDestroy();
    $('#gruposExist > tbody').html("");

    var dataTable = $('#gruposExist').dataTable();

    var JSONvar = {};
    JSONvar['genericMethod'] = 'listarByCatedra';
    JSONvar['numcatedra'] = $('#formcodCatedra').val();

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matGrupo_Logic.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                data = JSON.parse(obj);
                dataTable.fnAddData([data.NUMGRUPO,
                    data.NUMCURSO,
                    data.NOMCURSO,
                    data.NUMAULA,
                    data.DIA,
                    data.HORENTRADA,
                    data.HORSALIDA,
                    data.NUNHORARIO,
                    data.COSTCURSO]);
            });
            $(dataTable.fnGetNodes()).find('td').click(function (event) {
                currRoutePos = dataTable.fnGetPosition($(this).parent()[0]);
                currRouteData = dataTable.fnGetData(currRoutePos);
                fnAddCarrito( currRouteData );
            });
        }
    }).done(function() {});
}

function fnAddCarrito(ArrayData){
    var dataTable = $('#gruposDo').dataTable();
    var rowCount = dataTable.fnGetData().length;
    var flag = false;

    if (rowCount == 0){
        fnAddMaterias(ArrayData);
    }else{
        $.each( dataTable.fnGetData(), function(i, row){
            if (row[0] == ArrayData[0]){
                flag = true;
            }
        })
        if (flag == false){
            fnAddMaterias(ArrayData);
        }
    }
}

function fnAddMaterias(newRow){
    var dataTable = $('#gruposDo').dataTable();
    var existrows = [];

    $.each( dataTable.fnGetData(), function(i, row){
        existrows.push(row);
    })

    existrows.push(newRow);

    $('#gruposDo').dataTable().fnDestroy();
    $('#gruposDo > tbody').html("");

    var dataTable1 = $('#gruposDo').dataTable();

    $.each( existrows, function( i, l ){
        dataTable1.fnAddData(existrows[i]);
    });

    $(dataTable1.fnGetNodes()).find('td').click(function (event) {
        currRoutePos = dataTable.fnGetPosition($(this).parent()[0]);
        fnDeleteDo( currRoutePos );
    });
}

function fnDeleteDo(tdcount){
    var dataTable = $('#gruposDo').dataTable();
    dataTable.fnDeleteRow(tdcount);
}

function fnGetCostoMatricula(){
    $('#matrculadosTable > tbody').html("");
    var dataTable = $('#gruposDo').dataTable();
    var total = 0;
    var subtotal = 0;

    /*;*/

    $.each( dataTable.fnGetData(), function(i, row){
        $('#matrculadosTable > tbody:last').append('<tr>' +
                                                        '<td style="width:16%" class="text-left"><i class="fa fa-bookmark text-primary"></i>&nbsp;&nbsp;' + row[2] + '</td>' +
                                                        '<td style="width:16%" class="text-center">' + row[8] + '</td>' +
                                                        '<td style="width:16%">' + row[3] + '</td>' +
                                                        '<td style="width:16%">' + row[4] + '</td>' +
                                                        '<td style="width:16%">' + row[5] + '</td>' +
                                                        '<td style="width:16%">' + row[6] + '</td>' +
                                                    '</tr>');
        total = total + parseInt( row[8] );
    })

    /*;*/

    var JSONvar = {};
    JSONvar['genericMethod'] = 'getDescuento';
    JSONvar['cedPersona'] = $('#formCedula').val();
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/personaObj.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            var data = JSON.parse(response);
            subtotal = total - (total*(data.resultQuery/100));

            $('.descuentoVal').html(String(data.resultQuery/100) +  '%' );
            $('.subtotalVal').html( "₡" + subtotal );
            $('.totalVal').html( "₡" +  total );
        }
    }).done(function() {});

    $('.PhotoClass').html('<img src="assets/profilesIms/' + localStorage.getItem('codUser') + '.png" class="img-circle profilePhoto" width="100">');
    $('.Cedulaclass').html('Cedula : ' + $('#formCedula').val());
    $('.NombreClass').html('Nombre : ' + $('#formnombre').val() + ' ' + $("#formape1").val() + ' ' + $("#formape2").val());
    $('.DireccionClass').html('Direccion : ' + $('#formdireccion').val());
    $('.TelefonoClass').html('Telefono : ' + $('#formtel').val());
    $('.EmailClass').html('Email : ' + $('#formemail').val());
    $('.NaciClass').html('Nacimiento : ' + $('#formfecNaci').val());
}

function fnGestionarMatricula(){
    var JSONvar = {};
    JSONvar['genericMethod'] = 'crearMatricula';
    JSONvar['tipoPago'] = $('#formTipoPago').val();
    JSONvar['total'] = $('.totalVal').html().replace("₡", "");
    JSONvar['subtotal'] = $('.subtotalVal').html().replace("₡", "");
    JSONvar['desmatri'] = parseInt($('.descuentoVal').html().replace("%", ""))*100;
    JSONvar['cedPersona'] = $('#formCedula').val();

    console.log(JSONvar);

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matricula_Logic.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            var data = JSON.parse(response);
            if(!isNaN(data.resultQuery)){
                var dataTable = $('#gruposDo').dataTable();
                fnShowMessage('Sistema de Matriculas', 'Se reguistro la Matricula.', 'assets/img/successAlert.png', false);

                $.each( dataTable.fnGetData(), function(i, row){
                    fnGestionarDetalleMatricula(data.resultQuery, row[0], row[8], row[2])
                })
            }else{
                fnShowMessage('Sistema de Matriculas', 'Error al reguistrar la Matricula.', 'assets/img/errorAlert.png', false);
            }
        }
    }).done(function() {});
}

function fnGestionarDetalleMatricula(numMatri, numGrupo, cosCosto, nomMateria){
    var JSONvar = {};
    JSONvar['genericMethod'] = 'crearDetalleMatricula';
    JSONvar['numMatricula'] = numMatri;
    JSONvar['numGrupo'] = numGrupo;
    JSONvar['costoGrupo'] = cosCosto;

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matricula_Logic.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            console.log(response);
            var data = JSON.parse(response);
            if(data.resultQuery == 'Win'){
                fnShowMessage('Sistema de Matriculas', 'Se reguistro ' + nomMateria + ' correctamente.', 'assets/img/successAlert.png', false);
            }else{
                fnShowMessage('Sistema de Matriculas', 'Error al reguistrar el Detalle.', 'assets/img/errorAlert.png', false);
            }

            setInterval(function () {window.location = "index.html"}, 3000);
        }
    }).done(function() {});
}