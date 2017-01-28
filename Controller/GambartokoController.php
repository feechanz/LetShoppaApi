<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Gambartoko.php";
    
    class GambartokoController
    {
        public function getGambartokoRow($row)
        {
            $gambartoko = new Gambartoko();
            $gambartoko->setGambartokoid($row['gambartokoid']);
            $gambartoko->setLinkgambartoko($row['linkgambartoko']);
            $gambartoko->setTokoid($row['tokoid']);
            
            return $gambartoko;
        }
        
        public function getGambartokoByGambartokoid($gambartokoid)
        {
            $gambartoko = null;
            try
            {
                $conn = Koneksi::get_connection();
                $query = "SELECT *
                        FROM gambartoko
                        WHERE gambartokoid = ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$gambartokoid);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $gambartoko = $this->getGambartokoRow($row);
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
            return $gambartoko;
        }
    }
?>