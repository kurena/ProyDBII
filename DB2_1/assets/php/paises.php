<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllPaises":
        fnGetPaises();
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