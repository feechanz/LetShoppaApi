<?php
    header('Content-type:application/json');
    require_once "../Controller/InvoiceController.php";
    require_once "../Function/function.php";
    
    $tanggalinvoice = "";
    $totalinvoice = "";
    $orderid = "";
    
    if(isset($_POST['tanggalinvoice']) && isset($_POST['totalinvoice']) && isset($_POST['orderid']))
    {
        $tanggalinvoice = "tanggalinvoice";
        $totalinvoice = "totalinvoice";
        $orderid = $_POST['orderid'];
        $invoicecontroller = new InvoiceController();
        $invoice = $invoicecontroller->getInvoiceByOrderid($orderid);
        if(!isset($invoice) || $invoice == null)
        {
            if($invoicecontroller->postInvoice($orderid, $tanggalinvoice, $totalinvoice))
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
            if($invoicecontroller->putInvoice($orderid, $tanggalinvoice, $totalinvoice))
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
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";  
    }
    echo json_encode($result,JSON_PRETTY_PRINT);
?>