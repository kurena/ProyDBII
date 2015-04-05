<?php include("header.php");?>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="newCatedraModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Configuracion de Catedra</h4>
                </div>
                <div class="modal-body" id="for_loop">
                    <h4><i class="fa fa-angle-right"></i> Datos de Catedra</h4><br/>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Código de Catedra*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="formcodCatedra" disabled>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nombre de Catedra*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="formnomCatedra" maxlength="32">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Detalle*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="formdesCatedra" style="resize:none" maxlength="100"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Coordinador*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="formCoordinador" name="formCoordinador">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <!--<button data-dismiss="modal" class="btn btn-theme04 deleteUser" type="button">Elminar</button>-->
                    <button data-dismiss="modal" class="btn btn-warning sendUpdCatedra" type="button">Actualizar</button>
                    <button data-dismiss="modal" class="btn btn-theme sendNewCatedra" type="button">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <h3><i class="fa fa-angle-right"></i> Configuración Catedra</h3>
    <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-theme04" id="addCatedraBtn"> <i class="fa fa-plus"></i> Crear Nuevo.</button>
    </div>

    <div class="col-lg-12">
        <div class="form-panel">
            <h4><i class="fa fa-angle-right"></i> Lista de Catedras</h4>
            <hr>
            <table class="table" id="catedrasTable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Coordinador</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

<?php include("footer.php"); ?>

<link href="assets/css/jquery.dataTables.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" rel="stylesheet">

<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script type="application/javascript" src="assets/js/jquery.dataTables.js"></script>
<script type="application/javascript" src="assets/js/controllers/matCatedra_Controller.js"></script>

<script type="application/javascript">
    $( document ).ready(function() {
        initLogic.init();
        initComponents.init();
        initmatCatedra_Controls.init();
    });
</script>