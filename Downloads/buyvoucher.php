<?php
    require_once "../Controller/VoucherController.php";
    $code="";
    if(isset($_POST['day']))
    {
        $day = $_POST['day'];
        $vouchercontroller = new VoucherController();
        $voucherid = $vouchercontroller->postVoucher($day);
        if($voucherid!= 0)
        {
            $vouchercode = md5($voucherid);
            if($vouchercontroller->putVoucherCode($voucherid, $vouchercode))
            {
                $voucher = $vouchercontroller->getVoucherByCode($vouchercode);
                $code = $voucher->getVouchercode();
            }
        }
        
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Buy Voucher</title>
    </head>
    <body>
        <form action="buyvoucher.php" method="post">
            <table align="center">
                <caption>Buy Voucher</caption>
                <tr>
                    <td>
                        Day
                    </td>
                    <td>
                        <input type="radio" name="day" value="1" checked/> 1 day
                        <input type="radio" name="day" value="7"/> 7 day
                        <input type="radio" name="day" value="30"/> 30 day
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"> 
                    <input type="submit" name="submit" value="Buy"/>
                    </td>
                </tr>
            </table>
        </form>
        
        <br>
        <br>
        <br>
        <h2 align="center">Voucher Code</h2>
    <center><input type="text" size="50" value="<?php echo $code;?>" readonly style="text-align:center"/></center>
    </body>
</html>
