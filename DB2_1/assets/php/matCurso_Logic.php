<?php
/**
 * Created by PhpStorm.
 * User: DB2
 * Date: 12/04/2015
 * Time: 07:31 AM
 */

include("Database.php");

switch ($_POST['genericMethod']) {
    case "listar":
        fnListaCursos();
        break;
    case "insCurso":
        fnInsCurso($_POST["nomCursoIN"],
                   $_POST["desCursoIN"],
                   $_POST["creCursoIN"],
                   $_POST["cosCursoIN"],
                   $_POST["catCursoIN"],
                   $_POST["corCursoIN"]);
        break;
    case "uptCurso":
        fnUptCurso($_POST["numCursoIN"],
                   $_POST["nomCursoIN"],
                   $_POST["desCursoIN"],
                   $_POST["creCursoIN"],
                   $_POST["cosCursoIN"],
                   $_POST["catCursoIN"],
                   $_POST["corCursoIN"]);
        break;
}

function fnLIstaCursos(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_CURSO.matSelectCursos(:c_cursos_cursos);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_cursos_cursos",$registros,-1,OCI_B_CURSOR);

    oci_execute($stmt);

    oci_execute($registros);

    $cursoArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($cursoArray, json_encode($entry));
    }

    Conexion::desconectar();

    echo json_encode($cursoArray);
}

function fnInsCurso($nomCursoIN,
                    $desCursoIN,
                    $creCursoIN,
                    $cosCursoIN,
                    $catCursoIN,
                    $corCursoIN){

    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_CURSO.matMakeCurso(:v_nomCurso,
                                        :v_detCurso,
                                        :v_credCurso,
                                        :v_cosCurso,
                                        :v_numCatedra,
                                        :v_cedpersona,
                                        :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':v_nomCurso',$nomCursoIN,32);
    oci_bind_by_name($stmt,':v_detCurso',$desCursoIN,32);
    oci_bind_by_name($stmt,':v_credCurso',$creCursoIN,32);
    oci_bind_by_name($stmt,':v_cosCurso',$cosCursoIN,32);
    oci_bind_by_name($stmt,':v_numCatedra',$catCursoIN,32);
    oci_bind_by_name($stmt,':v_cedpersona',$corCursoIN,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}

function fnUptCurso($numCursoIN,
                    $nomCursoIN,
                    $desCursoIN,
                    $creCursoIN,
                    $cosCursoIN,
                    $catCursoIN,
                    $corCursoIN){

    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                pack_CURSO.matUpdateCurso(:v_numCurso,
                                          :v_nomCurso,
                                          :v_detCurso,
                                          :v_credCurso,
                                          :v_cosCurso,
                                          :v_numCatedra,
                                          :v_cedpersona,
                                          :resultOut);
            END;';

    $stmt = oci_parse($linkConnection,$sql);

    oci_bind_by_name($stmt,':v_numCurso',$numCursoIN,32);
    oci_bind_by_name($stmt,':v_nomCurso',$nomCursoIN,32);
    oci_bind_by_name($stmt,':v_detCurso',$desCursoIN,32);
    oci_bind_by_name($stmt,':v_credCurso',$creCursoIN,32);
    oci_bind_by_name($stmt,':v_cosCurso',$cosCursoIN,32);
    oci_bind_by_name($stmt,':v_numCatedra',$catCursoIN,32);
    oci_bind_by_name($stmt,':v_cedpersona',$corCursoIN,32);
    oci_bind_by_name($stmt,':resultOut',$resultQuery,32);

    oci_execute($stmt);

    $arr = array('resultQuery' => $resultQuery);

    Conexion::desconectar();

    echo json_encode($arr);

}

