<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllHorarios":
        fnGetHorarios();
        break;
    case "agregar":
        fnAddHorario($_POST['dia'], $_POST['turno']);
        break;
    case "remover":
        fnRmHorario($_POST['numHorario']);
        break;
    case "actualizar":
        fnUpdHorario($_POST['numHorario'], $_POST['dia'], $_POST['turno']);
        break;
    case "selHorarioById":
        fnGetHorarioById($_POST['numHorario']);
        break;
}

function fnGetHorarios()
{
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_HORARIO.matSelectHorarios(:c_horarios_cursor);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt, ":c_horarios_cursor", $registros, -1, OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($registros);
    $horariosArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        if ($entry != false) {
            array_push($horariosArray, json_encode($entry));
        }

    }

    echo json_encode($horariosArray);

    Conexion::desconectar();
}

function fnAddHorario($dia, $turno)
{
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_HORARIO.matMakeHorario(  :v_diaHorario,
                                            :v_numTurno,
                                            :resultOut);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    oci_bind_by_name($stmt, ':v_diaHorario', $dia, 32);
    oci_bind_by_name($stmt, ':v_numTurno', $turno, 32);
    oci_bind_by_name($stmt, ':resultOut', $resultOut, 32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

function fnGetHorarioById($numHorario)
{
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_HORARIO.matSelectHorariosById(:numHorarioIn, :c_horarios_cursor);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    oci_bind_by_name($stmt, ":numHorarioIn", $numHorario, 32);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt, ":c_horarios_cursor", $registros, -1, SQLT_RSET);

    oci_execute($stmt);

    oci_execute($registros);

    $horarioArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($horarioArray, $entry);
    }

    echo json_encode($horarioArray);

    Conexion::desconectar();
}

function fnUpdHorario($numHorario, $dia, $turno)
{
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_HORARIO.matUpdateHorario(  :v_numHorario,
                                                :v_diaHorario,
                                                :v_numTurno,
                                                :resultOut);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    oci_bind_by_name($stmt, ':v_numHorario', $numHorario, 32);
    oci_bind_by_name($stmt, ':v_diaHorario', $dia, 32);
    oci_bind_by_name($stmt, ':v_numTurno', $turno, 32);
    oci_bind_by_name($stmt, ':resultOut', $resultOut, 32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

;
function fnRmHorario($numHorario)
{
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_HORARIO.matDeleteHorario(  :v_numHorario,
                                                :v_resultOut);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    oci_bind_by_name($stmt, ':v_numHorario', $numHorario, 32);
    oci_bind_by_name($stmt, ':v_resultOut', $resultOut, 32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

;