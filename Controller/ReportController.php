<?php
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    require_once "../Model/Report.php";
    
    class ReportController 
    {
        public function getReportRow($row)
        {
            $report = new Report();
            $report ->setJenistokoid($row['jenistokoid']);
            $report ->setNamajenis($row['namajenis']);
            $report ->setStatustotal($row['statustotal']);
            $report ->setStatusincart($row['statusincart']);
            $report ->setStatuswanttobuy($row['statuswanttobuy']);
            $report ->setStatusaccepted($row['statusaccepted']);
            $report ->setStatuscancelled($row['statuscancelled']);
            return $report;
        }
        public function getReportTotalRow($row)
        {
            
        }
        
        public function getReportInCart($row)
        {
            
        }
        
        public function getReportWantToBuy($row)
        {
            
        }
        
        public function getReportAccepted($row)
        {
            
        }
        
        

        public function getReports($begindate, $enddate)
        {
            $reports = new ArrayObject();
            try
            {
                $conn = Koneksi::get_connection();
                $query = "CREATE OR REPLACE VIEW ordertanggal AS
                        SELECT *
                        FROM `order`
                        WHERE tanggalorder between ? and ?";
                $stmt = $conn -> prepare($query);
                $stmt ->bindParam(1,$begindate);
                $stmt ->bindParam(2,$enddate);
                $stmt -> execute();
                
                $query = "SELECT *
                        FROM ViewTotal";
                $stmt = $conn -> prepare($query);
                $stmt -> execute();
                if ($stmt -> rowCount() > 0)
                {
                    while ($row = $stmt -> fetch())
                    {
                        $report = $this->getReportRow($row);                        
                        $reports->append($report);
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
            return $reports;
        }
    }
?>