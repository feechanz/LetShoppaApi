<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Pengiriman.php";
    require_once "OrderController.php";
    
    class PengirimanController
    {
        public function getPengirimanRow($row)
        {
            $pengiriman = new Pengiriman();
            $pengiriman -> setPengirimanid($row['pengirimanid']);
            $pengiriman -> setTanggalpengiriman($row['tanggalpengiriman']);
            $pengiriman -> setKeterangan($row['keterangan']);
            $pengiriman -> setJasaekspedisi($row['jasaekspedisi']);
            $pengiriman -> setNoresi($row['noresi']);
            $pengiriman -> setBiayakirim($row['biayakirim']);
            $orderid = $row['orderid'];
            $ordercontroller = new OrderController();
            $order = $ordercontroller ->getOrderByOrderid($orderid);
            $pengiriman -> setOrderid($orderid);
            $pengiriman -> setOrder($order);
            return $pengiriman;
        }
        
        public function getPengirimanByOrderid($orderid)
        {
            $pengiriman = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `pengiriman`
                        WHERE orderid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$orderid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $pengiriman = $this->getPengirimanRow($row);
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
            return $pengiriman;
        }
        
        public function getPengirimanByPengirimanid($pengirimanid)
        {
            $pengiriman = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `pengiriman`
                        WHERE pengirimanid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$pengirimanid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $pengiriman = $this->getPengirimanRow($row);
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
            return $pengiriman;
        }
        
        public function postPengiriman($keterangan, $jasaekspedisi, $noresi, $biayakirim, $orderid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO `pengiriman`(keterangan, jasaekspedisi, noresi, biayakirim, orderid)
                        VALUES(?,?,?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $keterangan, PDO::PARAM_STR);
                $stmt -> bindParam(2, $jasaekspedisi, PDO::PARAM_STR);
                $stmt -> bindParam(3, $noresi, PDO::PARAM_STR);
                $stmt -> bindParam(4, $biayakirim, PDO::PARAM_STR);
                $stmt -> bindParam(5, $orderid, PDO::PARAM_STR);
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
        public function putPengiriman($keterangan, $jasaekspedisi, $noresi, $biayakirim, $orderid)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE `pengiriman`  
                        SET keterangan = ?,
                            jasaekspedisi =?,
                            noresi = ?,
                            biayakirim = ?
                        WHERE orderid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $keterangan);
                $stmt -> bindParam(2, $jasaekspedisi);
                $stmt -> bindParam(3, $noresi);
                $stmt -> bindParam(4, $biayakirim);
                $stmt -> bindParam(5, $orderid);
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