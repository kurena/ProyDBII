/*matAula_Controller
  JS que controla a la vista (php) y conserva
  la lógica en un solo archivo.
  
  Daniel Fernandez Solano
*/

var initmatAula_Controls = function(){
    return {
        init: function(){
            fnCargarAulas();

            $("#addAulaBtn").click(function(){
                fnClearInputs();
                $('.sendNewAula').show();
                $('.sendUpdAula').hide();

                $('#newAulaModal').modal("show");
            });

            $(".sendEraseAula").click(function(){
                var JSONvar = {};

                JSONvar['genericMethod'] = 'eraseAula';
                JSONvar["numAulaIN"] = $(".sendEraseAula").attr("numAula");

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/matAula_Logic.php',
                    type:  'post',
                    beforeSend: function () {
                        //Logic Here
                    },success:  function (response) {
                        resultJSON = JSON.parse(response);
                        if(resultJSON.resultQuery == 'Win'){
                            fnCargarAulas();
                            fnShowMessage('Sistema de Matriculas', 'Transacción Exitosa.', 'assets/img/successAlert.png', false);
                        }else{
                            fnShowMessage('Sistema de Matriculas', 'Error en la Transacción.', 'assets/img/errorAlert.png', false);
                        }
                    }
                }).done(function() {});
            });

            $(".sendUpdAula").click(function(){
                var JSONvar = {};

                JSONvar['genericMethod'] = 'uptCurgrad';
                JSONvar["numAulaIN"] = $('#formnumAula').val();
                JSONvar["detAulaIN"] = $('#formdesAula').val();
                JSONvar["tipAulaIN"] = $('#formtipAula').val();

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/matAula_Logic.php',
                    type:  'post',
                    beforeSend: function () {
                        //Logic Here
                    },success:  function (response) {
                        resultJSON = JSON.parse(response);
                        if(resultJSON.resultQuery == 'Win'){
                            fnCargarAulas();
                            fnShowMessage('Sistema de Matriculas', 'Transacción Exitosa.', 'assets/img/successAlert.png', false);
                        }else{
                            fnShowMessage('Sistema de Matriculas', 'Error en la Transacción.', 'assets/img/errorAlert.png', false);
                        }
                    }
                }).done(function() {});
            });

            $(".sendNewAula").click(function(){
                var JSONvar = {};

                JSONvar['genericMethod'] = 'insAula';
                JSONvar["detAulaIN"] = $('#formdesAula').val();
                JSONvar["tipAulaIN"] = $('#formtipAula').val();

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/matAula_Logic.php',
                    type:  'post',
                    beforeSend: function () {
                        //Logic Here
                    },success:  function (response) {
                        resultJSON = JSON.parse(response);
                        if(resultJSON.resultQuery == 'Win'){
                            fnCargarAulas();
                            fnShowMessage('Sistema de Matriculas', 'Transacción Exitosa.', 'assets/img/successAlert.png', false);
                        }else{
                            fnShowMessage('Sistema de Matriculas', 'Error en la Transacción.', 'assets/img/errorAlert.png', false);
                        }
                    }
                }).done(function() {});
            });

        }
    };
}();

function fnCargarAulas(){
    $('#aulasTable').dataTable().fnDestroy();
    $('#aulasTable > tbody').html("");

    var dataTable = $('#aulasTable').dataTable();

    var HTMLTemp = "<div class='text-center'>" +
                       "<button class='btn btn-primary btn-xs' onclick='fnMantAula({value}, {type1})'><i class='fa fa-pencil'></i></button>" +
                       "&nbsp&nbsp&nbsp&nbsp" +
                       "<button class='btn btn-danger btn-xs'  onclick='fnMantAula({value}, {type2})'><i class='fa fa-trash-o'></i></button>" +
                   "</div>";

    var JSONvar = {};
    JSONvar['genericMethod'] = 'listar';

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matAula_Logic.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                data = JSON.parse(obj);
                dataTable.fnAddData([data.NUMAULA,
                                    data.DETAULA,
                                    data.TIPOAULA,
                                    fnMakeHTML(HTMLTemp, {value:  JSON.stringify(data), type1: '"edit"', type2: '"erase"'})]);
            });
        }
    }).done(function() {});
}

function fnMantAula(JSONData, type){
    switch (type) {
        case 'edit':
            $('.sendNewAula').hide();
            $('.sendUpdAula').show();

            $('#formnumAula').val(JSONData.NUMAULA);
            $('#formdesAula').val(JSONData.DETAULA);
            $('#formtipAula').val(JSONData.TIPOAULA);

            $('#newAulaModal').modal("show");
            break;
        case 'erase':
            $(".sendEraseAula").attr("numAula", JSONData.NUMAULA);
            $('#confirmAulaModal').modal("show");
            break;
    }
}