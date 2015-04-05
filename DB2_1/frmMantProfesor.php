<?php include("header.php");?>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="newProfesorModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Crear nuevo Usuario - Rol Profesor</h4>
                </div>
                <div class="modal-body" id="for_loop">
                    <h4><i class="fa fa-angle-right"></i> Datos Personales</h4><br/>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Cedula*</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="formCedula">
                        </div>
                        <div class="col-sm-3 text-right">
                            <button class="btn btn-default findPerson" type="button"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nombre*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="formnombre">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Apellido 1*</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="formape1">
                        </div>
                        <label class="col-sm-2 col-sm-2 control-label">Apellido 2*</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="formape2">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Direecion*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="formdireccion">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Numero Tel*</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="formtel">
                        </div>
                        <label class="col-sm-2 col-sm-2 control-label">Email*</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="formemail">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Fec Nacimiento*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" id="formfecNaci">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <!--<button data-dismiss="modal" class="btn btn-theme04 deleteUser" type="button">Elminar</button>-->
                    <button data-dismiss="modal" class="btn btn-warning sendUpdUser" type="button">Actualizar</button>
                    <button data-dismiss="modal" class="btn btn-theme sendNewUser" type="button">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <h3><i class="fa fa-angle-right"></i> Configuración Profesor</h3>
    <div class="row mt">
        <div class="col-lg-12">
            <p>Lista de Profesores</p>
        </div>
    </div>

    <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-theme04" id="addProfesorBtn"> <i class="fa fa-plus"></i> Crear Nuevo.</button>
    </div>

    <div class="col-lg-12">
        <div class="form-panel">
            <table class="table" id="profesoresTable">
                <thead>
                <tr>
                    <th></th>
                    <th>Identificación</th>
                    <th>Primer Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Telefono</th>
                    <th>Correo</th>
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
<script type="application/javascript" src="assets/js/controllers/matProfesor_Controller.js"></script>

<script type="application/javascript">
    $( document ).ready(function() {
        initLogic.init();
        initComponents.init();
        initmatProfesorControls.init();
    });
</script>