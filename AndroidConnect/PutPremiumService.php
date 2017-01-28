<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Controller/VoucherController.php";
    require_once "../Function/function.php";
    
    
    //$_POST['accountid']="1";
    //$_POST['vouchercode']="c4ca4238a0b923820dcc509a6f75849b";
    if(isset($_POST['accountid']) && isset($_POST['vouchercode']))
    {
        $accountid = $_POST['accountid'];
        $vouchercode = $_POST['vouchercode'];
        $accountcontroller = new AccountController();
        $vouchercontroller = new VoucherController();
        $voucher = $vouchercontroller->getVoucherByCode($vouchercode);
        if($voucher == null || !isset($voucher))
        {
            $result["success"]=7;
            $result["message"]="Invalid Voucher";
        }
        else
        {
            $day = $voucher->getDay();
            
            if($accountcontroller->putAccountPremiumService($accountid, $day))
            {
                $vouchercontroller->putVoucherUsed($vouchercode);
                $result["success"]=1;
                $result["message"]="Success";
            }
            else
            {
                $result["success"]=5;
                $result["message"]="Internal Error";
            }
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>

