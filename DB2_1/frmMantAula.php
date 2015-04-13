<?php include("header.php");?>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="newAulaModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Configuración Aula.</h4>
                </div>
                <div class="modal-body" id="for_loop">
                    <h4><i class="fa fa-angle-right"></i> Datos Aula</h4><br/>

                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Numero de Aula*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="formnumAula" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Detalle*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="formdesAula" style="resize:none" maxlength="100"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tipo de Aula*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="formtipAula">
                                <option value="Aula">Aula</option>
                                <option value="Laboratorio">Laboratorio</option>
                                <option value="Biblioteca">Biblioteca</option>
                                <option value="Gimnasio">Gimnasio</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <!--<button data-dismiss="modal" class="btn btn-theme04 deleteUser" type="button">Elminar</button>-->
                    <button data-dismiss="modal" class="btn btn-warning sendUpdAula" type="button">Actualizar</button>
                    <button data-dismiss="modal" class="btn btn-theme sendNewAula" type="button">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="confirmAulaModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">  Confirmación de Acción</h4>
                </div>
                <div class="modal-body" id="for_loop">
                    <h4><i class="fa fa-angle-right"></i> Seguro que desea eliminar el reguistro?.</h4><br/>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <button data-dismiss="modal" class="btn btn-theme sendEraseAula" type="button">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <h3><i class="fa fa-angle-right"></i> Configuración Aulas</h3>
    <div class="row mt">
        <div class="col-lg-12">
            <p>Lista de Aulas</p>
        </div>
    </div>

    <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-theme04" id="addAulaBtn"> <i class="fa fa-plus"></i> Crear Nuevo.</button>
    </div>

    <div class="col-lg-12">
        <div class="form-panel">
            <table class="table" id="aulasTable">
                <thead>
                <tr>
                    <th>Código del Aula</th>
                    <th>Detalle del Aula</th>
                    <th>Tipo de Aula</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

<?php include("footer.php"); ?>

<link href="assets/css/jquery.dataTables.css" rel="stylesheet">
<script type="application/javascript" src="assets/js/jquery.dataTables.js"></script>
<script type="application/javascript" src="assets/js/controllers/matAula_Controller.js"></script>

<script type="application/javascript">
    $( document ).ready(function() {
        initLogic.init();
        initComponents.init();
        initmatAula_Controls.init();
    });
</script>