<?php
    if(isset($_GET['tokoid']) && isset($_GET['begindate']) && isset($_GET['enddate']))
    {
        $tokoid = $_GET['tokoid'];
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
    <h1>Product's Report </h1>
        <p>From <?php echo $begindate." to ".$enddate?></p>
    <table align="center" border = "3">
        <tr>
            <th>Product's Name</th>
            <th>Total Order</th>
        </tr>
    <?php
        require_once "../Controller/ShopprodukreportController.php";
        $reportcontroller = new ShopprodukreportController();
        $iterator = $reportcontroller ->getShopprodukreports($tokoid, $begindate, $enddate)-> getIterator();
        while ($iterator -> valid()) {
            echo " <tr> ";
                echo " <td> ".$iterator -> current()-> getNamaproduk()."</td>";
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
                "caption" => "Chart Total Product Order",
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
        $response = $reportcontroller ->getShopprodukreports($tokoid, $begindate, $enddate)-> getIterator();
        while ($response -> valid()) 
        {
            array_push($arrData["data"], array(
                "label" => $response -> current()-> getNamaproduk(),
                "value" => $response -> current()-> getJumlahorder()
                )
            );
            $response -> next();	
        }
        $jsonEncodedData = json_encode($arrData);

        /*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();
    ?>
        <h1 align="center"> <div id="chart-1"><!-- Fusion Charts will render here--></div><h1>
         
</body>