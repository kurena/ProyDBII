<?php include("header.php");?>
<h3><i class="fa fa-angle-right"></i> Reportes</h3>
<div class="row mt">
        <div class="col-lg-6">
            <div class="form-panel">
                <h4><i class="fa fa-angle-right"></i> Grupos por curso</h4>
                <div class="panel-body">
                    <h5>Seleccione la Cátedra:</h5>
                    <select style="width:250px;height:32px" id="catedras" name="catedras" required="true" ></select>
                    <button type="button" class="btn btn-theme04" id="search" onClick="generateCatedraChar()"> <i class="fa fa-bar-chart"></i> Generar</button>
                    <div id="hero-bar" class="graph"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-panel">
                <h4><i class="fa fa-angle-right"></i> Cantidad de grupos por Aula (>1)</h4>
                <div class="panel-body">
                    <div id="hero-donut" class="graph"></div>
                </div>
            </div>
        </div>
    </div>
<?php include("footer.php");?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script type="application/javascript" src="assets/js/controllers/configuracion_Controller.js"></script>
<script type="application/javascript">
    $( document ).ready(function() {
        initLogic.init();
        initComponents.init();
        initConfiguracionControls.init();
    });
</script>