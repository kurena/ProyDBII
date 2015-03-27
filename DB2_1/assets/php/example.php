<?php

if ($_POST['valorCaja1'] == "insert"){
    echo "Daniel";
}else{
    $conn = oci_connect('hr', 'hr', 'localhost/XE');
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }else{
        $stid = oci_parse($conn, 'SELECT * FROM JOBS');
        oci_execute($stid);

        $cart = array();

        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            array_push($cart, json_encode($row));
        }

        echo json_encode($cart);
    }
}


