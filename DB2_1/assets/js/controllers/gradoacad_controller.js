var initControls = function() {
    return {
        init: function() {
            this.loadData();
            var self = this;
            $("#add").click(function(){
                $('#gradoAcadModal').modal('show');
                $('.addUpd').html("<i class='fa fa-check'></i> Añadir");
                $('h4.mb').text('Ingresar datos');
                $('#nomGrado').val('');
                $('#institucion').val('');
                fillSelects();

            });
            $(".back").click(function() {
                $('#gradoAcadModal').modal('hide');

            });
        },
        loadData : function() {
            var htmlTable = $("#GradoAcadTable").dataTable({
                "mRender": function(data, type, full) {
                    return "<a class='btn btn-info btn-sm' href=#></a>";
                }
            });

            var JSONvar = {};
            JSONvar["genericMethod"] = "selAllGradAcad";

            $.ajax({
                data:  JSONvar,
                url:   'assets/php/gradoacad.php',
                type:  'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    $.each(JSON.parse(response), function (idx, obj) {
                        if (obj) {
                            var row = JSON.parse(obj),
                                $edit = "<button class='btn btn-primary btn-xs' data-value="+row.NUMGRADOACADE+" onclick='getGradoAcadById(this)'><i class='fa fa-pencil'></i></button>",
                                $remove = "<button class='btn btn-danger btn-xs' data-value="+row.NUMGRADOACADE+" onclick='remGradoAcad(this)'><i class='fa fa-trash-o '></i></button>";
                            htmlTable.fnAddData([row.NUMGRADOACADE,row.GRADACAPROFESOR,row.INSTGRADOACADEMICO,row.profesor,$edit+' '+$remove]);

                        }

                    });

                }
            });
        }
    };
}();
function addModGradoAcad() {
    var $name = $('#nomGrado'),
        $inst = $('#institucion'),
        $porc = $("#Profesor"),
        JSONvar = {};
    JSONvar['genericMethod'] = $('.addUpd').text() === ' Añadir' ? 'agregar' : 'actualizar';
    JSONvar['nomGrado'] = $name.val();
    JSONvar['numGrado'] = $('.addUpd').attr('data-value') ? $('.addUpd').attr('data-value') : '';
    JSONvar['institucion'] = $inst.val();
    JSONvar['profesor'] = parseInt($porc.val(),10);
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/gradoacad.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            console.log(response);
            if (response === 'Done') {
                $('#gradoAcadModal').modal('hide');
                window.location.reload(true);
            }else {
                fnShowMessage('Error.', 'Error, intente de nuevo', 'assets/img/warninAlert.png', false,3000);

            }
        }
    });
    return  false;

}

function getGradoAcadById($el) {
    $('#gradoAcadModal').modal('show');
    $('.addUpd').html("<i class='fa fa-check'></i> Actualizar");
    $('h4.mb').text('Actualizar datos');
    fillSelects();
    var valSearch = $el.attributes[1].value,
        JSONvar = {};
    JSONvar['genericMethod'] = 'selGradoAcadById';
    JSONvar['numGrado'] = valSearch;
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/gradoacad.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            var data = JSON.parse(response);
            $('.addUpd').attr('data-value',data[0].NUMGRADOACADE);
            $('#nomGrado').val(data[0].GRADACAPROFESOR);
            $('#institucion').val(data[0].INSTGRADOACADEMICO);
            $('#Profesor').val(data[0].CEDPROFESOR);
        }
    });
}
function remGradoAcad($el) {
    if (confirm('Seguro que desea eliminar este dato?')) {
        var JSONVAR = {},
            valSearch = $el.attributes[1].value;
        JSONVAR['genericMethod'] = 'remover';
        JSONVAR['numGrado'] = parseInt(valSearch,10);
        $.ajax({
            data:  JSONVAR,
            url:   'assets/php/gradoacad.php',
            type:  'post',
            beforeSend: function () {

            },
            success:  function (response) {
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
    var $prof = $("#Profesor");
    $prof.find('option').remove();
    var JSONvar = {};
    JSONvar["genericMethod"] = "listar";

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matProfesor_Logic.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                if (obj) {
                    var row = JSON.parse(obj);
                    JSONvar[row.CEDPERSONA] = row.NOMPERSONA+ " "+ row.APE1PERSONA+" "+row.APE2PERSONA;
                }

            });
            delete JSONvar['genericMethod'];
            addValuesToSelect($prof,JSONvar);
        }
    });
}