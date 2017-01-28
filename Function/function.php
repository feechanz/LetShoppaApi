<?php
function convertArrayToJSON($response)
{
    if(sizeof($response) > 0 )
    {
        $nameclass = get_class($response[0]);
        $result[$nameclass]= array();
        foreach ($response as &$value) 
        {
            array_push($result[$nameclass], $value->serialize());
            
        }
        $result["success"] = 1;
        $result["message"] = "Success";
    }
    else
    {
        $result["success"] = 0;
        $result["message"] = "Not Any Data";
    }
    //print_r($result);
    return json_encode($result,JSON_PRETTY_PRINT);
}

function convertObjectToJSON($response)
{
    if($response )
    {
        $result["account"]= array();

        array_push($result["account"], $response->serialize());
        $result["success"] = 1;
        $result["message"] = "Success";
    }
    else
    {
        $result["success"] = 0;
        $result["message"] = "Not Any Data";
    }
    return json_encode($result,JSON_PRETTY_PRINT);
}
?>