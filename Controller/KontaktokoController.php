<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Kontaktoko.php";
    require_once "TokoController.php";
    
    class KontaktokoController
    {
        public function getKontaktokoRow($row)
        {
            $kontaktoko = new Kontaktoko();
            
            $kontaktoko ->setKontaktokoid($row['kontaktokoid']);
            $kontaktoko ->setJeniskontak($row['jeniskontak']);
            $kontaktoko ->setIsikontak($row['isikontak']);
                     
            $tokoid = $row['tokoid'];
            $tokocontroller = new TokoController();
            $toko = $tokocontroller->getTokoByTokoId($tokoid);
            
            $kontaktoko ->setTokoid($tokoid);
            $kontaktoko ->setToko($toko);
            return $kontaktoko;
        }
        
        public function getKontaktokoByKontaktokoId($kontaktokoid)
        {
            $kontaktoko = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM kontaktoko
                        WHERE kontaktokoid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$kontaktokoid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $kontaktoko = $this->getKontaktokoRow($row);
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
            return $kontaktoko;
        }
        
        public function getKontaktokosByTokoid($tokoid)
        {
            $kontaktokos = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM kontaktoko
                        WHERE tokoid = ?";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $tokoid);;
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $kontaktoko = $this->getKontaktokoRow($row);                        
                        $kontaktokos->append($kontaktoko);
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
            return $kontaktokos;
        }
        
        function postKontaktoko($tokoid,$jeniskontak,$isikontak)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO kontaktoko(jeniskontak,isikontak,tokoid)
                        VALUES(?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $jeniskontak, PDO::PARAM_STR);
                $stmt -> bindParam(2, $isikontak, PDO::PARAM_STR);
                $stmt -> bindParam(3, $tokoid, PDO::PARAM_STR);
                      
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
        
        function putKontaktoko($kontaktokoid,$jeniskontak,$isikontak)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE kontaktoko 
                        SET jeniskontak = ?,
                            isikontak = ?
                        WHERE kontaktokoid=?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $jeniskontak, PDO::PARAM_STR);
                $stmt -> bindParam(2, $isikontak, PDO::PARAM_STR);
                $stmt -> bindParam(3, $kontaktokoid, PDO::PARAM_STR);
                      
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
        
        function deleteKontaktoko($kontaktokoid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "DELETE FROM kontaktoko 
                        WHERE kontaktokoid=?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $kontaktokoid, PDO::PARAM_STR);
                      
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