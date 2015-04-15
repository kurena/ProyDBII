var initControls = function() {
    return {
        init: function() {
            this.loadData();
            var self = this;
            $("#add").click(function(){
                $('#convBecaModal').modal('show');
                $('.addUpd').html("<i class='fa fa-check'></i> Añadir");
                $('h4.mb').text('Ingresar datos');
                $('#nomConvbeca').val('');
                $('#tipo').val('');


            });
            $(".back").click(function() {
                $('#convBecaModal').modal('hide');

            });

            $('#porcentaje').keyup(function () {
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });
        },
        loadData : function() {
            var htmlTable = $("#ConvbecaTable").dataTable({
                "mRender": function(data, type, full) {
                    return "<a class='btn btn-info btn-sm' href=#></a>";
                }
            });

            var JSONvar = {};
            JSONvar["genericMethod"] = "selAllConvBeca";

            $.ajax({
                data:  JSONvar,
                url:   'assets/php/convbeca.php',
                type:  'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    $.each(JSON.parse(response), function (idx, obj) {
                        if (obj) {
                            var row = JSON.parse(obj),
                                $edit = "<button class='btn btn-primary btn-xs' data-value="+row.NUMCONVEBECA+" onclick='getConvbecaById(this)'><i class='fa fa-pencil'></i></button>",
                                $remove = "<button class='btn btn-danger btn-xs' data-value="+row.NUMCONVEBECA+" onclick='remConvbeca(this)'><i class='fa fa-trash-o '></i></button>";
                            htmlTable.fnAddData([row.NUMCONVEBECA,row.NOMCONVEBECA,row.TIPCONVEBECA,row.PORCCONVEBECA,$edit+' '+$remove]);

                        }

                    });

                }
            });
        }
    };
}();
function addModConvBeca() {
    var $name = $('#nomConvbeca'),
        $tipo = $('#Tipo'),
        $porc = $("#porcentaje"),
        JSONvar = {};
    JSONvar['genericMethod'] = $('.addUpd').text() === ' Añadir' ? 'agregar' : 'actualizar';
    JSONvar['nomConvBeca'] = $name.val();
    JSONvar['numConvBeca'] = $('.addUpd').attr('data-value') ? $('.addUpd').attr('data-value') : '';
    JSONvar['tipo'] = $tipo.val();
    JSONvar['porcentaje'] = $porc.val();
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/convbeca.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            console.log(response);
            if (response === 'Done') {
                $('#convBecaModal').modal('hide');
                window.location.reload(true);
            }else {
                fnShowMessage('Error.', 'Error, intente de nuevo', 'assets/img/warninAlert.png', false,3000);

            }
        }
    });
    return  false;

}

function getConvbecaById($el) {
    $('#convBecaModal').modal('show');
    $('.addUpd').html("<i class='fa fa-check'></i> Actualizar");
    $('h4.mb').text('Actualizar datos');
    var valSearch = $el.attributes[1].value,
       JSONvar = {};
    JSONvar['genericMethod'] = 'selConvBecaById';
    JSONvar['nomConvBeca'] = valSearch;
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/convbeca.php',
        type:  'post',
        beforeSend: function () {

        },
        success:  function (response) {
            var data = JSON.parse(response);
            $('.addUpd').attr('data-value',data[0].NUMCONVEBECA);
            $('#nomConvbeca').val(data[0].NOMCONVEBECA);
            $('#Tipo').val(data[0].TIPCONVEBECA);
            $('#porcentaje').val(data[0].PORCCONVEBECA);
        }
    });
}
function remConvbeca($el) {
    $('#confirmModal').modal('show');
    $(".sendErase").click(function() {
        var JSONVAR = {},
            valSearch = $el.attributes[1].value;
        JSONVAR['genericMethod'] = 'remover';
        JSONVAR['numConvBeca'] = parseInt(valSearch,10);
        $.ajax({
            data:  JSONVAR,
            url:   'assets/php/convbeca.php',
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