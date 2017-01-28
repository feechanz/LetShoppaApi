<?php
    if(isset($_GET['begindate']) && isset($_GET['enddate']))
    {
        $begindate = $_GET['begindate'];
        $enddate = $_GET['enddate'];
    }
?>

<head>
<script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
<script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.zune.js"></script>

</head>
<body>
    <h1>Report </h1>
        <p>From <?php echo $begindate." to ".$enddate?></p>
    <table align="center" border = "3">
        <tr>
            <th>Category Name</th>
            <th>Status Total</th>
            <th>Status In Cart</th>
            <th>Status Want to Buy</th>
            <th>Status Purchased</th>
            <th>Status Cancelled</th>
        </tr>
    <?php
        require_once "../Controller/ReportController.php";
        $reportcontroller = new ReportController();
        $iterator = $reportcontroller ->getReports($begindate, $enddate)-> getIterator();
        while ($iterator -> valid()) {
            echo " <tr> ";
                echo " <td> ".$iterator -> current()-> getNamajenis()."</td>";
                echo " <td> ".$iterator -> current()-> getStatustotal() ." </td> ";
                echo " <td> ".$iterator -> current()-> getStatusincart()." </td> ";
                echo " <td> ".$iterator -> current()-> getStatuswanttobuy()." </td> ";
                echo " <td> ".$iterator -> current()-> getStatusaccepted()." </td> ";
                echo " <td> ".$iterator -> current()-> getStatuscancelled()." </td> ";
            echo "</tr>";
            $iterator -> next();		
        }
    ?>
    </table>

    <?php
        include "fusioncharts.php";
        $arrData = array(
            "chart" => array(
                "caption" => "Chart Total Order",
                "paletteColors" => "#0075c2",
                "bgColor" => "#ffffff",
                "borderAlpha"=> "20",
                "canvasBorderAlpha"=> "0",
                "usePlotGradientColor"=> "0",
                "plotBorderAlpha"=> "10",
                "showXAxisLine"=> "1",
                "xAxisLineColor" => "#999999",
                "showValues"=> "0",
                "divlineColor" => "#999999",
                "divLineIsDashed" => "1",
                "showAlternateHGridColor" => "0",
                "defaultAnimation" => "0"
            )
        );
        $arrData["data"] = array();
        $response = $reportcontroller ->getReports($begindate, $enddate)-> getIterator();
        while ($response -> valid()) 
        {
            array_push($arrData["data"], array(
                "label" => $response -> current()-> getNamajenis(),
                "value" => $response -> current()-> getStatustotal()
                )
            );
            $response -> next();	
        }
        $jsonEncodedData = json_encode($arrData);

        /*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();
        
        
        $arrData = array(
        "chart" => array(
            "caption"=> "Status Order",
            "subCaption"=> "Status order analysis",
            "xAxisname"=> "Month",
            "yAxisName"=> "Revenues (In USD)",
            "numberPrefix"=> "$",
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

          $response = $reportcontroller ->getReports($begindate, $enddate)-> getIterator();
          // pushing category array values
        while($response -> valid()) 
        {
            array_push($categoryArray, array(
                "label" => $response -> current()-> getNamajenis()
                )
            );
            array_push($dataseries1, array(
                "value" => $response -> current()-> getStatusincart()
                )
            );

            array_push($dataseries2, array(
                "value" => $response -> current()-> getStatuswanttobuy()
                )
            );
            array_push($dataseries3, array(
                "value" => $response -> current()-> getStatusaccepted()
                )
            );
            $response -> next();
        }

      $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "Status in Cart", "data"=>$dataseries1), array("seriesName"=> "Status Want to Buy",  "renderAs"=>"line", "data"=>$dataseries2),array("seriesName"=> "Status Purchased",  "renderAs"=>"area", "data"=>$dataseries3));


      /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
      $jsonEncodedData = json_encode($arrData);

      // chart object
      $msChart = new FusionCharts("mscombi2d", "chart1" , "600", "350", "chart-container", "json", $jsonEncodedData);

      $msChart->render();
    ?>
        <h1 align="center"> <div id="chart-1"><!-- Fusion Charts will render here--></div><h1>
                
        <center>
            <div id="chart-container">Chart will render here!</div>
        </center>
</body>