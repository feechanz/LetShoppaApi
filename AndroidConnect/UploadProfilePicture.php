<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    if (is_uploaded_file($_FILES['profilepicture']['tmp_name']))
    {
        if(isset($_POST['accountid']))
        {
            
            $accountid = $_POST['accountid'];
            $profilepicture = $_FILES['profilepicture']['tmp_name'];

            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($accountid);

            if($account != null)
            {
                $name = $_FILES["profilepicture"]["name"];
                $ext = end((explode(".", $name))); 

                $path = "../Images/Profiles/".$accountid.".".$ext;
                $newpath = "http://letshoppa.itmaranatha.org/Images/Profiles/".$accountid.".".$ext;
                if($accountcontroller->putAccountLinkgambaraccount($accountid, $newpath))                  
                {
                    move_uploaded_file ($_FILES['profilepicture'] ['tmp_name'], $path);

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