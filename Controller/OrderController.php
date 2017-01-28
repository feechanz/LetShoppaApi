<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Order.php";
    require_once "AccountController.php";
    require_once "ProdukController.php";
    require_once "TokoController.php";
    
    class OrderController
    {
        public function getOrderRow($row)
        {
            $order = new Order();
            $order->setOrderid($row['orderid']);
            $order->setTanggalorder($row['tanggalorder']);    
            $order->setStatusorder($row['statusorder']);
            
            $accountid = $row['accountid'];
            $order->setAccountid($accountid);
            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($accountid);
            $order->setAccount($account);
            
            $order->setNamaproduk($row['namaproduk']);
            $order->setDeskripsiproduk($row['deskripsiproduk']);
            $order->setHargaproduk($row['hargaproduk']);
            $order->setJumlahproduk($row['jumlahproduk']);
           
            $produkid = $row['produkid'];
            $order->setProdukid($produkid);
            $produkcontroller = new ProdukController();
            $produk = $produkcontroller->getProdukByProdukId($produkid);
            $order->setProduk($produk);
            
            $order->setGambarproduk($row['gambarproduk']);
            
            $order->setNamapembeli($account->getNama());
            
            $tokocontroller = new TokoController();
            $toko = $tokocontroller->getTokoByTokoId($produk->getTokoid());
            
            $order->setNamatoko($toko->getNamatoko());
            $order->setTokoid($toko->getTokoid());
            
            return $order;
        }
        
        public function getOrderByOrderid($orderid)
        {
            $order = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `order`
                        WHERE orderid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$orderid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $order = $this->getOrderRow($row);
                    }
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
                die();
            }
            try
            {
                if (!empty($conn) || $conn != null) {
                    $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $order;
        }
        
        public function getOrderByAccountidAndStatusorder($accountid,$statusorder)
        {
            $orders = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `order`
                        WHERE accountid = ? AND statusorder = ?
                        ORDER BY tanggalorder DESC";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $accountid);
                $stmt -> bindParam(2, $statusorder);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $order = $this->getOrderRow($row);                        
                        $orders->append($order);
                    }
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
                die();
            }
            try
            {
                if (!empty($conn) || $conn != null) 
                {
                    $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $orders;
        }
        
        public function getOrderByPurchased($accountid, $statusorder)
        {
            $orders = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `order`
                        WHERE accountid = ? AND statusorder != ?
                        ORDER BY tanggalorder DESC";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $accountid);
                $stmt -> bindParam(2, $statusorder);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $order = $this->getOrderRow($row);                        
                        $orders->append($order);
                    }
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
                die();
            }
            try
            {
                if (!empty($conn) || $conn != null) 
                {
                    $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $orders;
        }
        
        public function getOrderedFromShop($accountid)
        {
            $orders = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `order`
                        WHERE orderid IN
                            (SELECT orderid 
                             FROM `order`
                             WHERE produkid IN
                                (SELECT produkid
                                 FROM produk
                                 WHERE tokoid IN
                                    (SELECT tokoid
                                     FROM toko
                                     WHERE accountid = ?)))
                        AND statusorder != 1
                        ORDER BY tanggalorder DESC";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $order = $this->getOrderRow($row);                        
                        $orders->append($order);
                    }
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
                die();
            }
            try
            {
                if (!empty($conn) || $conn != null) 
                {
                    $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $orders;
        }
        public function postOrder($accountid, $namaproduk, $deskripsiproduk, $hargaproduk, $jumlahproduk, $produkid, $gambarproduk)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO `order`(accountid,namaproduk,deskripsiproduk,hargaproduk,jumlahproduk,produkid,gambarproduk)
                        VALUES(?,?,?,?,?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $accountid, PDO::PARAM_STR);
                $stmt -> bindParam(2, $namaproduk, PDO::PARAM_STR);
                $stmt -> bindParam(3, $deskripsiproduk, PDO::PARAM_STR);
                $stmt -> bindParam(4, $hargaproduk, PDO::PARAM_STR);
                $stmt -> bindParam(5, $jumlahproduk, PDO::PARAM_STR);
                $stmt -> bindParam(6, $produkid, PDO::PARAM_STR);
                $stmt -> bindParam(7, $gambarproduk, PDO::PARAM_STR);
      
                $result = $stmt -> execute();
                $conn -> commit();
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
                $stmt -> rollBack();
                die();
            }
            try
            {
                if(!empty($conn) || $conn != null)
                {
                    $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $result;
        }
        
        function putOrderStatusOrder($orderid, $statusorder)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE `order`  
                        SET statusorder = ?
                        WHERE orderid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $statusorder);
                $stmt -> bindParam(2, $orderid);
                $result = $stmt -> execute();
                $conn -> commit();
            } 
            catch (PDOException $e) {
                echo $e -> getMessage();
                $conn -> rollBack();
                die();
            }
            $conn = null;
            return $result;	
        }
        
        function deleteOrder($orderid)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "DELETE FROM `order`
                        WHERE orderid = ?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $orderid);
                $result = $stmt -> execute();
                $conn -> commit();
            } 
            catch (PDOException $e) {
                echo $e -> getMessage();
                $conn -> rollBack();
                die();
            }
            $conn = null;
            return $result;	
        }
    }
?>