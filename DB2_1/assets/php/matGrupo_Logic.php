<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 12/04/2015
 * Time: 05:02 PM
 */

include("Database.php");

switch ($_POST['genericMethod']) {
    case "listar":
        fnListaGrupos();
        break;
    case "insGrupo":
        fnInsGrupo();
        break;
    case "uptGrupo":
        fnUptGrupo();
        break;
    case "eraseGrupo":
        fnEraGrupo();
        break;
}

function fnListaGrupos(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_GRUPO.matSelectGrupos(:c_grupos_cursor);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_grupos_cursor",$registros,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($registros);

    $grupoArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($grupoArray, json_encode($entry));
    }

    Conexion::desconectar();

    echo json_encode($grupoArray);

}

function fnInsGrupo(){

}

function fnUptGrupo(){

}

function fnEraGrupo(){

}