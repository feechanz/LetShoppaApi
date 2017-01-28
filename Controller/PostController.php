<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Post.php";
    require_once "AccountController.php";
    
    class PostController
    {
        public function getPostRow($row)
        {
            $post = new Post();
            $post->setPostid($row['postid']);
            $post->setTanggalpost($row['tanggalpost']);
            $post->setTulisan($row['tulisan']);
            $accountid = $row['accountid'];
            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($accountid);
            $post->setAccountid($accountid);
            $post->setAccount($account);
            $post->setNama($account->getNama());
            $post->setLinkgambaraccount($account->getLinkgambaraccount());
            
            $post->setStatuspost($row['statuspost']);
            return $post;
        }
        
        public function getPostsByAccountid($accountid)
        {
            $posts = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `post`
                        WHERE (accountid IN
                            (SELECT targetaccountid 
                            FROM `follow`
                             WHERE accountid = ?)
                        OR  accountid IN
                            (SELECT accountid 
                            FROM account
                            WHERE premiumaccount >= now())
                        OR accountid = ?)
                        AND statuspost = 1
                        ORDER BY tanggalpost DESC";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $accountid);
                $stmt -> bindParam(2, $accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $post = $this->getPostRow($row);                        
                        $posts->append($post);
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
            return $posts;
        }
        
        public function getPostByPostid($postid)
        {
            $post = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `post`
                        WHERE postid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$postid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $post = $this->getPostRow($row);
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
            return $post;
        }
        
        public function postPost($accountid, $tulisan)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO `post`(accountid, tulisan)
                        VALUES(?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $accountid, PDO::PARAM_STR);
                $stmt -> bindParam(2, $tulisan, PDO::PARAM_STR);
      
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
        
        public function putPost($postid,$tulisan)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE `post`  
                        SET tulisan = ?
                        WHERE postid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $tulisan);
                $stmt -> bindParam(2, $postid);
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
        
        public function deletePost($postid)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE `post`  
                        SET statuspost = 2
                        WHERE postid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $postid);
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