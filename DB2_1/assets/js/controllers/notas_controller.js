var initControls = function() {
    return {
        init: function() {
            this.loadData();
            var self = this;
            $("#add").click(function(){
                $('#notasModal').modal('show');
                $('.addUpd').html("<i class='fa fa-check'></i> Añadir");
                $('h4.mb').text('Ingresar datos');
                $('#estudiante').find('option').remove();
                $('#cursos').find('option').remove();
                getAllCursos($("#cursos"));
                getAllEstudiantes();

            });
            $(".back").click(function() {
                $('#notasModal').modal('hide');

            });
        },
        loadData : function() {
            getAllCursos($("#curso"));
        }
    };
}();
function getAllCursos($el) {
    var JSONvar = {};
    JSONvar["genericMethod"] = "selAllCursos";

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/notas.php',
        type:  'post',
        beforeSend: function () {
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                if (obj) {
                    var row = JSON.parse(obj);
                    addValuesToSelect($el,row.NUMCURSO,row.NOMCURSO);
                }

            });


        }

    });
}
function getAllEstudiantes() {
    var JSONvar = {};
    JSONvar["genericMethod"] = "selAllEstudiantes";

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/notas.php',
        type:  'post',
        beforeSend: function () {
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                if (obj) {
                    var row = JSON.parse(obj);
                    addValuesToSelect($('#estudiante'),row.CEDPERSONA,row.NOMPERSONA+' '+row.APE1PERSONA+' '+row.APE2PERSONA);
                }

            });

        }

    });
}
function addModNota() {
    var $horE = $('#cursos'),
        $horS = $('#estudiante'),
        JSONvar = {};
    JSONvar['genericMethod'] = $('.addUpd').text() === ' Añadir' ? 'agregar' : 'actualizar';
    JSONvar['curso'] = $horE.val();
    JSONvar['numNota'] = $('.addUpd').attr('data-value') ? $('.addUpd').attr('data-value') : '';
    JSONvar['estudiante'] = $horS.val();
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/notas.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            console.log(response);
            if (response === 'Done') {
                $('#notasModal').modal('hide');
                window.location.reload(true);
            }else {
                fnShowMessage('Error.', 'Intente de nuevo', 'assets/img/warninAlert.png', false,3000);

            }
        }
    });
    return  false;

}

function getNotaById($el) {
    $('#notasModal').modal('show');
    $('.addUpd').html("<i class='fa fa-check'></i> Actualizar");
    $('h4.mb').text('Actualizar datos');
    var valSearch = $el.attributes[1].value,
        JSONvar = {};
    getAllCursos($("#cursos"));
    getAllEstudiantes();
    JSONvar['genericMethod'] = 'selNotaById';
    JSONvar['numNota'] = valSearch;
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/notas.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            var data = JSON.parse(response);
            $('.addUpd').attr('data-value',data[0].NUMNOTA);
            $('#cursos').val(data[0].NUMCURSO);
            $('#estudiante').val(data[0].CEDPERSONA);
        }
    });
}
function remNota($el) {
    $('#confirmModal').modal('show');
    $(".sendErase").click(function() {
        var JSONVAR = {},
            valSearch = $el.attributes[1].value;
        JSONVAR['genericMethod'] = 'remover';
        JSONVAR['numNota'] = parseInt(valSearch,10);
        $.ajax({
            data:  JSONVAR,
            url:   'assets/php/notas.php',
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

function fnGetNotas() {
    var JSONvar = {},
        value = $('#curso').val();
    JSONvar["genericMethod"] = "selAllNotas";
    JSONvar["numCurso"] = value;
    var htmlTable = $("#NotasTable").dataTable({
        retrieve:true,
        "mRender": function (data, type, full) {
            return "<a class='btn btn-info btn-sm' href=#></a>";
        }
    });
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/notas.php',
        type:  'post',
        beforeSend: function () {
        },
        success:  function (response) {
            var response = JSON.parse(response);
            if (response.length > 0) {
                $.each(response, function (idx, obj) {
                    var row = JSON.parse(obj),
                        $edit = "<button class='btn btn-primary btn-xs' data-value=" + row.NUMNOTA + " onclick='getNotaById(this)'><i class='fa fa-pencil'></i></button>",
                        $remove = "<button class='btn btn-danger btn-xs' data-value=" + row.NUMNOTA + " onclick='remNota(this)'><i class='fa fa-trash-o '></i></button>";
                    htmlTable.fnClearTable();
                    htmlTable.fnDraw();
                    htmlTable.fnAddData([row.NUMNOTA, row.NOMCURSO, row.estudiante, $edit + ' ' + $remove]);

                });
            }else {
                htmlTable.fnClearTable();
                htmlTable.fnDraw();
            }

        }

    });
}

function addValuesToSelect($sel, index,value) {
        var opt = document.createElement("option");
        opt.value = index;
        opt.innerHTML = value;
        $sel.append(opt);
}