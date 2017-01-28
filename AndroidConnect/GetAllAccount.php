<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    $accountcontroller = new AccountController();
    $response = $accountcontroller->getAccounts()->getArrayCopy();
    echo convertArrayToJSON($response);
?>

