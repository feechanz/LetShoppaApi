<?php
    header('Content-type:application/json');
    require_once "../Controller/KontaktokoController.php";
    require_once "../Function/function.php";
    
    if(isset($_POST['tokoid']))
    {
        $tokoid = $_POST['tokoid'];
        $kontaktokocontroller = new KontaktokoController();
        $response =  $kontaktokocontroller->getKontaktokosByTokoid($tokoid)->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>