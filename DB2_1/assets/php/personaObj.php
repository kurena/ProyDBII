<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 21/03/2015
 * Time: 09:15 PM
 */

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selPersonaByID":
        fnGetPersonByID($_POST['numPersona']);
        break;
}

function fnGetPersonByID($numPersona){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_PERSONA.matSelectById(:numPersona, :c_persona_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    oci_bind_by_name($stmt,":numPersona",$numPersona,32);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_persona_cursos",$registros,-1,SQLT_RSET);

    oci_execute($stmt);

    oci_execute($registros);

    $personaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($personaArray, json_encode($entry));
    }

    echo json_encode($personaArray);

    Conexion::desconectar();
}