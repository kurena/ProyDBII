<?php include("header.php");?>
<h3><i class="fa fa-angle-right"></i> Configuracion Grados Académicos Profesor</h3>
<div class="col-lg-12 text-right">
    <button type="button" class="btn btn-theme04" id="add"> <i class="fa fa-plus"></i> Nuevo</button>
</div>
<div class="col-md-12 panel-body">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4><i class="fa fa-angle-right"></i> Lista de Grados Académicos Profesores</h4>
            <hr>
            <table class="table" id="GradoAcadTable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Grado Académico</th>
                    <th>Institución</th>
                    <th>Profesor</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /col-md-12 -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="gradoAcadModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Configuracíón de Grados Académicos Profesor</h4>
            </div>
            <div class="modal-body" id="for_loop">
                <form class="form-horizontal style-form" onsubmit="return addModGradoAcad(this)">
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nombre Grado Académico*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomGrado" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Institución*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="institucion" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Profesor*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="Profesor" name="Profesor" required></select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Cancelar</button>
                <button type="submit" class="btn btn-theme addUpd"></button>
            </div>
            </form>

        </div>
    </div>
</div>

<?php include("footer.php"); ?>
<!-- js placed at the end of the document so the pages load faster -->
<link href="assets/css/jquery.dataTables.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/js/gritter/css/jquery.gritter.css" />

<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!--common script for all pages-->
<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="assets/js/gritter-conf.js"></script>
<script src="assets/js/common-scripts.js"></script>
<script type="text/javascript" src="assets/js/utilities/funsComunes.js"></script>

<script src="assets/js/controllers/gradoacad_controller.js"></script>
<!--script for this page-->
<script type="application/javascript">
    initControls.init();
</script>