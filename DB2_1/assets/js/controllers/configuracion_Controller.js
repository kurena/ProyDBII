/*configuracion_Controller
  JS que controla a la vista (php) y conserva
  la lógica conservada en un solo archivo.

  Daniel Fernandez Solano.
*/

var initConfiguracionControls = function(){
    return {
        init: function(){
            getAllCatedras();
            generateAulaChar();
        }
    };
}();
function getAllCatedras() {
    var JSONvar = {};
    JSONvar['genericMethod'] = 'listar';
    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matCatedra_Logic.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            $.each(JSON.parse(response), function (idx, obj) {
                if (obj) {
                    var row = JSON.parse(obj);
                    addValuesToSelect($('#catedras'),row.NUMCATEDRA,row.NOMCATEDRA);
                }
            });
        }
    })
}

function generateCatedraChar() {
    $('#hero-bar').children().remove();
    var JSONvar = {};
    var data = [];
    JSONvar['genericMethod'] = 'getCursosPorCatedra';
    JSONvar['codCatedra'] = $('#catedras').val();
    $.ajax({
        data: JSONvar,
        url: 'assets/php/reportes.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            response = JSON.parse(response);
            if (response.length > 0) {
                $.each(response, function (idx, obj) {
                    if (obj) {
                        var row = JSON.parse(obj),
                            tmpObj = {
                                "Cantidad Cursos":parseInt(row.Cantidad),
                                label: row.NOMCURSO
                            };
                        data.push(tmpObj);
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
            }
        }
    });
}

function generateAulaChar() {
    var JSONvar = {};
    var data = [];
    JSONvar['genericMethod'] = 'getMaxAulas';
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
                            value: parseInt(row.Cantidad),
                            label: row.Nombre
                        };
                    data.push(tmpObj);
                }
            });
            Morris.Donut({
                element: 'hero-donut',
                data: data,
                colors: ['#3498db', '#2980b9', '#34495e']
            });
        }
    });
}

function addValuesToSelect($sel, index,value) {
    var opt = document.createElement("option");
    opt.value = index;
    opt.innerHTML = value;
    $sel.append(opt);
}
