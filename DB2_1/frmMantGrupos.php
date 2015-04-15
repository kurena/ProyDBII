<?php include("header.php");?>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="newGrupoModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Configuración Grupo.</h4>
                </div>
                <div class="modal-body" id="for_loop">
                    <h4><i class="fa fa-angle-right"></i> Datos Grupo</h4><br/>



                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <!--<button data-dismiss="modal" class="btn btn-theme04 deleteUser" type="button">Elminar</button>-->
                    <button data-dismiss="modal" class="btn btn-warning sendUpdGrupo" type="button">Actualizar</button>
                    <button data-dismiss="modal" class="btn btn-theme sendNewGrupo" type="button">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="confirmGrupoModal" class="modal fade">
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
                    <button data-dismiss="modal" class="btn btn-theme sendEraseGrupo" type="button">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <h3><i class="fa fa-angle-right"></i> Configuración Grupos</h3>
    <div class="row mt">
        <div class="col-lg-12">
            <p>Lista de Grupos</p>
        </div>
    </div>

    <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-theme04" id="addGrupoBtn"> <i class="fa fa-plus"></i> Crear Nuevo.</button>
    </div>

    <div class="col-lg-12">
        <div class="form-panel">
            <table class="table" id="gruposTable">
                <thead>
                <tr>
                    <th>Código del Grupo</th>
                    <th>Código de Curso</th>
                    <th>Nombre Curso</th>
                    <th>Código de Aula</th>
                    <th>Dia</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Sálida</th>
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
<script type="application/javascript" src="assets/js/controllers/matGrupos_Controller.js"></script>

<script type="application/javascript">
    $( document ).ready(function() {
        initLogic.init();
        initComponents.init();
        initmatGrupos_Controls.init();
    });
</script>