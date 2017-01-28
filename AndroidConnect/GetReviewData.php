<?php
    header('Content-type:application/json');
    require_once "../Connection/config.php";
    require_once "../Connection/koneksi.php";
    
    //$_POST['tokoid']=1;
    $tokoid="";
    if(isset($_POST['tokoid']))
    {
		$tokoid=$_POST['tokoid'];
        $query = "SELECT COALESCE(ROUND(SUM(pointreview)/COUNT(reviewid),1),0) AS score, COUNT(reviewid) AS jumlah
                  FROM review
                  WHERE tokoid=$tokoid";
        $hasil = mysql_query($query);
		
		$result["success"]=0;
		while($row = mysql_fetch_array($hasil))
		{
			$result['score']=$row['score'];
			$result['jumlah']=$row['jumlah'];
			$result["success"]=1;
			$result["message"]="Success";
		} 
		
		
    }
    else
    {
        $result['score']=0;
        $result['jumlah']=0;
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>