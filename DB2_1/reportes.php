<?php include("header.php");?>
<div class="row mt">
        <div class="col-lg-6">
            <div class="form-panel">
                <h4><i class="fa fa-angle-right"></i> Estadisticas #1</h4>
                <div class="panel-body">
                    <div id="hero-bar" class="graph"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-panel">
                <h4><i class="fa fa-angle-right"></i> Estadisticas #2</h4>
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