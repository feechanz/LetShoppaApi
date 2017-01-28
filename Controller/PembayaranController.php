<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Pembayaran.php";
    require_once "OrderController.php";
    
    class PembayaranController
    {
        public function getPembayaranRow($row)
        {
            $pembayaran = new Pembayaran();
            $pembayaran -> setPembayaranid($row['pembayaranid']);
            $pembayaran -> setTanggalpembayaran($row['tanggalpembayaran']);
            $pembayaran -> setKeterangan($row['keterangan']);
            $pembayaran -> setBuktipembayaran($row['buktipembayaran']);
            $pembayaran -> setTotalpembayaran($row['totalpembayaran']);
            $orderid = $row['orderid'];
            $ordercontroller = new OrderController();
            $order = $ordercontroller ->getOrderByOrderid($orderid);
            $pembayaran -> setOrderid($orderid);
            $pembayaran -> setOrder($order);
            return $pembayaran;
        }
        
        public function getPembayaransByOrderId($orderid)
        {
            $pembayarans = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `pembayaran`
                        WHERE orderid = ?
                        ORDER BY tanggalpembayaran ASC";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $orderid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $pembayaran = $this->getPembayaranRow($row);                        
                        $pembayarans->append($pembayaran);
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
            return $pembayarans;
        }
        
        public function getPembayaranByPembayaranId($pembayaranid)
        {
            $pembayaran = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `pembayaran`
                        WHERE pembayaranid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$pembayaranid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $pembayaran = $this->getPembayaranRow($row);
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
            return $pembayaran;
        }
        
        public function postPembayaranDefault($keterangan, $totalpembayaran, $orderid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO `pembayaran`(keterangan,totalpembayaran,orderid)
                        VALUES(?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $keterangan, PDO::PARAM_STR);
                $stmt -> bindParam(2, $totalpembayaran, PDO::PARAM_STR);
                $stmt -> bindParam(3, $orderid, PDO::PARAM_STR);
                $result = $stmt -> execute();
                $pembayaranid = $conn ->lastInsertId();
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
            if($result)
            {
                return $pembayaranid;
            }
            else
            {
                return 0;
            }
        }
        
        public function putBuktiPembayaran($pembayaranid, $buktipembayaran)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE pembayaran  
                        SET buktipembayaran = ?
                        WHERE pembayaranid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $buktipembayaran);
                $stmt -> bindParam(2, $pembayaranid);
               
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
        
        public function postPembayaran($keterangan, $buktipembayaran, $totalpembayaran, $orderid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO `pembayaran`(keterangan,buktipembayaran,totalpembayaran,orderid)
                        VALUES(?,?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $keterangan, PDO::PARAM_STR);
                $stmt -> bindParam(2, $buktipembayaran, PDO::PARAM_STR);
                $stmt -> bindParam(3, $totalpembayaran, PDO::PARAM_STR);
                $stmt -> bindParam(4, $orderid, PDO::PARAM_STR);
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
    }
?>