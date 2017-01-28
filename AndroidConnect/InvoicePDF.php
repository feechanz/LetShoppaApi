<?php
    if(isset($_GET['orderid']))
    {
        $orderid = $_GET['orderid'];
        require_once "../Controller/OrderController.php";
        $ordercontroller = new OrderController();

        
        $order = $ordercontroller->getOrderByOrderid($orderid);  
    }
?>

<head>
</head>
<body>
    <h1> <img src="../Images/letshoppa.png" width="25px" height="25px"/>Let Shoppa Invoice </h1>   
    <table align="center" >
        <caption><b>Invoice</b></caption>
        <tr>
            <td>Shop's Name</td>
            <td>:</td>
            <td><?php echo $order->getNamatoko();?></td>
        </tr>
        <tr>
            <td>Order From</td>
            <td>:</td>
            <td><?php echo $order->getNamapembeli();?></td>
        </tr>
        <tr>
            <td>Produk Name</td>
            <td>:</td>
            <td><?php echo $order->getNamaproduk();?></td>
        </tr>
        <tr>
            <td>Price</td>
            <td>:</td>
            <td><?php echo "Rp. ".number_format($order->getHargaproduk(),2,',','.');?></td>
        </tr>
        <tr>
            <td>Qty</td>
            <td>:</td>
            <td><?php echo $order->getJumlahproduk();?></td>
        </tr>
        <tr>
            <td colspan="3">
                <hr width="100$" size="2pt" background="black">
            </td>
        </tr>
        <tr>
            <td>Total Price</td>
            <td>:</td>
            <td><?php echo "Rp. ".number_format($order->getHargaproduk() * $order->getJumlahproduk(),2,',','.');?></td>
        </tr>
          <tr>
              <td align="center" colspan="3"><b>Confirmed</b></td>
        </tr>
    </table>
</body>