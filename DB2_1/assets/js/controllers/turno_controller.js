var initControls = function() {
    return {
        init: function() {
            var htmlTable = $("#TurnosTable").dataTable();

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
                        var row = JSON.parse(obj);
                        htmlTable.fnAddData([row.NUMTURNO,row.HORENTRADA,row.HORSALIDA]);
                    });

                }
            });
        }
    };
}();