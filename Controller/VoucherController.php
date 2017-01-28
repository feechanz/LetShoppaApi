<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Voucher.php";
    class VoucherController
    {
        public function getVoucherRow($row)
        {
            $voucher = new Voucher();
            $voucher->setVoucherid($row['voucherid']);
            $voucher->setVouchercode($row['vouchercode']);
            $voucher->setVoucherdate($row['datevoucher']);
            $voucher->setDay($row['day']);
            $voucher->setStatusvoucher($row['statusvoucher']);
            return $voucher;
        }
        
        public function getVoucherByCode($vouchercode)
        {
            $voucher = null;
         
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM voucher
                        WHERE vouchercode = ? AND statusvoucher = 1";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$vouchercode);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $voucher = $this->getVoucherRow($row);
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
            return $voucher;
        }


        public function putVoucherCode($voucherid, $vouchercode)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE voucher  
                        SET vouchercode = ?
                        WHERE voucherid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $vouchercode);
                $stmt -> bindParam(2, $voucherid);
               
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
        
        public function putVoucherUsed($vouchercode)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE voucher  
                        SET statusvoucher = 0,
                            voucherused = now()
                        WHERE vouchercode = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $vouchercode);
               
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
        
        function postVoucher($day)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO voucher(day)
                        VALUES(?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $day, PDO::PARAM_STR);
                
                $result = $stmt -> execute();
                $voucherid = $conn ->lastInsertId();
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
            if(!$result)
            {
                return 0;
            }
            else
            {
                return $voucherid;
            }
        }
    }
?>