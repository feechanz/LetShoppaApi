<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Produk.php";
    require_once "../Model/Kategoriproduk.php";
    require_once "TokoController.php";
    require_once "KategoriprodukController.php";
    
    class ProdukController 
    {
        public function getProdukRow($row)
        {
            $produk = new Produk();
            $produk->setProdukid($row['produkid']);
            $produk->setNamaproduk($row['namaproduk']);
            $produk->setHargaproduk($row['hargaproduk']);
            $produk->setDeskripsiproduk($row['deskripsiproduk']);
            $produk->setStatusproduk($row['statusproduk']);
            $produk->setTanggalproduk($row['tanggalproduk']);
            $produk->setGambarproduk($row['gambarproduk']);
            
            $tokoid = $row['tokoid'];
            $produk->setTokoid($tokoid);
            $tokocontroller = new TokoController();
            $toko = $tokocontroller->getTokoByTokoId($tokoid);
            $produk->setToko($toko);
            
            $kategoriprodukid = $row['kategoriprodukid'];
            $produk->setKategoriprodukid($kategoriprodukid);
            
            $kategoriprodukcontroller = new KategoriprodukController();
            $kategoriproduk = $kategoriprodukcontroller->getKategoriprodukByKategoriprodukID($kategoriprodukid);
            
            
            $produk->setKategoriproduk($kategoriproduk);
            $produk->setNamakategori($kategoriproduk->getNamakategori());
            //$produk->setNamakategori()
            return $produk;
        }
        
        public function getProdukByProdukId($produkid)
        {
            $produk = null;
         
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM produk
                        WHERE produkid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$produkid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $produk = $this->getProdukRow($row);
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
            return $produk;
        }
        public function getProduks()
        {
            $produks = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM produk
                        ORDER BY kategoriprodukid";
                $stmt = $conn -> prepare($query);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $produk = $this->getProdukRow($row);                        
                        $produks->append($produk);
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
            return $produks;
        }
        
        public function getProduksByTokoid($tokoid)
        {
            $produks = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM produk
                        WHERE tokoid = ?
                        ORDER BY kategoriprodukid";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $tokoid);;
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $produk = $this->getProdukRow($row);                        
                        $produks->append($produk);
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
            return $produks;
        }
        
        public function postProdukDefault($namaproduk,$hargaproduk,$deskripsiproduk,$tokoid,$kategoriprodukid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO produk(namaproduk,hargaproduk,deskripsiproduk,tokoid,kategoriprodukid)
                        VALUES(?,?,?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namaproduk, PDO::PARAM_STR);
                $stmt -> bindParam(2, $hargaproduk, PDO::PARAM_STR);
                $stmt -> bindParam(3, $deskripsiproduk, PDO::PARAM_STR);
                $stmt -> bindParam(4, $tokoid, PDO::PARAM_STR);
                $stmt -> bindParam(5, $kategoriprodukid, PDO::PARAM_STR);
      
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
        
        public function putProduk($produkid, $namaproduk,$hargaproduk, $deskripsiproduk,$statusproduk,$tanggalproduk,$gambarproduk,$tokoid,$kategoriprodukid)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE produk  
                        SET namaproduk = ?,
                            hargaproduk = ?,
                            deskripsiproduk = ?,
                            statusproduk = ?,
                            tanggalproduk = ?,
                            gambarproduk = ?,
                            tokoid = ?,
                            kategoriprodukid = ?
                        WHERE produkid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namaproduk);
                $stmt -> bindParam(2, $hargaproduk);
                $stmt -> bindParam(3, $deskripsiproduk);
                $stmt -> bindParam(4, $statusproduk);
                $stmt -> bindParam(5, $tanggalproduk);
                $stmt -> bindParam(6, $gambarproduk);
                $stmt -> bindParam(7, $tokoid);
                $stmt -> bindParam(8, $kategoriprodukid);
                $stmt -> bindParam(9, $produkid);
               
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
        
        public function putProdukNameDeskripsi($produkid, $namaproduk,$deskripsiproduk)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE produk  
                        SET namaproduk = ?,
                            deskripsiproduk = ?
                        WHERE produkid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namaproduk);
                $stmt -> bindParam(2, $deskripsiproduk);
                $stmt -> bindParam(3, $produkid);
               
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
        
        public function putProdukPrice($produkid, $hargaproduk)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE produk  
                        SET hargaproduk = ?
                        WHERE produkid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $hargaproduk);
                $stmt -> bindParam(2, $produkid);
               
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
        
        public function putProdukKategori($produkid, $kategoriprodukid)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE produk  
                        SET kategoriprodukid = ?
                        WHERE produkid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $kategoriprodukid);
                $stmt -> bindParam(2, $produkid);
               
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
        
        public function putProdukStatus($produkid, $statusproduk)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE produk  
                        SET statusproduk = ?
                        WHERE produkid = ?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $statusproduk);
                $stmt -> bindParam(2, $produkid);
               
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
        
        public function putProdukGambarProduk($produkid, $gambarproduk)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE produk  
                        SET gambarproduk = ?
                        WHERE produkid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $gambarproduk);               
                $stmt -> bindParam(2, $produkid);
               
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