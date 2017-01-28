<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Gambarproduk.php";
    
    class GambarprodukController
    {
        public function getGambarprodukRow($row)
        {
            $gambarproduk = new Gambarproduk();
            $gambarproduk->setGambarprodukid($row['gambarprodukid']);
            $gambarproduk->setProdukid($row['produkid']);    
            $gambarproduk->setLinkgambarproduk($row['linkgambarproduk']);
            
            return $gambarproduk;
        }
        
        public function getGambarprodukByGambarprodukId($gambarprodukid)       
        {
            $gambarproduk = new Gambarproduk();
         
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM gambarproduk
                        WHERE gambarprodukid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$gambarprodukid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $gambarproduk = $this->getGambarprodukRow($row);
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
            return $gambarproduk;
        }
    }
?>