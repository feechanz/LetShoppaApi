<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Account.php";
    
    class AccountController
    {       
        public function getAccountRow($row)
        {
            $account = new Account();
            $account->setAccountid($row['accountid']);
            $account->setEmail($row['email']);
            $account->setPassword($row['password']);
            $account->setNama($row['nama']);
            $account->setGender($row['gender']);
            $account->setBirthdate($row['birthdate']);
            $account->setLinkgambaraccount($row['linkgambaraccount']);
            $account->setPremiumaccount($row['premiumaccount']);
            $account->setLevelaccount($row['levelaccount']);
            $account->setStatusaccount($row['statusaccount']);
            
            return $account;
        }     
        
        public function postAccountDefault($email, $password, $nama, $gender, $birthdate)
        {
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "SELECT * FROM account 
                        WHERE email = ?";
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $email);;
                $result = $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    $ada = TRUE;

                }
                else
                {
                    $ada = FALSE;
                }
            }
            catch (PDOException $e)
            {
                    echo $e -> getMessage();
                    die();
            }
            $conn = null;
            
            $result = FALSE;
            
            if(!$ada)
            {
                try
                {
                    $conn = Koneksi::get_connection();
                    $sql = "INSERT INTO account(email,password,nama,gender,birthdate)
                            VALUES(?,?,?,?,?)";
                    $conn -> beginTransaction();
                    $stmt = $conn -> prepare($sql);
                    $stmt -> bindParam(1, $email, PDO::PARAM_STR);
                    $stmt -> bindParam(2, $password, PDO::PARAM_STR);
                    $stmt -> bindParam(3, $nama, PDO::PARAM_STR);
                    $stmt -> bindParam(4, $gender, PDO::PARAM_STR);
                    $stmt -> bindParam(5, $birthdate, PDO::PARAM_STR);

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
            }
            return $result;	
        }
        
        
        public function postAccount($email, $password, $nama, $gender, $birthdate, $linkgambaraccount, $premiumaccount, $levelaccount, $statusaccount)
        {
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "SELECT * FROM account 
                        WHERE email = ?";
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $email);;
                $result = $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    $ada = TRUE;

                }
                else
                {
                    $ada = FALSE;
                }
            }
            catch (PDOException $e)
            {
                    echo $e -> getMessage();
                    die();
            }
            $conn = null;
            
            if(!$ada)
            {
                $result = FALSE;
                try
                {
                    $conn = Koneksi::get_connection();
                    $sql = "INSERT INTO account(email,password,nama,gender,birthdate,linkgambaraccount,premiumaccount,levelaccount,statusaccount)
                            VALUES(?,?,?,?,?,?,?,?)";
                    $conn -> beginTransaction();
                    $stmt = $conn -> prepare($sql);
                    $stmt -> bindParam(1, $email, PDO::PARAM_STR);
                    $stmt -> bindParam(2, $password, PDO::PARAM_STR);
                    $stmt -> bindParam(3, $nama, PDO::PARAM_STR);
                    $stmt -> bindParam(4, $gender, PDO::PARAM_STR);
                    $stmt -> bindParam(5, $birthdate, PDO::PARAM_STR);
                    $stmt -> bindParam(6, $linkgambaraccount, PDO::PARAM_STR);
                    $stmt -> bindParam(7, $premiumaccount, PDO::PARAM_STR);
                    $stmt -> bindParam(8, $levelaccount, PDO::PARAM_STR);
                    $stmt -> bindParam(9, $statusaccount, PDO::PARAM_STR);

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
            }
            return $result;	
        }
        
        
        
        public function putAccount($accountid, $email, $password, $nama, $gender, $birthdate, $linkgambaraccount, $premiumaccount, $levelaccount, $statusaccount)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE account  
                        SET email = ?,
                            password = ?,
                            nama = ?,
                            gender = ?,
                            birthdate = ?,
                            linkgambaraccount = ?,
                            premiumaccount = ?,
                            levelaccount = ?,
                            statusaccount = ?
                        WHERE accountid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $email);
                $stmt -> bindParam(2, $password);
                $stmt -> bindParam(3, $nama);
                $stmt -> bindParam(4, $gender);
                $stmt -> bindParam(5, $birthdate);
                $stmt -> bindParam(6, $linkgambaraccount);
                $stmt -> bindParam(7, $premiumaccount);
                $stmt -> bindParam(8, $levelaccount);
                $stmt -> bindParam(9, $statusaccount);
                $stmt -> bindParam(10, $accountid);
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
        
        
        public function putAccountPremiumService($accountid, $day)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE account 
                        SET `premiumaccount` = DATE_ADD(GREATEST(now(),premiumaccount) , INTERVAL ? DAY)
                        WHERE `accountid` = ?;";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $day);
                $stmt -> bindParam(2, $accountid);
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
        
        public function putAccountLinkgambaraccount($accountid, $linkgambaraccount)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE account  
                        SET linkgambaraccount = ?
                        WHERE accountid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $linkgambaraccount);
                $stmt -> bindParam(2, $accountid);
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
        
        public function putAccountPassword($accountid, $password)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE account  
                        SET password = ?
                        WHERE accountid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $password);
                $stmt -> bindParam(2, $accountid);
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
        
        public function getAccounts()
        {
            $accounts = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM account";
                $stmt = $conn -> prepare($query);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $account = $this->getAccountRow($row);                        
                        $accounts->append($account);
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
            return $accounts;
        }
        
        public function getAccountByEmailPassword($email, $password)
        {
            $account = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM account
                        WHERE email = ? AND password = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$email);
                $stmt ->bindParam(2,$password);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $account = $this->getAccountRow($row);
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
                if (!empty($conn) || $conn != null) 
                {
                        $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $account;
        }
        
        public function getAccountByEmail($email)
        {
            $result = false;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM account
                        WHERE email = ? ";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$email);
  
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    $result = true;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
                die();
            }
            try
            {
                if (!empty($conn) || $conn != null) 
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
        
        
        public function getAccountByAccountId($accountid)
        {
            $account = null;
         
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM account
                        WHERE accountid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $account = $this->getAccountRow($row);
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
            return $account;
        }
        
        public function getAllFollowersByAccountId($accountid)
        {
            $accounts = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                       FROM account
                       WHERE accountid IN 
                           (SELECT accountid FROM follow
                            WHERE targetaccountid = ?)";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $account = $this->getAccountRow($row);                        
                        $accounts->append($account);
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
            return $accounts;
        }
        
        public function getAllFollowingByAccountId($accountid)
        {
            $accounts = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM account
                        WHERE accountid IN 
                            (SELECT targetaccountid FROM follow
                             WHERE accountid = ?)";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $account = $this->getAccountRow($row);                        
                        $accounts->append($account);
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
            return $accounts;
        }
        
        public function getOneFollowing($accountid, $targetaccountid)
        {
            $account = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM account
                        WHERE accountid IN
                            (SELECT targetaccountid 
                             FROM follow
                             WHERE accountid = ? AND targetaccountid = ?)";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$accountid);
                $stmt ->bindParam(2,$targetaccountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $account = $this->getAccountRow($row);
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
                if (!empty($conn) || $conn != null) 
                {
                        $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $account;
        }
        
        public function getOneFollower($accountid, $targetaccountid)
        {
            $account = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM account
                        WHERE accountid IN
                            (SELECT accountid 
                             FROM follow
                             WHERE accountid = ? AND targetaccountid = ?)";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$targetaccountid);
                $stmt ->bindParam(2,$accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $account = $this->getAccountRow($row);
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
                if (!empty($conn) || $conn != null) 
                {
                        $conn = null;
                }
            }
            catch (PDOException $e)
            {
                echo $e -> getMessage();
            }
            return $account;
        }
        
        
    }
?>