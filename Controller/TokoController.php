<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Toko.php";
    require_once "../Model/Jenistoko.php";
    require_once "../Model/Gambartoko.php";
    require_once "JenistokoController.php";
    require_once "AccountController.php";
    require_once "GambartokoController.php";
    
    class TokoController
    {
        public function getTokoRow($row)
        {
            $toko = new Toko();
            $toko->setTokoid($row['tokoid']);
            $toko->setNamatoko($row['namatoko']);
            $toko->setDeskripsitoko($row['deskripsitoko']);
            $toko->setLokasitoko($row['lokasitoko']);
            $toko->setLatitude($row['latitude']);
            $toko->setLongitude($row['longitude']);           
            $toko->setGambartoko($row['gambartoko']);
            
            
            $jenistokoid=$row['jenistokoid'];
            $toko->setJenistokoid($jenistokoid);
            $jenistokocontroller = new JenistokoController();
            $jenistoko = $jenistokocontroller->getJenistokoByJenistokoId($jenistokoid);
            $toko->setJenistoko($jenistoko);
            
            $toko->setNamajenis($jenistoko->getNamajenis());
            
            $accountid = $row['accountid'];
            $toko->setAccountid($accountid);
            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($accountid);
            $toko->setAccount($account);
            
            $toko->setStatustoko($row['statustoko']);
           
            $toko ->setJarak(0);
            return $toko;
        }
        
        public function getTokos()
        {
            $tokos = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM toko";
                $stmt = $conn -> prepare($query);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $toko = $this->getTokoRow($row);                        
                        $tokos->append($toko);
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
            return $tokos;
        }
        
        public function getTokosByAccountid($accountid)
        {
            $tokos = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM toko
                        WHERE accountid = ?
                        ORDER BY jenistokoid";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $accountid);;
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $toko = $this->getTokoRow($row);                        
                        $tokos->append($toko);
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
            return $tokos;
        }
        
        public function getTokosByJenistokoid($jenistokoid, $keyword)
        {
            $tokos = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM toko
                        WHERE jenistokoid = ?
                        AND 
                        (namatoko LIKE '%".$keyword."%'
                        OR deskripsitoko LIKE '%".$keyword."%'
                        OR lokasitoko LIKE '%".$keyword."%')
						AND statustoko = 1
                        ORDER BY jenistokoid";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $jenistokoid);
           
                
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $toko = $this->getTokoRow($row);                        
                        $tokos->append($toko);
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
            return $tokos;
        }
        
        public function getTokosByJenistokoidAndJarak($jenistokoid, $keyword, $latitude, $longitude, $km)
        {
            $tokos = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM toko
                        WHERE jenistokoid = ?
                        AND 
                        (namatoko LIKE '%".$keyword."%'
                        OR deskripsitoko LIKE '%".$keyword."%'
                        OR lokasitoko LIKE '%".$keyword."%')
						AND statustoko = 1
                        ORDER BY jenistokoid";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $jenistokoid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $toko = $this->getTokoRow($row); 
                        
                        //echo $toko->getNamatoko().":".$jarak." ";
						$jarak = $this->getDistanceBetween($latitude, $longitude, $toko->getLatitude(), $toko->getLongitude());
						$toko ->setJarak($jarak);
                        if($toko->getJarak()<=$km)
                        {
                            $tokos->append($toko);
                        }
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
            return $tokos;
        }
        
        public function getTokoByTokoId($tokoid)
        {
            $toko = null;
         
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM toko
                        WHERE tokoid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$tokoid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $toko = $this->getTokoRow($row);
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
            return $toko;
        }
        
        public function postToko($namatoko,$deskripsitoko,$lokasitoko,$latitude,$longitude,$gambartoko,$jenistokoid,$accountid,$statustoko)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO toko(namatoko,deskripsitoko,lokasitoko,latitude,longitude,gambartoko,jenistokoid,accountid,statustoko)
                        VALUES(?,?,?,?,?,?,?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namatoko, PDO::PARAM_STR);
                $stmt -> bindParam(2, $deskripsitoko, PDO::PARAM_STR);
                $stmt -> bindParam(3, $lokasitoko, PDO::PARAM_STR);
                $stmt -> bindParam(4, $latitude, PDO::PARAM_STR);
                $stmt -> bindParam(5, $longitude, PDO::PARAM_STR);
                $stmt -> bindParam(6, $gambartoko, PDO::PARAM_STR);
                $stmt -> bindParam(7, $jenistokoid, PDO::PARAM_STR);
                $stmt -> bindParam(8, $accountid, PDO::PARAM_STR);
                $stmt -> bindParam(9, $statustoko, PDO::PARAM_STR);
                
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
        
        public function postTokoDefault($namatoko,$deskripsitoko,$lokasitoko,$latitude,$longitude,$jenistokoid,$accountid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO toko(namatoko,deskripsitoko,lokasitoko,latitude,longitude,jenistokoid,accountid)
                        VALUES(?,?,?,?,?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namatoko, PDO::PARAM_STR);
                $stmt -> bindParam(2, $deskripsitoko, PDO::PARAM_STR);
                $stmt -> bindParam(3, $lokasitoko, PDO::PARAM_STR);
                $stmt -> bindParam(4, $latitude, PDO::PARAM_STR);
                $stmt -> bindParam(5, $longitude, PDO::PARAM_STR);
                $stmt -> bindParam(6, $jenistokoid, PDO::PARAM_STR);
                $stmt -> bindParam(7, $accountid, PDO::PARAM_STR);
                
                $result = $stmt -> execute();
                $tokoid = $conn ->lastInsertId();
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
            if(!$result)
            {
                return 0;
            }
            else
            {
                return $tokoid;
            }
        }
        
        public function putToko($tokoid, $namatoko,$deskripsitoko,$lokasitoko,$latitude,$longitude,$gambartoko,$jenistokoid,$accountid,$statustoko)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE toko  
                        SET namatoko = ?,
                            deskripsitoko = ?,
                            lokasitoko = ?,
                            latitude = ?,
                            longitude = ?,
                            gambartoko = ?,
                            jenistokoid = ?,
                            accountid = ?,
                            statustoko = ?
                        WHERE tokoid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namatoko);
                $stmt -> bindParam(2, $deskripsitoko);
                $stmt -> bindParam(3, $lokasitoko);
                $stmt -> bindParam(4, $latitude);
                $stmt -> bindParam(5, $longitude);
                $stmt -> bindParam(6, $gambartoko);
                $stmt -> bindParam(7, $jenistokoid);
                $stmt -> bindParam(8, $accountid);
                $stmt -> bindParam(9, $statustoko);
                $stmt -> bindParam(10, $tokoid);
               
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
        
        public function putTokoNameDeskripsi($tokoid, $namatoko,$deskripsitoko)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE toko  
                        SET namatoko = ?,
                            deskripsitoko = ?
                        WHERE tokoid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $namatoko);
                $stmt -> bindParam(2, $deskripsitoko);
                $stmt -> bindParam(3, $tokoid);
               
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
        
        public function putTokoLocation($tokoid, $lokasitoko,$latitude,$longitude)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE toko  
                        SET lokasitoko = ?,
                            latitude = ?,
                            longitude = ?
                        WHERE tokoid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $lokasitoko);
                $stmt -> bindParam(2, $latitude);
                $stmt -> bindParam(3, $longitude);
                $stmt -> bindParam(4, $tokoid);
               
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
        
        public function putTokoStatus($tokoid, $statustoko)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE toko  
                        SET statustoko = ?
                        WHERE tokoid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $statustoko);
                $stmt -> bindParam(2, $tokoid);
               
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
        
        public function putTokoGambartoko($tokoid,$gambartoko)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE toko  
                        SET gambartoko = ?
                        WHERE tokoid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $gambartoko);
                $stmt -> bindParam(2, $tokoid);
               
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
        
        function getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km') 
        { 
            $theta = $longitude1 - $longitude2; 
            $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
            $distance = acos($distance); 
            $distance = rad2deg($distance); 
            $distance = $distance * 60 * 1.1515; 
            switch($unit) 
            { 
                case 'Mi': break; 
                case 'Km' : $distance = $distance * 1.609344; 
            } 
            return (round($distance,2)); 
        }
    }
?>