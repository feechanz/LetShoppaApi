<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Kategoriproduk.php";
    require_once "JenistokoController.php";
    
    class KategoriprodukController
    {
        public function getKategoriprodukRow($row)
        {
            $kategoriproduk = new Kategoriproduk();
            $kategoriproduk->setKategoriprodukid($row['kategoriprodukid']);
            $kategoriproduk->setNamakategori($row['namakategori']);
            
            $jenistokoid = $row['jenistokoid'];
            $kategoriproduk->setJenistokoid($jenistokoid);
            
            $jenistokocontroller = new JenistokoController();
            $jenistoko = $jenistokocontroller->getJenistokoByJenistokoId($jenistokoid);
            $kategoriproduk->setJenistoko($jenistoko);
            
            return $kategoriproduk;
        }
        
        public function getKategoriproduks()
        {
            $kategoriproduks = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM kategoriproduk";
                $stmt = $conn -> prepare($query);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $kategoriproduk = $this->getKategoriprodukRow($row);                        
                        $kategoriproduks->append($kategoriproduk);
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
            return $kategoriproduks;
        }
        
        public function getKategoriproduksByJenisTokoId($jenistokoid)
        {
            $kategoriproduks = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM kategoriproduk
                        WHERE jenistokoid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$jenistokoid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $kategoriproduk = $this->getKategoriprodukRow($row);                        
                        $kategoriproduks->append($kategoriproduk);
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
            return $kategoriproduks;
        }
        
        public function getKategoriprodukByKategoriprodukID($kategoriprodukid)
        {
            $kategoriproduk = null;
         
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM kategoriproduk
                        WHERE kategoriprodukid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$kategoriprodukid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $kategoriproduk = $this->getKategoriprodukRow($row);
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
            return $kategoriproduk;
        }
        
        public function postKategoriproduk($namakategori)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO kategoriproduk(namakategori)
                        VALUES(?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namakategori, PDO::PARAM_STR);     
                
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
        
        public function putKategoriproduk($kategoriprodukid, $namakategori)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE kategoriproduk  
                        SET namakategori = ?
                        WHERE kategoriprodukid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namakategori);
                $stmt -> bindParam(2, $kategoriprodukid);
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