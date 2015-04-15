<?php

include("Database.php");

switch ($_POST['genericMethod']) {
    case "selAllCursos":
        fnGetCursos();
        break;
    case "selAllEstudiantes":
        fnListEstudiantes();
        break;
    case "selAllNotas":
        fnGetNotas($_POST['numCurso']);
        break;
    case "remover":
        fnRmNota($_POST['numNota']);
        break;
    case "actualizar":
        fnUpdNota($_POST['numNota'],$_POST['curso'],$_POST['estudiante']);
        break;
    case "agregar":
        fnAddNota($_POST['curso'],$_POST['estudiante']);
        break;
    case "selNotaById":
        fnGetNotaById($_POST['numNota']);
        break;
}

function fnGetCursos(){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_CURSO.matSelectCursos(:c_cursos_cursor);
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,":c_cursos_cursor",$registros,-1,OCI_B_CURSOR);
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
function fnListEstudiantes(){
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
function fnGetNotas($numCurso){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                PACK_NOTAS.matSelectNotas(:v_codCurso,
                                          :c_cursos_notas  );
            END;';
    $stmt = oci_parse($linkConnection, $sql);
    $registros = oci_new_cursor($linkConnection);
    oci_bind_by_name($stmt,':v_codCurso',$numCurso,32);
    oci_bind_by_name($stmt,":c_cursos_notas",$registros,-1,OCI_B_CURSOR);
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
function fnAddNota($curso,$estudiante) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_NOTAS.matMakeNotas(:v_numCurso,
                                      :v_cedPersona,
                                      :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_numCurso',$curso,32);
    oci_bind_by_name($stmt,':v_cedPersona',$estudiante,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
}

function fnGetNotaById($numNota){
    $linkConnection = Conexion::getInstancia();

    $sql = 'BEGIN
                pack_NOTAS.matSelectNotaById(:v_codNota, :c_cursos_notas);
            END;';

    $stmt = oci_parse($linkConnection, $sql);

    oci_bind_by_name($stmt,":v_codNota",$numNota,32);

    $registros = oci_new_cursor($linkConnection);

    oci_bind_by_name($stmt,":c_cursos_notas",$registros,-1,SQLT_RSET);

    oci_execute($stmt);

    oci_execute($registros);

    $notaArray = array();

    while ($entry = oci_fetch_assoc($registros)) {
        array_push($notaArray, $entry);
    }

    echo json_encode($notaArray);

    Conexion::desconectar();
}

function fnUpdNota($numNota,$curso,$estudiante) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_NOTAS.matUpdateNota(:v_NumNota,
                                        :v_numCurso,
                                        :v_cedPersona,
                                        :resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_NumNota',$numNota,32);
    oci_bind_by_name($stmt,':v_numCurso',$curso,32);
    oci_bind_by_name($stmt,':v_cedPersona',$estudiante,32);
    oci_bind_by_name($stmt,':resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};
function fnRmNota($numNota) {
    $linkConnection = Conexion::getInstancia();
    $sql = 'BEGIN
                PACK_NOTAS.matDeleteNota(:v_NumNota,
                                        :v_resultOut);
            END;';
    $stmt = oci_parse($linkConnection,$sql);
    oci_bind_by_name($stmt,':v_NumNota',$numNota,32);
    oci_bind_by_name($stmt,':v_resultOut',$resultOut,32);
    oci_execute($stmt);
    echo $resultOut;
    Conexion::desconectar();
};