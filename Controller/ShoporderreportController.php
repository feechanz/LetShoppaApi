<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Shoporderreport.php";
    
    class ShoporderreportController 
    {
        public function getShoporderreportRow($row)
        {
            $shoporderreport = new Shoporderreport();
            $shoporderreport ->setYear($row['year']);
            $shoporderreport ->setMonth($row['month']);
            $shoporderreport ->setJumlahorder($row['jumlahorder']);
            return $shoporderreport;
        }
   
        public function getShoporderreports($tokoid,$year)
        {
            $shoporderreports = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT YEAR(tanggalorder) AS year, 
                        MONTH(tanggalorder) AS month, 
                        COUNT(orderid) AS jumlahorder
                        FROM `order`
                        WHeRE produkid IN
                                (SELECT produkid
                                FROM produk
                                WHERE tokoid = ?) and YEAR(tanggalorder)= ?
                        GROUP BY YEAR(tanggalorder), MONTH(tanggalorder)
                        ORDER BY MONTH(tanggalorder)";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$tokoid);
                $stmt ->bindParam(2,$year);
                $stmt -> execute();
              
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $shoporderreport = $this->getShoporderreportRow($row);                        
                        $shoporderreports->append($shoporderreport);
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
            return $shoporderreports;
        }
    }
?>