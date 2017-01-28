<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Pesan.php";
    require_once "AccountController.php";
    
    class PesanController
    {
        public function getPesanRow($row)
        {
            $pesan = new Pesan();
            $accountcontroller = new AccountController();
            $pesan ->setPesanid($row['pesanid']);
            $pesan ->setIsipesan($row['isipesan']);
            $pesan ->setTanggalpesan($row['tanggalpesan']);
            $pesan ->setStatuspesan($row['statuspesan']);
            
            $pengirimaccountid = $row['pengirimaccountid'];
            $penerimaaccountid = $row['penerimaaccountid'];
            $pengirimaccount = $accountcontroller ->getAccountByAccountId($pengirimaccountid);
            $penerimaaccount = $accountcontroller ->getAccountByAccountId($penerimaaccountid);
            $namapengirim = $pengirimaccount -> getNama();
            $namapenerima = $penerimaaccount ->getNama();
            
            $pesan ->setPengirimaccountid($pengirimaccountid);
            $pesan ->setPengirimaccount($pengirimaccount);
            $pesan ->setNamapengirim($namapengirim);
            
            $pesan ->setPenerimaccountid($penerimaaccountid);
            $pesan ->setPenerimaccount($penerimaaccount);
            $pesan ->setNamapenerima($namapenerima);
            
            return $pesan;
        }
        
        public function getInboxPesan($accountid)
        {
            $pesans = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM pesan
                        WHERE penerimaaccountid = ?
                        ORDER BY tanggalpesan DESC";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $pesan = $this->getPesanRow($row);                        
                        $pesans->append($pesan);
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
            return $pesans;
        }
        
        public function getSentboxPesan($accountid)
        {
            $pesans = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM pesan
                        WHERE pengirimaccountid = ?
                        ORDER BY tanggalpesan DESC";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $pesan = $this->getPesanRow($row);                        
                        $pesans->append($pesan);
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
            return $pesans;
        }
        
        public function postPesan($pengirimaccountid, $penerimaaccountid, $isipesan)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO pesan(pengirimaccountid, penerimaaccountid, isipesan)
                        VALUES(?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $pengirimaccountid, PDO::PARAM_STR);
                $stmt -> bindParam(2, $penerimaaccountid, PDO::PARAM_STR);
                $stmt -> bindParam(3, $isipesan, PDO::PARAM_STR);
                      
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