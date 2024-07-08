<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 15/01/2019
 * Time: 15:09
 */

header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL);
ini_set('display_errors', 'on');
$con=new mysqli("localhost","juriel_rebuy","Forza123!!","juriel_magwork");
$arr=[];
if($con->ping())
{
    $arr['connected']=true;

}else{
    $arr['connected']=false;
}

if($_SERVER['REQUEST_METHOD']==='POST') {

    $arr['imei'] = $_POST['imei'];
    $arr['action']=$_POST['action'];
}else{
    echo "you do not have access to this page";
    $arr['action']=0;
}

if(isset($_POST['action'])){
if($arr['action']=='GET') {
    $imei=$_POST['imei'];
    //$result = $con->query("SELECT * FROM `api` WHERE `xid`=?");
    $sqla = $con->prepare('SELECT * FROM forzaerp_warranty WHERE device_IMEI=?');
    $rsa = $sqla->bind_param('i', $imei);
    $sqla->execute();
    $result = $sqla->get_result();
    $data = [];
    $date=date('Y-m-d');

    if (mysqli_num_rows($result)>0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            if($data[0]['end_date']>$date){
                $data[0]['warranty']='valid';
                $data[0]['response']="This product has a valid warranty. Please click on the link to start an RMA";
                $data[0]['url']="https://www.forza-refurbished.nl/retourneren/";
            }else{
                $data[0]['warranty']='invalid';
                $data[0]['response']="This product does not have a valid warranty. Please click on te link to start a paid repair order";
                $data[0]['url']="https://www.forza-refurbished.nl/reparatiepaid";
            }

        }
        $arr['response'] = $data;


    }else{
        $data=Array(
            'response'=>'Imei not found'
        );
        $arr['response']=$data;
    }

}
}


echo json_encode($arr);