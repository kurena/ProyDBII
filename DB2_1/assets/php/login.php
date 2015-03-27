<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 14/03/2015
 * Time: 10:42 PM
 */
include("Database.php");

switch ($_POST['genericMethod']) {
    case "acceder":
        fnLoginFunction($_POST['codUsuario'],$_POST['passUsuario']);
        break;
    case "buscarCedula":
        fnbuscarCedulaTSE($_POST['cedulaFind']);
        break;
    case "createPersonUser":
        fnCretaePersonUser($_POST['cedPersonaIn'],
                           $_POST['nomPersonaIn'],
                           $_POST['ape1PersonaIn'],
                           $_POST['ape2PersonaIn'],
                           $_POST['fecNaciPersonaIn'],
                           $_POST['telPersonaIn'],
                           $_POST['domiPersonaIn'],
                           $_POST['correoPersonaIn'],
                           $_POST['numBecaPersonaIn'],
                           $_POST['paisPersonaIn'],
                           $_POST['tipPersonaIn'],
                           $_POST['numCatPersonaIn'],
                           $_POST['numGraAcaPersonaIn'],
                           $_POST['numNotaPersonaIn']);
        break;
}

function fnLoginFunction($codUsu, $passUsu){
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PROC_LOGIN(:CODUSU,
                           :PASSUSU,
                           :USERROL,
                           :usernumPersona,
                           :RESULT);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':CODUSU',$codUsu,32);
    oci_bind_by_name($stmt,':PASSUSU',$passUsu,32);
    oci_bind_by_name($stmt,':USERROL',$tipUser,32);
    oci_bind_by_name($stmt,':usernumPersona',$usernumPersona,32);
    oci_bind_by_name($stmt,':RESULT',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery, 'tipUser' => $tipUser, 'usernmPersona' => $usernumPersona);

    Conexion::desconectar();

    echo json_encode($arr);
}

function fnbuscarCedulaTSE($cedulaPadron){
    $arrayResult = array();
    $arrayResult["result"] = "notfound";

    $flagFile = true;
    $handle = fopen("../TSE/PADRON_COMPLETO.txt", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false && $flagFile == true) {
            $porciones = explode(",", $line);
            if ($porciones[0] == $cedulaPadron){
                unset($arrayResult["result"]);
                $arrayResult["result"] = "succes";
                $arrayResult["nombre"] = $porciones[5];
                $arrayResult["ape1"] = str_replace(' ', '', $porciones[6]);
                $arrayResult["ape2"] = preg_replace('/^\s+|\n|\r|\s+$/m', '', str_replace(' ', '', $porciones[7]));
                $handleDis = fopen("../TSE/Distelec.txt", "r");
                if($handleDis){
                    while (($line2 = fgets($handleDis)) !== false) {
                        $porciones2 = explode(",", $line2);
                        if ($porciones2[0] == $porciones[1]){
                            $residensia = $porciones2[1] . '-' . $porciones2[2] . '-' . $porciones2[3];
                            $arrayResult["residencia"] = preg_replace('/^\s+|\n|\r|\s+$/m', '', str_replace(' ', '', $residensia));
                        }
                    }
                }
                $flagFile = false;
            }
        }
        fclose($handle);
    } else {
        unset($arrayResult["result"]);
        $arrayResult["result"] = "errorFile";
    }

    echo json_encode($arrayResult);
}

function fnCretaePersonUser($cedPersonaIn,
                            $nomPersonaIn,
                            $ape1PersonaIn,
                            $ape2PersonaIn,
                            $fecNaciPersonaIn,
                            $telPersonaIn,
                            $domiPersonaIn,
                            $correoPersonaIn,
                            $numBecaPersonaIn,
                            $numPaisPersonaIn,
                            $tipPersonaIn,
                            $numCatPersonaIn,
                            $numGraAcaPersonaIn,
                            $numNotaPersonaIn){

    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_PERSONA.matMakePersonaUser(TO_NUMBER(:cedPersonaIn),
                                                :nomPersonaIn,
                                                :ape1PersonaIn,
                                                :ape2PersonaIn,
                                                to_date(:fecNaciPersonaIn),
                                                :telPersonaIn,
                                                :domiPersonaIn,
                                                :correoPersonaIn,
                                                :numBecaPersonaIn,
                                                :numPaisPersonaIn,
                                                :tipPersonaIn,
                                                null,
                                                null,
                                                null,
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
    oci_bind_by_name($stmt,':numBecaPersonaIn',$numBecaPersonaIn,32);
    oci_bind_by_name($stmt,':numPaisPersonaIn',$numPaisPersonaIn,32);
    oci_bind_by_name($stmt,':tipPersonaIn',$tipPersonaIn,32);
    //oci_bind_by_name($stmt,':numCatPersonaIn',$numCatPersonaIn,32);
    //oci_bind_by_name($stmt,':numGraAcaPersonaIn',$numGraAcaPersonaIn,32);
    //oci_bind_by_name($stmt,':numNotaPersonaIn',$numNotaPersonaIn,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);

    oci_execute($stmt);

    Conexion::desconectar();

    echo $resultOut;
}

