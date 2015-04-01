var initControls = function() {
    return {
        init: function() {
            var htmlTable = $("#PaisesTable").dataTable();

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
                            var row = JSON.parse(obj);
                            htmlTable.fnAddData([row.NUMPAIS,row.NOMPAIS,row.CODTELEFONICCO]);
                        }

                    });

                }
            });
        }
    };
}();