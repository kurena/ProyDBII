<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllConvBeca":
        fnGetConvBeca();
    break;
    case "agregar":
        fnAddConvBeca($_POST['nomConvBeca'],$_POST['tipo'],$_POST['porcentaje']);
    break;
    case "remover":
        fnRmConvBeca($_POST['numConvBeca']);
        break;
    case "actualizar":
        fnUpdConvBeca($_POST['numConvBeca'],$_POST['nomConvBeca'],$_POST['tipo'],$_POST['porcentaje']);
        break;
    case "selConvBecaById":
        fnGetConvBecaById($_POST['nomConvBeca']);
    break;
}

function fnGetConvBeca(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_CONVBECA.matSelectConvbeca(:c_convbeca_cursor);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,":c_convbeca_cursor",$registros,-1,OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($registros);
    $convBecaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        if ($entry != false) {
            array_push($convBecaArray, json_encode($entry));
        }

    }

    echo json_encode($convBecaArray);

    Conexion::desconectar();
}
function fnAddConvBeca($nom,$tipo,$porc) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_CONVBECA.matMakeConvbeca(  :v_nomConvbeca,
                                                :v_tipConvbeca,
                                                :v_porcConvbeca,
                                                :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_nomConvbeca',$nom,32);
    oci_bind_by_name($stmt,':v_tipConvbeca',$tipo,32);
    oci_bind_by_name($stmt,':v_porcConvbeca',$porc,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

function fnGetConvBecaById($num){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_CONVBECA.matSelectConvBecaById(:numConveBecaIn, :c_convbeca_cursor);
            END;';

    $stmt = oci_parse($linkConnection, $sql);
    oci_bind_by_name($stmt,":numConveBecaIn",$num,32);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,":c_convbeca_cursor",$registros,-1,SQLT_RSET);
    oci_execute($stmt);
    oci_execute($registros);
    $convBecaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($convBecaArray, $entry);
    }

    echo json_encode($convBecaArray);

    Conexion::desconectar();
}

function fnUpdConvBeca($num,$nom,$tipo,$porc) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_CONVBECA.matUpdateConvBeca(:v_numConvbeca,
                                                :v_nomConvbeca,
                                                :v_tipConvbeca,
                                                :v_porcConvbeca,
                                                :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_numConvbeca',$num,32);
    oci_bind_by_name($stmt,':v_nomConvbeca',$nom,32);
    oci_bind_by_name($stmt,':v_tipConvbeca',$tipo,32);
    oci_bind_by_name($stmt,':v_porcConvbeca',$porc,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};
function fnRmConvBeca($num) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_CONVBECA.matDeleteCONVBECA(:v_numConvbeca,
                                                :v_resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_numConvbeca',$num,32);
    oci_bind_by_name($stmt,':v_resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};