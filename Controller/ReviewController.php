<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Review.php";
    require_once "TokoController.php";
    require_once "AccountController.php";
    
    class ReviewController
    {
        public function getReviewRow($row)
        {
            $review = new Review();
            $review ->setReviewid($row['reviewid']);
            $review ->setIsireview($row['isireview']);
            $review ->setStatusreview($row['statusreview']);
            
            $tokoid = $row['tokoid'];
            $tokocontroller = new TokoController();
            $toko = $tokocontroller->getTokoByTokoId($tokoid);
            
            $review ->setTokoid($tokoid);
            $review ->setToko($toko);
            
            $accountid = $row['accountid'];
            $accountcontroller = new AccountController();
            $account = $accountcontroller->getAccountByAccountId($accountid);
            
            $review ->setAccountid($accountid);
            $review ->setAccount($account);
            
            $review ->setTanggalreview($row['tanggalreview']);
            $review ->setPointreview($row['pointreview']);
            
            $review ->setNama($account->getNama());
            return $review;
        }
              
        
        public function getReviewsByTokoIdExAccountId($tokoid,$accountid)
        {
            $reviews = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `review`
                        WHERE tokoid = ? AND
                              accountid != ?
                        ORDER BY tanggalreview DESC";
                $stmt = $conn -> prepare($query);
                $stmt -> bindParam(1, $tokoid);
                $stmt -> bindParam(2, $accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $review = $this->getReviewRow($row);                        
                        $reviews->append($review);
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
            return $reviews;
        }
        
        public function getReviewByReviewId($reviewid)
        {
            $review = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `review`
                        WHERE reviewid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$reviewid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $review = $this->getReviewRow($row);
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
            return $review;
        }
        
        public function getReviewByTokoIdAccountId($tokoid,$accountid)
        {
            $review = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM `review`
                        WHERE tokoid = ? AND accountid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$tokoid);
                $stmt ->bindParam(2,$accountid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $review = $this->getReviewRow($row);
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
            return $review;
        }
        
        public function postReview($accountid, $tokoid, $isireview, $pointreview)
        {
            $result = FALSE;
            try
            {
                $conn = Koneksi::get_connection();
                $sql = "INSERT INTO `review`(accountid, tokoid, isireview, pointreview)
                        VALUES(?,?,?,?)";
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $accountid, PDO::PARAM_STR);
                $stmt -> bindParam(2, $tokoid, PDO::PARAM_STR);
                $stmt -> bindParam(3, $isireview, PDO::PARAM_STR);
                $stmt -> bindParam(4, $pointreview, PDO::PARAM_STR);
      
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
        
        public function putReview($accountid, $tokoid, $isireview, $pointreview)
        {
            $result = FALSE;
            try 
            {
                $conn = Koneksi::get_connection();
                $sql = "UPDATE `review`  
                        SET isireview = ?,
                            pointreview =?
                        WHERE accountid = ? AND tokoid = ?";
                
                $conn -> beginTransaction();
                $stmt = $conn -> prepare($sql);
                $stmt -> bindParam(1, $isireview);
                $stmt -> bindParam(2, $pointreview);
                $stmt -> bindParam(3, $accountid);
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
    }

?>