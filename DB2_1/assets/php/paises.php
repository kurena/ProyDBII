<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllPaises":
        fnGetPaises();
    break;
    case "agregar":
        fnAddPais($_POST['nomPais'],$_POST['codPais']);
    break;
    case "remover":
        fnRmPais($_POST['numPais']);
        break;
    case "actualizar":
        fnUpdPais($_POST['numPais'],$_POST['nomPais'],$_POST['codPais']);
        break;
    case "selPaisById":
        fnGetPaisById($_POST['nomPais']);
    break;
}

function fnGetPaises(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_PAIS.matSelectPaises(:c_paises_cursor);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,":c_paises_cursor",$registros,-1,OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($registros);
    $paisesArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        if ($entry != false) {
            array_push($paisesArray, json_encode($entry));
        }

    }

    echo json_encode($paisesArray);

    Conexion::desconectar();
}
function fnAddPais($nomPais,$codTelefonico) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_PAIS.matMakePais(:v_nomPais,
                                      :v_codTelefonico,
                                      :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_nomPais',$nomPais,32);
    oci_bind_by_name($stmt,':v_codTelefonico',$codTelefonico,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

function fnGetPaisById($numPais){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_PAIS.matSelectPaisById(:numPaisIn, :c_paises_cursor);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    oci_bind_by_name($stmt,":numPaisIn",$numPais,32);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_paises_cursor",$registros,-1,SQLT_RSET);

    oci_execute($stmt);

    oci_execute($registros);

    $paisArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($paisArray, $entry);
    }

    echo json_encode($paisArray);

    Conexion::desconectar();
}

function fnUpdPais($numPais,$nomPais,$codTelefonico) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_PAIS.matUpdatePais(:v_numPais,
                                        :v_nomPais,
                                        :v_codTelefonico,
                                        :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_numPais',$numPais,32);
    oci_bind_by_name($stmt,':v_nomPais',$nomPais,32);
    oci_bind_by_name($stmt,':v_codTelefonico',$codTelefonico,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};
function fnRmPais($numPais) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_PAIS.matDeletePais(:v_numPais,
                                        :v_resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_numPais',$numPais,32);
    oci_bind_by_name($stmt,':v_resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};