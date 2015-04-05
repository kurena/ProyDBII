<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllTurnos":
        fnGetTurnos();
        break;
    case "agregar":
        fnAddTurno($_POST['horEntrada'],$_POST['horSalida']);
        break;
    case "remover":
        fnRmTurno($_POST['numTurno']);
        break;
    case "actualizar":
        fnUpdTurno($_POST['numTurno'],$_POST['horEntrada'],$_POST['horSalida']);
        break;
    case "selTurnoById":
        fnGetTurnoById($_POST['numTurno']);
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

    while ($entry = oci_fetch_assoc($registros)) {
        if ($entry != false) {
            array_push($turnosArray, json_encode($entry));
        }

    }

    echo json_encode($turnosArray);

    Conexion::desconectar();
}
function fnAddTurno($horEntrada,$horSalida) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_TURNO.matMakeTurno(:v_horaEntrada,
                                      :v_horaSalida,
                                      :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_horaEntrada',$horEntrada,32);
    oci_bind_by_name($stmt,':v_horaSalida',$horSalida,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

function fnGetTurnoById($numTurno){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_TURNO.matSelectTurnoById(:numTurnoIn, :c_turnos_cursor);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    oci_bind_by_name($stmt,":numTurnoIn",$numTurno,32);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_turnos_cursor",$registros,-1,SQLT_RSET);

    oci_execute($stmt);

    oci_execute($registros);

    $turnoArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($turnoArray, $entry);
    }

    echo json_encode($turnoArray);

    Conexion::desconectar();
}

function fnUpdTurno($numTurno,$horEntrada,$horSalida) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_TURNO.matUpdateTurno(:v_numTurno,
                                        :v_horaEntrada,
                                        :v_horaSalida,
                                        :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_numTurno',$numTurno,32);
    oci_bind_by_name($stmt,':v_horaEntrada',$horEntrada,32);
    oci_bind_by_name($stmt,':v_horaSalida',$horSalida,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};
function fnRmTurno($numTurno) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_TURNO.matDeleteTurno(:v_numTurno,
                                        :v_resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_numTurno',$numTurno,32);
    oci_bind_by_name($stmt,':v_resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};