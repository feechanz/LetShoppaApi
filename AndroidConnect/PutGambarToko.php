<?php
    header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
    if (is_uploaded_file($_FILES['gambartoko']['tmp_name']))
    {
        if(isset($_POST['tokoid']))
        {
            
            $tokoid = $_POST['tokoid'];
            $gambartoko = $_FILES['gambartoko']['tmp_name'];

            $tokocontroller = new TokoController();
            $toko = $tokocontroller->getTokoByTokoId($tokoid);

            if($toko != null)
            {
                $name = $_FILES["gambartoko"]["name"];
                $ext = end((explode(".", $name))); 

                $path = "../Images/Shops/".$tokoid.".".$ext;
                $newpath = "http://letshoppa.itmaranatha.org/Images/Shops/".$tokoid.".".$ext;
                if($tokocontroller->putTokoGambartoko($tokoid, $newpath))                  
                {
                    move_uploaded_file ($_FILES['gambartoko'] ['tmp_name'], $path);

                    $result["success"]=1;
                    $result["message"]="Success";
                }
                else
                {
                    $result["success"]=5;
                    $result["message"]="Bad Request or Internal Error";
                }
            }
            else
            {
                $result["success"]=4;
                $result["message"]="Bad Request";
            }
        }
        else
        {
            $result["success"]=4;
            $result["message"]="Bad Request";
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>