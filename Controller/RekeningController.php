<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Rekening.php";
    
    class RekeningController
    {       
        public function getRekeningRow($row)
        {
            $rekening = new Rekening();
            $rekening ->setRekeningid($row['rekeningid']);
            $rekening ->setNomorrekening($row['nomorrekening']);
            $rekening ->setNamabank($row['namabank']);
            $rekening ->setTokoid($row['tokoid']);
            return $rekening;
        }
        
        public function getRekeningByRekeningId($rekeningid)
        {
            $rekening = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM rekening
                        WHERE rekeningid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$rekeningid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $rekening = $this->getRekeningRow($row);
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
            return $rekening;
        }
        
        public function getRekeningsByTokoid($tokoid)
        {
            $rekenings = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM rekening
                        WHERE tokoid = ?";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $tokoid);;
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $rekening = $this->getRekeningRow($row);                        
                        $rekenings->append($rekening);
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
            return $rekenings;
        }
        
        function postRekening($tokoid,$nomorrekening,$namabank)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO rekening(tokoid,nomorrekening,namabank)
                        VALUES(?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $tokoid, PDO::PARAM_STR);
                $stmt -> bindParam(2, $nomorrekening, PDO::PARAM_STR);
                $stmt -> bindParam(3, $namabank, PDO::PARAM_STR);
                      
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
        
        function putRekening($rekeningid,$nomorrekening,$namabank)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE rekening 
                        SET nomorrekening = ?,
                            namabank = ?
                        WHERE rekeningid=?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $nomorrekening, PDO::PARAM_STR);
                $stmt -> bindParam(2, $namabank, PDO::PARAM_STR);
                $stmt -> bindParam(3, $rekeningid, PDO::PARAM_STR);
                      
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
        
        function deleteRekening($rekeningid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "DELETE FROM rekening 
                        WHERE rekeningid=?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $rekeningid, PDO::PARAM_STR);
                      
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