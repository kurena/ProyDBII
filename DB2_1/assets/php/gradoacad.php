<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllGradAcad":
        fnGetGradoAcad();
        break;
    case "agregar":
        fnAddGradoAcad($_POST['nomGrado'],$_POST['institucion'],$_POST['profesor']);
        break;
    case "remover":
        fnRmGradoAcad($_POST['numGrado']);
        break;
    case "actualizar":
        fnUpdGradoAcad($_POST['numGrado'],$_POST['nomGrado'],$_POST['institucion'],$_POST['profesor']);
        break;
    case "selGradoAcadById":
        fnGetGradoAcadById($_POST['numGrado']);
        break;
}

function fnGetGradoAcad(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_GRADOACADEPROFESOR.matSelectGradoacadeProfesor(:c_gradoAcade_cursor);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,":c_gradoAcade_cursor",$registros,-1,OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($registros);
    $gradoAcadArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        if ($entry != false) {
            array_push($gradoAcadArray, json_encode($entry));
        }

    }

    echo json_encode($gradoAcadArray);

    Conexion::desconectar();
}
function fnAddGradoAcad($nom,$inst,$prof) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_GRADOACADEPROFESOR.matMakeGradoacadeProfesor(  :v_gradacaprofesor,
                                                                    :v_instGradoAcademico,
                                                                    :v_cedProfesor,
                                                                    :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_gradacaprofesor',$nom,32);
    oci_bind_by_name($stmt,':v_instGradoAcademico',$inst,32);
    oci_bind_by_name($stmt,':v_cedProfesor',$prof,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

function fnGetGradoAcadById($num){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_GRADOACADEPROFESOR.matSelectGradosById(:numGradoIN, :c_gradoAcade_cursor);
            END;';

    $stmt = oci_parse($linkConnection, $sql);
    oci_bind_by_name($stmt,":numGradoIN",$num,32);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,":c_gradoAcade_cursor",$registros,-1,SQLT_RSET);
    oci_execute($stmt);
    oci_execute($registros);
    $gradosArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($gradosArray, $entry);
    }

    echo json_encode($gradosArray);

    Conexion::desconectar();
}

function fnUpdGradoAcad($num,$nom,$inst,$prof) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_GRADOACADEPROFESOR.matUpdateGradoacadeProfesor(:v_NumGradoAcade,
                                                                    :v_gradacaprofesor,
                                                                    :v_instGradoAcademico,
                                                                    :v_cedProfesor,
                                                                    :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_NumGradoAcade',$num,32);
    oci_bind_by_name($stmt,':v_gradacaprofesor',$nom,32);
    oci_bind_by_name($stmt,':v_instGradoAcademico',$inst,32);
    oci_bind_by_name($stmt,':v_cedProfesor',$prof,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};
function fnRmGradoAcad($num) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_GRADOACADEPROFESOR.matDeleteGradoacadeProfesor(:v_NumGradoAcade,
                                                                    :v_resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_NumGradoAcade',$num,32);
    oci_bind_by_name($stmt,':v_resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};