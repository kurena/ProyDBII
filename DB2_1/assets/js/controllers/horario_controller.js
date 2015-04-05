var initControls = function () {
    return {
        init: function () {
            this.loadData();
            var self = this;
            $("#add").click(function () {
                $('#horarioModal').modal('show');
                $('.addUpd').html("<i class='fa fa-check'></i> Añadir");
                $('h4.mb').text('Ingresar datos');
                fillSelects();

            });
            $(".back").click(function () {
                $('#horarioModal').modal('hide');

            });
        },
        loadData: function () {
            var htmlTable = $("#HorariosTable").dataTable({
                "mRender": function (data, type, full) {
                    return "<a class='btn btn-info btn-sm' href=#></a>";
                }
            });

            var JSONvar = {};
            JSONvar["genericMethod"] = "selAllHorarios";


            $.ajax({
                data: JSONvar,
                url: 'assets/php/horarios.php',
                type: 'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success: function (response) {
                    $.each(JSON.parse(response), function (idx, obj) {
                        if (obj) {
                            var row = JSON.parse(obj),
                                $edit = "<button class='btn btn-primary btn-xs' data-value=" + row.NUMHORARIO + " onclick='getHorarioById(this)'><i class='fa fa-pencil'></i></button>",
                                $remove = "<button class='btn btn-danger btn-xs' data-value=" + row.NUMHORARIO + " onclick='remHorario(this)'><i class='fa fa-trash-o '></i></button>";
                            htmlTable.fnAddData([row.NUMHORARIO, row.dayName, row.turno, $edit + ' ' + $remove]);

                        }

                    });

                }
            });
        }
    };
}();
function addModHorario() {
    var $dia = $('#dia'),
        $turno = $('#turno'),
        JSONvar = {};
    JSONvar['genericMethod'] = $('.addUpd').text() === ' Añadir' ? 'agregar' : 'actualizar';
    JSONvar['dia'] = $dia.val();
    JSONvar['numHorario'] = $('.addUpd').attr('data-value') ? $('.addUpd').attr('data-value') : '';
    JSONvar['turno'] = $turno.val();
    $.ajax({
        data: JSONvar,
        url: 'assets/php/horarios.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response === 'Done') {
                $('#horarioModal').modal('hide');
                window.location.reload(true);
            } else {
                fnShowMessage('Error.', 'Horario ya existe, Intente de nuevo', 'assets/img/warninAlert.png', false, 3000);

            }
        }
    });
    return false;

}

function getHorarioById($el) {
    $('#horarioModal').modal('show');
    $('.addUpd').html("<i class='fa fa-check'></i> Actualizar");
    $('h4.mb').text('Actualizar datos');
    fillSelects();
    var valSearch = $el.attributes[1].value,
        JSONvar = {};
    JSONvar['genericMethod'] = 'selHorarioById';
    JSONvar['numHorario'] = valSearch;
    $.ajax({
        data: JSONvar,
        url: 'assets/php/horarios.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            var data = JSON.parse(response);
            $('.addUpd').attr('data-value', data[0].NUMHORARIO);
            $('#dia').val(data[0].DIAHORARIO);
            $('#turno').val(data[0].NUMTURNO);
        }
    });
}
function remHorario($el) {
    if (confirm('Seguro que desea eliminar este dato?')) {
        var JSONVAR = {},
            valSearch = $el.attributes[1].value;
        JSONVAR['genericMethod'] = 'remover';
        JSONVAR['numHorario'] = parseInt(valSearch, 10);
        $.ajax({
            data: JSONVAR,
            url: 'assets/php/horarios.php',
            type: 'post',
            beforeSend: function () {

            },
            success: function (response) {
                if (response === 'Done') {
                    window.location.reload(true);
                }
            }
        });
    } else {
        // Do nothing!
    }
}
function addValuesToSelect($sel, options) {
    $.each(options, function(index, value) {
        var opt = document.createElement("option");
        opt.value = index;
        opt.innerHTML = value;
        $sel.append(opt);
    });
}
function fillSelects() {
    var optDias = {
        1: "Lunes",
        2: "Martes",
        3: "Miércoles",
        4: "Jueves",
        5: "Viernes",
        6: "Sábado",
        7: "Domingo"
    },
        $dia = $("#dia"),
        $turno = $("#turno");
    $dia.find('option').remove();
    $turno.find('option').remove();
    addValuesToSelect($dia,optDias);
    var JSONvar = {};
    JSONvar["genericMethod"] = "selAllTurnos";

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/turnos.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                if (obj) {
                    var row = JSON.parse(obj);
                    JSONvar[row.NUMTURNO] = row.HORENTRADA+ " - "+ row.HORSALIDA;
                }

            });
            delete JSONvar['genericMethod'];
            addValuesToSelect($turno,JSONvar);
        }
    });
}