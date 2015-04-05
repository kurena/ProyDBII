/*configuracion_Controller
  JS que controla a la vista (php) y conserva
  la lógica conservada en un solo archivo.

  Daniel Fernandez Solano.
*/

var initConfiguracionControls = function(){
    return {
        init: function(){
            Morris.Bar({
                element: 'hero-bar',
                data: [
                    {device: 'iPhone', geekbench: 136},
                    {device: 'iPhone 3G', geekbench: 137},
                    {device: 'iPhone 3GS', geekbench: 275},
                    {device: 'iPhone 4', geekbench: 380},
                    {device: 'iPhone 4S', geekbench: 655},
                    {device: 'iPhone 5', geekbench: 1571}
                ],
                xkey: 'device',
                ykeys: ['geekbench'],
                labels: ['Geekbench'],
                barRatio: 0.4,
                xLabelAngle: 35,
                hideHover: 'auto',
                barColors: ['#ac92ec']
            });

            Morris.Donut({
                element: 'hero-donut',
                data: [
                    {label: 'Jam', value: 25 },
                    {label: 'Frosted', value: 40 },
                    {label: 'Custard', value: 25 },
                    {label: 'Sugar', value: 10 }
                ],
                colors: ['#3498db', '#2980b9', '#34495e'],
                formatter: function (y) { return y + "%" }
            });
        }
    };
}();
