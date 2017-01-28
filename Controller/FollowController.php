<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Follow.php";
    require_once "AccountController.php";
    
    class FollowController
    {
        public function getFollowRow($row)
        {
            $follow = new Follow();
            $follow->setFollowid($row['followid']);
            $follow->setTanggalfollow($row['tanggalfollow']);
                    
            $accountid = $row['accountid'];
            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($accountid);
            
            $follow->setAccountid($accountid);
            $follow->setAccount($account);
            
            $targetaccountid = $row['targetaccountid'];
            $targetaccount = $accountcontroller->getAccountByAccountId($targetaccountid);
            
            $follow->setTargetaccountid($targetaccountid);
            $follow->setTargetaccount($targetaccount);
            
            return $follow;
        }
        
        public function getFollowByFollowId($followid)
        {
            $follow = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM follow
                        WHERE followid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$followid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $follow = $this->getFollowRow($row);
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
            return $follow;
        }
        
        function postFollow($accountid,$targetaccountid)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO follow(accountid,targetaccountid)
                        VALUES(?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $accountid, PDO::PARAM_STR);
                $stmt -> bindParam(2, $targetaccountid, PDO::PARAM_STR);
                      
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
        
        function deleteFollow($accountid, $targetaccountid)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "DELETE FROM `follow`
                        WHERE accountid = ? AND targetaccountid = ?";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $accountid);
                $stmt -> bindParam(2, $targetaccountid);
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