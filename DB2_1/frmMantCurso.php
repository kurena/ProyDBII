<?php include("header.php");?>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="newCursoModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Configuración Curso.</h4>
                </div>
                <div class="modal-body" id="for_loop">
                    <h4><i class="fa fa-angle-right"></i> Datos Curso</h4><br/>

                    <input type="text" id="formnumCurso" hidden>

                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nombre de Curso*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="formnombreCurso">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Detalle*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="formdesCurso" style="resize:none" maxlength="100"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Creditos*</label>
                        <div class="col-sm-10">
                            <input type="number" min="1" max="100" step="1" class="form-control" id="formcreCurso" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Costo de Curso*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="formcostoCurso">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Catedra*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="formCatedra" name="formCatedra">
                            </select>
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
                    <button data-dismiss="modal" class="btn btn-warning sendUpdCurso" type="button">Actualizar</button>
                    <button data-dismiss="modal" class="btn btn-theme sendNewCurso" type="button">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <h3><i class="fa fa-angle-right"></i> Configuración Cursos</h3>
    <div class="row mt">
        <div class="col-lg-12">
            <p>Lista de Cursos</p>
        </div>
    </div>

    <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-theme04" id="addCursoBtn"> <i class="fa fa-plus"></i> Crear Nuevo.</button>
    </div>

    <div class="col-lg-12">
        <div class="form-panel">
            <table class="table" id="cursosTable">
                <thead>
                <tr>
                    <th>Código del Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Detalle del Curso</th>
                    <th>Creditos</th>
                    <th>Costo</th>
                    <th>Catedra</th>
                    <th>Profesor</th>
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
<script type="application/javascript" src="assets/js/controllers/cursos_Controller.js"></script>

<script type="application/javascript">
    $( document ).ready(function() {
        initLogic.init();
        initComponents.init();
        initCursos_Controls.init();
    });
</script>