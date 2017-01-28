<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Kontak.php";
    require_once "AccountController.php";
    
    class KontakController
    {
        public function getKontakRow($row)
        {
            $kontak = new Kontak();
            
            $kontak ->setKontakid($row['kontakid']);
            $kontak ->setJeniskontak($row['jeniskontak']);
            $kontak ->setIsikontak($row['isikontak']);
            $accountid = $row['accountid'];
            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($accountid);
            $kontak ->setAccountid($accountid);
            $kontak ->setAccount($account);
            return $kontak;
        }
        
        public function getKontakByKontakId($kontakid)
        {
            $kontak = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM kontak
                        WHERE kontakid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$kontakid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $kontak = $this->getKontakRow($row);
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
            return $kontak;
        }
        
        public function getKontaksByAccountid($accountid)
        {
            $kontaks = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM kontak
                        WHERE accountid = ?";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $accountid);;
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $kontak = $this->getKontakRow($row);                        
                        $kontaks->append($kontak);
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
            return $kontaks;
        }
        
        function postKontak($accountid,$jeniskontak,$isikontak)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO kontak(jeniskontak,isikontak,accountid)
                        VALUES(?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $jeniskontak, PDO::PARAM_STR);
                $stmt -> bindParam(2, $isikontak, PDO::PARAM_STR);
                $stmt -> bindParam(3, $accountid, PDO::PARAM_STR);
                      
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
        
        function putKontak($kontakid,$jeniskontak,$isikontak)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE kontak 
                        SET jeniskontak = ?,
                            isikontak = ?
                        WHERE kontakid=?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $jeniskontak, PDO::PARAM_STR);
                $stmt -> bindParam(2, $isikontak, PDO::PARAM_STR);
                $stmt -> bindParam(3, $kontakid, PDO::PARAM_STR);
                      
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
        
        function deleteKontak($kontakid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "DELETE FROM kontak 
                        WHERE kontakid=?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $kontakid, PDO::PARAM_STR);
                      
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