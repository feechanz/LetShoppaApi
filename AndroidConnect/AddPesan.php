<?php
    header('Content-type:application/json');
    require_once "../Controller/PesanController.php";
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    
    $pengirimaccountid="";
    $penerimaaccountid="";
    $isipesan="";
    if(isset($_POST['pengirimaccountid']) && isset($_POST['penerimaaccountid']) && isset($_POST['isipesan']))
    {
        $pengirimaccountid = $_POST['pengirimaccountid'];
        $penerimaaccountid = $_POST['penerimaaccountid'];
        $isipesan = $_POST['isipesan'];
        $pesancontroller = new PesanController();
        if($pesancontroller->postPesan($pengirimaccountid, $penerimaaccountid, $isipesan))
        {
            $result["success"]=1;
            $result["message"]="Success";
            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($penerimaaccountid);
            $pengirim = $accountcontroller->getAccountByAccountId($pengirimaccountid);
            if(isset($account) && $account != null)
            {
                $nama = "Let Shoppa";
                $to = $account->getEmail();
                $subject = "Message";
                $messages = "Message From : ".$pengirim->getNama()."\n\n".$isipesan;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
                $headers .= 'From: <letshoppa@lecturer.itmaranatha.org>' . "\r\n"; //bagian ini diganti sesuai dengan email dari pengirim
                @mail($to, $subject, $messages, $headers);
                
            }
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