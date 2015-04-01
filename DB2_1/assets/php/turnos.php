<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllTurnos":
        fnGetTurnos();
        break;
}

function fnGetTurnos(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_TURNO.matSelectTurnos(:c_turnos_cursor);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,":c_turnos_cursor",$registros,-1,OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($registros);
    $turnosArray = array();

    while (($entry = oci_fetch_array($registros, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        array_push($turnosArray, json_encode($entry));
    }

    echo json_encode($turnosArray);

    Conexion::desconectar();
}