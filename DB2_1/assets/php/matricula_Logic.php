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