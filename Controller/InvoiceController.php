<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Invoice.php";
    
    class InvoiceController
    {       
        public function getInvoiceRow($row)
        {
            $invoice = new Invoice();
            $invoice ->setInvoiceid($row['invoiceid']);
            $invoice ->setTanggalinvoice($row['tanggalinvoice']);
            $invoice ->setTotalinvoice($row['totalinvoice']);
            $invoice ->setOrderid($row['orderid']);
            return $invoice;
        }
        
        public function getInvoiceByInvoiceId($invoiceid)
        {
            $invoice = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM invoice
                        WHERE invoiceid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$invoiceid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $invoice = $this->getInvoiceRow($row);
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
            return $invoice;
        }
        
        public function getInvoiceByOrderid($orderid)
        {
             $invoice = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM invoice
                        WHERE orderid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$orderid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $invoice = $this->getInvoiceRow($row);
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
            return $invoice;
        }
        
        function postInvoice($orderid,$tanggalinvoice,$totalinvoice)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO invoice(orderid,tanggalinvoice,totalinvoice)
                        VALUES(?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $orderid, PDO::PARAM_STR);
                $stmt -> bindParam(2, $tanggalinvoice, PDO::PARAM_STR);
                $stmt -> bindParam(3, $totalinvoice, PDO::PARAM_STR);
                      
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
        
        function putInvoice($orderid,$tanggalinvoice,$totalinvoice)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE invoice 
                        SET tanggalinvoice = ?,
                            totalinvoice = ?
                        WHERE orderid=?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $tanggalinvoice, PDO::PARAM_STR);
                $stmt -> bindParam(2, $totalinvoice, PDO::PARAM_STR);
                $stmt -> bindParam(3, $orderid, PDO::PARAM_STR);
                      
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