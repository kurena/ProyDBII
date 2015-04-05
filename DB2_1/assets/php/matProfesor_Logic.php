<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 03/04/2015
 * Time: 08:46 PM
 */

include("Database.php");

switch ($_POST['genericMethod']) {
    case "listar":
        fnListProfesores();
        break;
    case "selPersonaByID":
        fnGetProfByID($_POST['cedProfesorIN']);
        break;
    case "uptPerson":
        fnUptPerson($_POST['cedPersonaIn'],
                    $_POST['nomPersonaIn'],
                    $_POST['ape1PersonaIn'],
                    $_POST['ape2PersonaIn'],
                    $_POST['fecNaciPersonaIn'],
                    $_POST['telPersonaIn'],
                    $_POST['domiPersonaIn'],
                    $_POST['correoPersonaIn']);
        break;
}

function fnListProfesores(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_PERSONA.matSelectByRol(:rolPersonaIN, :c_persona_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    $tipPersona = 'prof';

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

function fnGetProfByID($cedProfesor){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_PERSONA.matSelectByCed(:cedPersonaIN, :c_persona_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    oci_bind_by_name($stmt,":cedPersonaIN",$cedProfesor,32);

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

function fnUptPerson($cedPersonaIn,
                     $nomPersonaIn,
                     $ape1PersonaIn,
                     $ape2PersonaIn,
                     $fecNaciPersonaIn,
                     $telPersonaIn,
                     $domiPersonaIn,
                     $correoPersonaIn){

    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_PERSONA.matUpdatePersona(:cedPersonaIn,
                                               :nomPersonaIn,
                                               :ape1PersonaIn,
                                               :ape2PersonaIn,
                                               to_date(:fecNaciPersonaIn),
                                               :telPersonaIn,
                                               :domiPersonaIn,
                                               :correoPersonaIn,
                                               :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':cedPersonaIn',$cedPersonaIn,32);
    oci_bind_by_name($stmt,':nomPersonaIn',$nomPersonaIn,32);
    oci_bind_by_name($stmt,':ape1PersonaIn',$ape1PersonaIn,32);
    oci_bind_by_name($stmt,':ape2PersonaIn',$ape2PersonaIn,32);
    oci_bind_by_name($stmt,':fecNaciPersonaIn',$fecNaciPersonaIn,32);
    oci_bind_by_name($stmt,':telPersonaIn',$telPersonaIn,32);
    oci_bind_by_name($stmt,':domiPersonaIn',$domiPersonaIn,32);
    oci_bind_by_name($stmt,':correoPersonaIn',$correoPersonaIn,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}