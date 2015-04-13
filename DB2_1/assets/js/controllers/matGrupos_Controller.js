/*matGrupos_Controller
  JS que controla a la vista (php) y conserva
  la lógica en un solo archivo.

  Daniel Fernandez Solano
*/

var initmatGrupos_Controls = function(){
    return {
        init: function(){
            fnCargarGrupos();
        }


    };
}();

function fnCargarGrupos(){
    $('#gruposTable').dataTable().fnDestroy();
    $('#gruposTable > tbody').html("");

    var dataTable = $('#gruposTable').dataTable();

    var HTMLTemp = "<div class='text-center'>" +
                        "<button class='btn btn-primary btn-xs' onclick='fnMantGrupo({value}, {type1})'><i class='fa fa-pencil'></i></button>" +
                        "&nbsp&nbsp&nbsp&nbsp" +
                        "<button class='btn btn-danger btn-xs'  onclick='fnMantGrupo({value}, {type2})'><i class='fa fa-trash-o'></i></button>" +
                    "</div>";

    var JSONvar = {};
    JSONvar['genericMethod'] = 'listar';

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
                                     fnMakeHTML(HTMLTemp, {value: JSON.stringify(data), type1: '"edit"', type2: '"erase"'}),
                                     data.NUNHORARIO]);
            });

        }
    }).done(function() {});
}

function fnMantGrupo(JSONData, type) {
    switch (type) {
        case 'edit':
            $('.sendNewGrupo').hide();
            $('.sendUpdGrupo').show();

            $('#newGrupoModal').modal("show");
            break;
        case 'erase':
            $(".sendEraseGrupo").attr("numGrupo", JSONData.NUMGRUPO);
            $('#confirmGrupoModal').modal("show");
            break;
    }
}