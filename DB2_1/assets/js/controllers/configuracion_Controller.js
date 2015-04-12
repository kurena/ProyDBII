/*configuracion_Controller
  JS que controla a la vista (php) y conserva
  la lógica conservada en un solo archivo.

  Daniel Fernandez Solano.
*/

var initConfiguracionControls = function(){
    return {
        init: function(){
            var JSONvar = {};
            var data = [],
                data2 = [];
            JSONvar['genericMethod'] = 'getCursosPorCatedra';
            JSONvar['codCatedra'] = 1;
            $.ajax({
                data: JSONvar,
                url: 'assets/php/reportes.php',
                type: 'post',
                beforeSend: function () {

                },
                success: function (response) {
                    $.each(JSON.parse(response), function (idx, obj) {
                        if (obj) {
                            var row = JSON.parse(obj),
                                tmpObj = {
                                    "Cantidad Cursos":parseInt(row.Cantidad),
                                    label: row.NOMCURSO
                                },
                                tmpObj2 = {
                                    value:parseInt(row.Cantidad),
                                    label: row.NOMCURSO
                                };
                            data.push(tmpObj);
                            data2.push(tmpObj2);
                        }
                    });
                    Morris.Bar({
                        element: 'hero-bar',
                        data: data,
                        xkey: 'label',
                        ykeys: ['Cantidad Cursos'],
                        labels: ['Cantidad Cursos'],
                        barRatio: 0.4,
                        xLabelAngle: 35,
                        hideHover: 'auto',
                        barColors: ['#ac92ec']
                    });
                    Morris.Donut({
                        element: 'hero-donut',
                        data: data2,
                        colors: ['#3498db', '#2980b9', '#34495e']
                    });
                }
            });


        }
    };
}();
