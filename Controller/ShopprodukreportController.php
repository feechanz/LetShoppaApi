<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Shopprodukreport.php";
    
    class ShopprodukreportController 
    {
        public function getShopprodukreportRow($row)
        {
            $shopprodukreport = new Shopprodukreport();
            $shopprodukreport ->setNamaproduk($row['namaproduk']);
            $shopprodukreport ->setJumlahorder($row['jumlahorder']);
            return $shopprodukreport;
        }
   
        public function getShopprodukreports($tokoid, $begindate, $enddate)
        {
            $shopprodukreports = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT p.namaproduk, COUNT(o.orderid) AS jumlahorder
                        FROM produk p
                        LEFT JOIN `order` o
                        ON o.produkid = p.produkid
                        AND (o.tanggalorder BETWEEN ? AND ?)
                        WHERE p.tokoid = ? 
                        GROUP BY p.namaproduk";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$begindate);
                $stmt ->bindParam(2,$enddate);
                $stmt ->bindParam(3,$tokoid);
                $stmt -> execute();
              
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $shopprodukreport = $this->getShopprodukreportRow($row);                        
                        $shopprodukreports->append($shopprodukreport);
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
            return $shopprodukreports;
        }
    }
?>