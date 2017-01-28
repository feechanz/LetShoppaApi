<?php
    if(isset($_GET['tokoid']) && isset($_GET['year']))
    {
        $tokoid = $_GET['tokoid'];
        $year = $_GET['year'];
    }
?>

<head>
<script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
<script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.zune.js"></script>

</head>
<body>
    <h1>Order's Report </h1>
        <p>Year <?php echo $year?></p>
    <table align="center" border = "3">
        <tr>
            <th>Year</th>
            <th>Month</th>
            <th>Total Order</th>
        </tr>
    <?php
        require_once "../Controller/ShoporderreportController.php";
        $reportcontroller = new ShoporderreportController();
        $iterator = $reportcontroller ->getShoporderreports($tokoid, $year)-> getIterator();
        while ($iterator -> valid()) {
            echo " <tr> ";
                echo " <td> ".$iterator -> current()-> getYear()."</td>";
                switch($iterator -> current()->getMonth())
                {
                    case 1:
                        echo "<td> January </td>";
                        break;
                    case 2:
                        echo "<td> February </td>";
                        break;
                    case 3:
                        echo "<td> March </td>";
                        break;
                    case 4:
                        echo "<td> April </td>";
                        break;
                    case 5:
                        echo "<td> May </td>";
                        break;
                    case 6:
                        echo "<td> June </td>";
                        break;
                    case 7:
                        echo "<td> July </td>";
                        break;
                    case 8:
                        echo "<td> August </td>";
                        break;
                    case 9:
                        echo "<td> September </td>";
                        break;
                    case 10:
                        echo "<td> October </td>";
                        break;
                    case 11:
                        echo "<td> November </td>";
                        break;
                    default:
                        echo "<td> December </td>";
                        
                }
                echo " <td> ".$iterator -> current()-> getJumlahorder() ." </td> ";
               
            echo "</tr>";
            $iterator -> next();		
        }
    ?>
    </table>

    <?php
        include "fusioncharts.php";
        $arrData = array(
        "chart" => array(
            "caption"=> "Total Order",
            "subCaption"=> "Total order analysis in ".$year,
            "xAxisname"=> "Month",
            "yAxisName"=> "Total Order",
            "numberPrefix"=> "",
            "legendItemFontColor"=> "#666666",
            "theme"=> "zune",
             "defaultAnimation" => "0"
            )
          );
          // creating array for categories object

          $categoryArray=array();
          $dataseries1=array();
          $dataseries2=array();
          $dataseries3=array();

          $response = $reportcontroller ->getShoporderreports($tokoid, $year)-> getIterator();
          // pushing category array values
        while($response -> valid()) 
        {
            
            switch($response -> current()-> getMonth())
            {
                case 1:
                    $month = "January";
                    break;
                case 2:
                    $month = "February";
                    break;
                case 3:
                    $month = "March";
                    break;
                case 4:
                    $month = "April";
                    break;
                case 5:
                    $month = "May";
                    break;
                case 6:
                    $month = "June";
                    break;
                case 7:
                    $month = "July";
                    break;
                case 8:
                    $month = "August";
                    break;
                case 9:
                    $month = "September";
                    break;
                case 10:
                    $month = "October";
                    break;
                case 11:
                    $month = "November";
                    break;
                default:
                    $month = "December";

            }
            
            //$month += $response ->current()->getYear();
            array_push($categoryArray, array(             
                "label" => $month
                )
            );
            array_push($dataseries1, array(
                "value" => $response -> current()-> getJumlahorder()
                )
            );
            $response -> next();
        }

      $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "Total Order", "data"=>$dataseries1));


      /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
      $jsonEncodedData = json_encode($arrData);

      // chart object
      $msChart = new FusionCharts("mscombi2d", "chart1" , "600", "350", "chart-1", "json", $jsonEncodedData);

      $msChart->render();
    ?>
        <h1 align="center"> <div id="chart-1"><!-- Fusion Charts will render here--></div><h1>
         
</body>