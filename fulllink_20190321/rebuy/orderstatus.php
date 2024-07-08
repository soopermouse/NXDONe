<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 17/09/2018
 * Time: 16:16
 */


$sql="(SELECT * FROM `rebuyplus_order_status` WHERE `customer_order_status`!=2;)";
$results=mysqli_query($connection, $sql);
foreach($results as $result)
{



}

$records = array();
$result = $db->query("SELECT * FROM data");
if($result->num_rows){
    while ($row = $result->fetch_object()) {
        $records[] = $row;
        foreach($records as $r);
    }
}