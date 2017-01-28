<?php
    header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
    $tokocontroller = new TokoController();
    $response = $tokocontroller->getTokos()->getArrayCopy();
    //print_r($response);
    echo convertArrayToJSON($response);
    //print_r($response);
    //print_r(convertArrayToJSON($response));
?>