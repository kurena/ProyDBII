<?php include("header.php");?>
    <style>
        #findEstudiantesModal .modal-dialog
        {
            width: 70%;
        }
        #findCatedraModal .modal-dialog
        {
            width: 50%;
        }
    </style>

    <h3><i class="fa fa-angle-right"></i> Crear Matricula</h3>
    <div class="row mt">
        <div class="col-lg-12">
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="findEstudiantesModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Estudiantes.</h4>
                </div>
                <div class="modal-body" id="for_loop">
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
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="findCatedraModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Catedras.</h4>
                </div>
                <div class="modal-body" id="for_loop">
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
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <section id="wizard">
            <div id="rootwizard">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="text-center">
                            <ul>
                                <li><a href="#tab1" data-toggle="tab">Datos de Estudiante</a></li>
                                <li><a href="#tab2" data-toggle="tab">Datos de la Matricula</a></li>
                                <li><a href="#tab3" data-toggle="tab">Datos Monetarios Matricula</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="row mt">
                                    <div class="col-lg-12">
                                        <div class="form-panel">
                                            <h4><i class="fa fa-male text-primary"></i> Datos Personales del Estudiante.</h4>
                                            <br/>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Cedula*</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="formCedula" readonly>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <button class="btn btn-default findPerson" type="button"><i class="fa fa-search"></i> Buscar Persona</button>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Nombre*</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="formnombre" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Apellido 1*</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="formape1" readonly>
                                                </div>
                                                <label class="col-sm-2 col-sm-2 control-label">Apellido 2*</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="formape2" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Direecion*</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="formdireccion" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Numero Tel*</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="formtel" readonly>
                                                </div>
                                                <label class="col-sm-2 col-sm-2 control-label">Email*</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="formemail" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Fec Nacimiento*</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" id="formfecNaci" readonly>
                                                </div>
                                            </div>

                                            <!--;-->
                                            <hr/>
                                            <!--;-->

                                            <h4><i class="fa fa-university text-primary"></i> Datos de Catedra</h4><br/>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Código de Catedra*</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="formcodCatedra" disabled>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <button class="btn btn-default findCatedra" type="button"><i class="fa fa-search"></i> Buscar Catedra</button>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Nombre de Catedra*</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="formnomCatedra" maxlength="32" disabled>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Detalle*</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="5" id="formdesCatedra" style="resize:none" maxlength="100" disabled></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Coordinador*</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="formCoordinador" maxlength="32" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="row mt">
                                    <div class="col-lg-12">
                                        <div class="form-panel">
                                            <h4><i class="fa fa-angle-right"></i> Materias.</h4>
                                            <br/>
                                            <div class="row form-group">
                                                <!--;-->
                                                <div class="col-lg-6 text-center">
                                                    <h4><i class="fa fa-list-alt text-primary"></i> Materias Existentes.</h4>
                                                    <table class="table" id="gruposExist">
                                                        <thead>
                                                        <tr>
                                                            <th>Código del Grupo</th>
                                                            <th>Código de Curso</th>
                                                            <th>Nombre Curso</th>
                                                            <th>Código de Aula</th>
                                                            <th>Dia</th>
                                                            <th>Hora de Entrada</th>
                                                            <th>Hora de Sálida</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--;-->
                                                <div class="col-lg-6 text-center">
                                                    <h4><i class="fa fa-book text-primary"></i> Materias a Matricular.</h4>
                                                    <table class="table" id="gruposDo">
                                                        <thead>
                                                        <tr>
                                                            <th>Código del Grupo</th>
                                                            <th>Código de Curso</th>
                                                            <th>Nombre Curso</th>
                                                            <th>Código de Aula</th>
                                                            <th>Dia</th>
                                                            <th>Hora de Entrada</th>
                                                            <th>Hora de Sálida</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--;-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="row mt">
                                    <div class="col-lg-12">
                                        <div class="form-panel">
                                            <h4><i class="fa fa-angle-right"></i> Datos monetarios de la Matricula.</h4>
                                            <br/>
                                            <div class="row form-group">
                                                <!--;-->
                                                <div class="col-lg-6 text-center">
                                                    <h4><i class="fa fa-male text-primary"></i> Datos de Estudiante.</h4>
                                                    <table style="width:80%">
                                                        <tr>
                                                            <td rowspan="10" class="PhotoClass"></td>
                                                            <td class="Cedulaclass"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="NombreClass"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="DireccionClass"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="TelefonoClass"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="EmailClass"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="NaciClass"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!--;-->
                                                <div class="col-lg-6 text-center">
                                                    <h4><i class="fa fa-money text-primary"></i> Totales.</h4>
                                                    <table style="width:100%" id="matrculadosTable">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:16%" class="text-center">Materia</th>
                                                            <th style="width:16%" class="text-center">Costo</th>
                                                            <th style="width:16%" class="text-center">Codigo de Aula</th>
                                                            <th style="width:16%" class="text-center">Dia</th>
                                                            <th style="width:16%" class="text-center">Hora Entrada</th>
                                                            <th style="width:16%" class="text-center">Hora Salida</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <hr/>
                                                    <table style="width:100%" id="totalTable">
                                                        <tr>
                                                            <th class="text-center" style="width:16%">Total</th>
                                                            <th class="text-center totalVal" style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center" style="width:16%">Descuento</th>
                                                            <th class="text-center descuentoVal" style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center" style="width:16%">Subtotal</th>
                                                            <th class="text-center subtotalVal" style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                            <th style="width:16%"></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!--;-->
                                            </div>
                                            <!--;-->
                                            <div class="row form-group">
                                                <!--;-->
                                                <div class="col-lg-6 text-center">
                                                    <h4><i class="fa fa-bell-o text-primary"></i> Datos de Pago.</h4>
                                                    <div class="row form-group">
                                                        <label class="col-sm-2 col-sm-2 control-label">Tipo de Pago</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="formCoordinador" name="formCoordinador">
                                                                <option value="Contado">Contado</option>
                                                                <option value="Letra de Cambio">Letra de Cambio</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-2 col-sm-2 control-label">Detalle de Matricula</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" rows="5" id="formdesCatedra" style="resize:none" maxlength="100"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--;-->
                                                <div class="col-lg-6 text-center">
                                                    <div class="row form-group">
                                                        <h4><i class="fa fa-paper-plane-o text-primary"></i> Enviar.</h4>
                                                    </div>
                                                    <!--<div class="row form-group">-->
                                                        <button class="btn col-lg-12 btn-primary sendMatricula" type="button"> Enviar Matricula.</button>
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="pager wizard">
                        <li class="previous"><a class="previousbtn" href="#">Anterior</a></li>
                        <li class="next"><a class="nextbtn" href="#">Siguiente</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>

<?php include("footer.php"); ?>

<link href="assets/css/jquery.dataTables.css" rel="stylesheet">
<script type="application/javascript" src="assets/js/jquery.dataTables.js"></script>
<script type="application/javascript" src="assets/js/bootstrap_Wizard/jquery.bootstrap.wizard.js"></script>
<script type="application/javascript" src="assets/js/controllers/crearMatricula_Controller.js"></script>

<script type="application/javascript">
    $( document ).ready(function() {
        initLogic.init();
        initComponents.init();
        initcrearMatricula_Controls.init();
    });
</script>