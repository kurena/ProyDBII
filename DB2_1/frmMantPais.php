<?php include("header.php");?>
<head>
    <link href="assets/css/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
</head>
<h3><i class="fa fa-angle-right"></i>Países</h3>
<button type="button" class="btn btn-success" id="add"><i class="fa fa-plus-square-o"></i> Nuevo</button>
<div class="col-md-12 panel-body">
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i>Datos</h4>
        <hr>
        <table class="table" id="PaisesTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Cod. Telefónico</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><! --/content-panel -->

    <div class="form-panel" style="display: none">
        <h4 class="mb"><i class="fa fa-angle-right"></i>Ingresar Datos</h4>
        <form class="form-horizontal style-form" onsubmit="return addModPais(this)">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomPais" required="true">
                </div>
                <hr>
                <label class="col-sm-2 col-sm-2 control-label">Cod. Telefónico</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="codTelef" required="true">
                </div>
                <div class="col-sm-10">
                    <button type="button" class="btn btn-theme02 back"><i class="fa fa-arrow-left"></i> Atrás</button>
                    <button type="submit" class="btn btn-theme02 addUpd"></button>
                </div>

            </div>
        </form>
    </div>
</div><!-- /col-md-12 -->
<?php include("footer.php"); ?>
<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--common script for all pages-->
<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="assets/js/gritter-conf.js"></script>
<script src="assets/js/common-scripts.js"></script>
<script type="text/javascript" src="assets/js/utilities/funsComunes.js"></script>

<script src="assets/js/controllers/pais_controller.js"></script>
<!--script for this page-->
<script type="application/javascript">
    initControls.init();
</script>