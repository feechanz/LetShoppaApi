<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Jenistoko.php";
    
    class JenistokoController
    {
        public function getJenistokoRow($row)
        {
            $jenistoko = new Jenistoko();
            $jenistoko->setJenistokoid($row['jenistokoid']);
            $jenistoko->setNamajenis($row['namajenis']);
            
            return $jenistoko;
        }
        
        public function getJenistokoByJenistokoId($jenistokoid)
        {
            $jenistoko = null;
         
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM jenistoko
                        WHERE jenistokoid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$jenistokoid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $jenistoko = $this->getJenistokoRow($row);
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
            return $jenistoko;
        }
        
        public function getJenistokos()
        {
            $jenistokos = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM jenistoko";
                $stmt = $conn -> prepare($query);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $jenistoko = $this->getJenistokoRow($row);                        
                        $jenistokos->append($jenistoko);
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
            return $jenistoko;
        }
        
        public function postJenistoko($namajenis)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO jenistoko(namajenis)
                        VALUES(?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namajenis, PDO::PARAM_STR);     
                
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
        
        public function putJenistoko($jenistokoid, $namajenis)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE jenistoko  
                        SET namajenis = ?
                        WHERE jenistokoid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namajenis);
                $stmt -> bindParam(2, $jenistokoid);
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