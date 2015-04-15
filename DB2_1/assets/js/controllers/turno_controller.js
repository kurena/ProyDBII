var initControls = function() {
    return {
        init: function() {
            this.loadData();
            var self = this;
            $("#add").click(function(){
                $('#turnoModal').modal('show');
                $('.addUpd').html("<i class='fa fa-check'></i> Añadir");
                $('h4.mb').text('Ingresar datos');
                $('#horEntrada').val('');
                $('#horSalida').val('');

            });
            $(".back").click(function() {
                $('#turnoModal').modal('hide');

            });
        },
        loadData : function() {
            var htmlTable = $("#TurnosTable").dataTable({
                "mRender": function(data, type, full) {
                    return "<a class='btn btn-info btn-sm' href=#></a>";
                }
            });

            var JSONvar = {};
            JSONvar["genericMethod"] = "selAllTurnos";

            $.ajax({
                data:  JSONvar,
                url:   'assets/php/turnos.php',
                type:  'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    $.each(JSON.parse(response), function (idx, obj) {
                        if (obj) {
                            var row = JSON.parse(obj),
                                $edit = "<button class='btn btn-primary btn-xs' data-value="+row.NUMTURNO+" onclick='getTurnoById(this)'><i class='fa fa-pencil'></i></button>",
                                $remove = "<button class='btn btn-danger btn-xs' data-value="+row.NUMTURNO+" onclick='remTurno(this)'><i class='fa fa-trash-o '></i></button>";
                            htmlTable.fnAddData([row.NUMTURNO,row.HORENTRADA,row.HORSALIDA,$edit+' '+$remove]);

                        }

                    });

                }
            });
        }
    };
}();
function addModTurno() {
    var $horE = $('#horEntrada'),
        $horS = $('#horSalida'),
        JSONvar = {};
    JSONvar['genericMethod'] = $('.addUpd').text() === ' Añadir' ? 'agregar' : 'actualizar';
    JSONvar['horEntrada'] = $horE.val();
    JSONvar['numTurno'] = $('.addUpd').attr('data-value') ? $('.addUpd').attr('data-value') : '';
    JSONvar['horSalida'] = $horS.val();
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/turnos.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            console.log(response);
            if (response === 'Done') {
                $('#turnoModal').modal('hide');
                window.location.reload(true);
            }else {
                fnShowMessage('Error.', 'Intente de nuevo', 'assets/img/warninAlert.png', false,3000);

            }
        }
    });
    return  false;

}

function getTurnoById($el) {
    $('#turnoModal').modal('show');
    $('.addUpd').html("<i class='fa fa-check'></i> Actualizar");
    $('h4.mb').text('Actualizar datos');
    var valSearch = $el.attributes[1].value,
        JSONvar = {};
    JSONvar['genericMethod'] = 'selTurnoById';
    JSONvar['numTurno'] = valSearch;
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/turnos.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            var data = JSON.parse(response);
            $('.addUpd').attr('data-value',data[0].NUMTURNO);
            $('#horEntrada').val(data[0].HORENTRADA);
            $('#horSalida').val(data[0].HORSALIDA);
        }
    });
}
function remTurno($el) {
    $('#confirmModal').modal('show');
    $(".sendErase").click(function() {
        var JSONVAR = {},
            valSearch = $el.attributes[1].value;
        JSONVAR['genericMethod'] = 'remover';
        JSONVAR['numTurno'] = parseInt(valSearch,10);
        $.ajax({
            data:  JSONVAR,
            url:   'assets/php/turnos.php',
            type:  'post',
            beforeSend: function () {

            },
            success:  function (response) {
                if (response === 'Done') {
                    window.location.reload(true);
                }
            }
        });
    });

}