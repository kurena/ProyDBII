var initControls = function() {
    return {
        init: function() {
            this.loadData();
            var self = this;
            $("#add").click(function(){
                $('#paisModal').modal('show');
                $('.addUpd').html("<i class='fa fa-check'></i> Añadir");
                $('h4.mb').text('Ingresar datos');
                $('#nomPais').val('');
                $('#codTelef').val('');

            });
            $(".back").click(function() {
                $('#paisModal').modal('hide');

            });
        },
        loadData : function() {
            var htmlTable = $("#PaisesTable").dataTable({
                "mRender": function(data, type, full) {
                    return "<a class='btn btn-info btn-sm' href=#></a>";
                }
            });

            var JSONvar = {};
            JSONvar["genericMethod"] = "selAllPaises";

            $.ajax({
                data:  JSONvar,
                url:   'assets/php/paises.php',
                type:  'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    $.each(JSON.parse(response), function (idx, obj) {
                        if (obj) {
                            var row = JSON.parse(obj),
                                $edit = "<button class='btn btn-primary btn-xs' data-value="+row.NUMPAIS+" onclick='getPaisById(this)'><i class='fa fa-pencil'></i></button>",
                                $remove = "<button class='btn btn-danger btn-xs' data-value="+row.NUMPAIS+" onclick='remPais(this)'><i class='fa fa-trash-o '></i></button>";
                            htmlTable.fnAddData([row.NUMPAIS,row.NOMPAIS,row.CODTELEFONICCO,$edit+' '+$remove]);

                        }

                    });

                }
            });
        }
    };
}();
function addModPais() {
    var $name = $('#nomPais'),
        $cod = $('#codTelef'),
        JSONvar = {};
    JSONvar['genericMethod'] = $('.addUpd').text() === ' Añadir' ? 'agregar' : 'actualizar';
    JSONvar['nomPais'] = $name.val();
    JSONvar['numPais'] = $('.addUpd').attr('data-value') ? $('.addUpd').attr('data-value') : '';
    JSONvar['codPais'] = $cod.val();
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/paises.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            console.log(response);
            if (response === 'Done') {
                $('#paisModal').modal('hide');
                window.location.reload(true);
            }else {
                fnShowMessage('Error.', 'El pais ya existe, intente de nuevo', 'assets/img/warninAlert.png', false,3000);

            }
        }
    });
    return  false;

}

function getPaisById($el) {
    $('#paisModal').modal('show');
    $('.addUpd').html("<i class='fa fa-check'></i> Actualizar");
    $('h4.mb').text('Actualizar datos');
    var valSearch = $el.attributes[1].value,
       JSONvar = {};
    JSONvar['genericMethod'] = 'selPaisById';
    JSONvar['nomPais'] = valSearch;
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/paises.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            var data = JSON.parse(response);
            $('.addUpd').attr('data-value',data[0].NUMPAIS);
            $('#nomPais').val(data[0].NOMPAIS);
            $('#codTelef').val(data[0].CODTELEFONICCO);
        }
    });
}
function remPais($el) {
    $('#confirmModal').modal('show');
    $(".sendErase").click(function() {
        var JSONVAR = {},
            valSearch = $el.attributes[1].value;
        JSONVAR['genericMethod'] = 'remover';
        JSONVAR['numPais'] = parseInt(valSearch,10);
        $.ajax({
            data:  JSONVAR,
            url:   'assets/php/paises.php',
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