<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 13/04/2015
 * Time: 09:33 PM
 */

include("Database.php");

switch ($_POST['genericMethod']) {
    case "listarPersonas":
        fnListPersonas();
        break;
    case "crearMatricula":
        fnCrearMatrcula($_POST['tipoPago'],
                        $_POST['total'],
                        $_POST['subtotal'],
                        $_POST['desmatri'],
                        $_POST['cedPersona']);
        break;
    case "crearDetalleMatricula":
        fnCrearDetalleMatricula($_POST['numMatricula'],
                                $_POST['numGrupo'],
                                $_POST['costoGrupo']);
        break;
}

function fnListPersonas(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_PERSONA.matSelectByRol(:rolPersonaIN, :c_persona_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    $tipPersona = 'estu';

    oci_bind_by_name($stmt,":rolPersonaIN",$tipPersona,32);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_persona_cursos",$registros,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($registros);

    $personaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($personaArray, json_encode($entry));
    }

    Conexion::desconectar();

    echo json_encode($personaArray);

}

function fnCrearMatrcula($tipoPago,
                          $total,
                          $subtotal,
                          $desmatri,
                          $cedPersona){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                packMatricula_MatriculaDetalle.matGestionarMatricula(:v_tipoPago,
                                                                     :v_total,
                                                                     :v_subtotal,
                                                                     :v_desmatri,
                                                                     :v_cedPersona,
                                                                     :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':v_tipoPago',$tipoPago,32);
    oci_bind_by_name($stmt,':v_total',$total,32);
    oci_bind_by_name($stmt,':v_subtotal',$subtotal,32);
    oci_bind_by_name($stmt,':v_desmatri',$desmatri,32);
    oci_bind_by_name($stmt,':v_cedPersona',$cedPersona,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}

function fnCrearDetalleMatricula($numMatricula,
                                 $numGrupo,
                                 $costoGrupo){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                packMatricula_MatriculaDetalle.matGestionDetalleMatricula(:v_numMatricula,
                                                                          :v_numgrupo,
                                                                          :v_costo,
                                                                          :v_resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':v_numMatricula',$numMatricula,32);
    oci_bind_by_name($stmt,':v_numgrupo',$numGrupo,32);
    oci_bind_by_name($stmt,':v_costo',$costoGrupo,32);
    oci_bind_by_name($stmt,':v_resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}
