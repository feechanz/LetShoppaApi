<?php
    header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
    //$_POST['jenistokoid']=1;
	//$_POST['keyword']="aaz";
    if(isset($_POST['jenistokoid']) && isset($_POST['keyword']))
    {
        $jenistokoid = $_POST['jenistokoid'];
        $keyword = $_POST['keyword'];
        $tokocontroller = new TokoController();
        $response = $tokocontroller->getTokosByJenistokoid($jenistokoid,$keyword)->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>