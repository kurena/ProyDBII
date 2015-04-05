<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 04/04/2015
 * Time: 04:54 PM
 */

include("Database.php");

switch ($_POST['genericMethod']) {
    case "listar":
        fnListCatedras();
        break;
    case "getProfs":
        fnGetProfs();
        break;
    case "createCatedra":
        fnCreateCatedra($_POST['nomCatedra'],
                        $_POST['desCatedra'],
                        $_POST['corCatedra']);
        break;
    case "uptCatedra":
        fnUptCatedra($_POST['numCatedra'],
                     $_POST['nomCatedra'],
                     $_POST['desCatedra'],
                     $_POST['corCatedra']);
        break;
}

function fnListCatedras(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_CATEDRA.matSelectCatedras(:c_catedras_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_catedras_cursos",$registros,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($registros);

    $personaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($personaArray, json_encode($entry));
    }

    echo json_encode($personaArray);

    Conexion::desconectar();
}

function fnGetProfs(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_PERSONA.matProfs(:c_profs_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_profs_cursos",$registros,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($registros);

    $personaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($personaArray, json_encode($entry));
    }

    echo json_encode($personaArray);

    Conexion::desconectar();
}

function fnCreateCatedra($nomCatedra,
                         $detCatedra,
                         $corCatedra){

    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_CATEDRA.matMakeCatedra(:nomCatedraIn,
                                            :detCatedraIn,
                                            :corCatedraIn,
                                            :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':nomCatedraIn',$nomCatedra,32);
    oci_bind_by_name($stmt,':detCatedraIn',$detCatedra,32);
    oci_bind_by_name($stmt,':corCatedraIn',$corCatedra,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

};

function fnUptCatedra($numCatedra,
                      $nomCatedra,
                      $detCatedra,
                      $corCatedra){

    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_CATEDRA.matUpdateCatedra(:numCatedraIn,
                                              :nomCatedraIn,
                                              :detCatedraIn,
                                              :corCatedraIn,
                                              :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':numCatedraIn',$numCatedra,32);
    oci_bind_by_name($stmt,':nomCatedraIn',$nomCatedra,32);
    oci_bind_by_name($stmt,':detCatedraIn',$detCatedra,32);
    oci_bind_by_name($stmt,':corCatedraIn',$corCatedra,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}