<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "getCursosPorCatedra":
        fnCursosPorCatedra($_POST['codCatedra']);
    break;
    case "getMaxAulas":
        fnMaxAulas();
    break;
}

function fnCursosPorCatedra($num)
{
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_REPORTES.CATSELMAXCURSOS(  :v_codCatedra,
                                                :c_cursos);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt, ":v_codCatedra", $num, 32);
    oci_bind_by_name($stmt, ":c_cursos", $registros, -1, SQLT_RSET);
    oci_execute($stmt);
    oci_execute($registros);
    $cursosArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        if ($entry != false) {
            array_push($cursosArray, json_encode($entry));
        }

    }

    echo json_encode($cursosArray);

    Conexion::desconectar();
}

function fnMaxAulas()
{
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_REPORTES.GRUPSELMAXAULAS(  :c_aulas);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt, ":c_aulas", $registros, -1, SQLT_RSET);
    oci_execute($stmt);
    oci_execute($registros);
    $aulasArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        if ($entry != false) {
            array_push($aulasArray, json_encode($entry));
        }

    }

    echo json_encode($aulasArray);

    Conexion::desconectar();
}

