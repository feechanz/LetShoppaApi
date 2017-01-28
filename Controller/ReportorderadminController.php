<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Reportorderadmin.php";
    
    class ReportorderadminController 
    {
        public function getReportRow($row)
        {
            $report = new Reportorderadmin();
            $report ->setNamatoko($row['namatoko']);
            $report ->setJumlah($row['jumlah']);
            return $report;
        }
        

        public function getReports($begindate, $enddate)
        {
            $reports = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT t.namatoko, COUNT(o.orderid) as jumlah
                        FROM `toko` t
                        JOIN `produk` p
                        ON p.tokoid = t.tokoid
                        JOIN `order`o
                        ON p.produkid = o.produkid
                        WHERE o.tanggalorder between ? and ?
                        GROUP BY t.namatoko";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$begindate);
                $stmt ->bindParam(2,$enddate);
                $stmt -> execute();
   
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $report = $this->getReportRow($row);                        
                        $reports->append($report);
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
            return $reports;
        }
    }
?>