<?php
    header('Content-type:application/json');
    require_once "../Controller/KontaktokoController.php";
    require_once "../Function/function.php";
    
    $tokoid="";
    $jeniskontak="";
    $isikontak="";
    if(isset($_POST['tokoid']) && isset($_POST['jeniskontak']) && isset($_POST['isikontak']))
    {
        $tokoid = $_POST['tokoid'];
        $jeniskontak = $_POST['jeniskontak'];
        $isikontak = $_POST['isikontak'];
        $kontaktokocontroller = new KontaktokoController();
        if($kontaktokocontroller->postKontaktoko($tokoid, $jeniskontak, $isikontak))
        {
            $result["success"]=1;
            $result["message"]="Success";
        }
        else
        {
            $result["success"]=3;
            $result["message"]="Server Error";   
        }
    }
    else 
    {
        $result["success"]=4;
        $result["message"]="Bad Request";  
    }
    echo json_encode($result,JSON_PRETTY_PRINT);
?>