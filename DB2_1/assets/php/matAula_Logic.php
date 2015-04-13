<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 12/04/2015
 * Time: 11:16 AM
 */

include("Database.php");

switch ($_POST['genericMethod']) {
    case "listar":
        fnListaAulas();
        break;
    case "insAula":
        fnInsAula($_POST["detAulaIN"],
                  $_POST["tipAulaIN"]);
        break;
    case "uptCurgrad":
        fnUptAula($_POST["numAulaIN"],
                  $_POST["detAulaIN"],
                  $_POST["tipAulaIN"]);
        break;
    case "eraseAula":
        fnEraAula($_POST["numAulaIN"]);
        break;
}

function fnListaAulas(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_AULA.matSelectAulas(:c_aulas_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_aulas_cursos",$registros,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($registros);

    $aulaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($aulaArray, json_encode($entry));
    }

    Conexion::desconectar();

    echo json_encode($aulaArray);
}

function fnInsAula($detAulaIN,
                   $tipAulaIN){

    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_AULA.matMakeAula(:v_detAula,
                                      :v_tipoAula,
                                      :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':v_detAula',$detAulaIN,32);
    oci_bind_by_name($stmt,':v_tipoAula',$tipAulaIN,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}

function fnUptAula($numAulaIN,
                   $detAulaIN,
                   $tipAulaIN){

    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_AULA.matUpdateAula(:v_numAula,
                                        :v_detAula,
                                        :v_tipoAula,
                                        :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':v_numAula',$numAulaIN,32);
    oci_bind_by_name($stmt,':v_detAula',$detAulaIN,32);
    oci_bind_by_name($stmt,':v_tipoAula',$tipAulaIN,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}

function fnEraAula($numAulaIN){
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_AULA.matDeleteAula(:v_numAula,
                                        :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':v_numAula',$numAulaIN,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}