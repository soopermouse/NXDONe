<?php
/**
 * Created by PhpStorm.
 * User: darke
 * Date: 31/10/2018
 * Time: 20:04
 */

namespace App\Controllers;
use App\Models\DeviceModel;
use \Core\View;
use \Core\Customer;
use \Core\Order;
use App\Models\RMAModel;

require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';
class RMA extends \Core\Controller
{
    public function indexAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/index.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function checkAction()
    {
        //$results = RMAModel::getOrders();
        View::renderTemplate('RMA/check.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function reportsAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/reports.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function inspectionAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/inspection.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function repairAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/repair.html'
        //, [
        //'results' => $results
        //]
        );

    }



    public function inventoryAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/inventory.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function mailAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/newmail.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function checkIMEIAction()
    {

            $imei = $_POST['imei'];
           $count=RMAModel::checkMEI($imei);
           if($count!=0) {
               $results = RMAModel::getWarranty($imei);
               View::renderTemplate('RMA/checkIMEI.html'
                   , [
                       'results' => $results]
               );
           }else{
               View::renderTemplate('RMA/checkfailed.html');
           }




    }

    public function historyAction()
    {
        $results=DeviceModel::getHistory($imei);
        View::renderTemplate('RMA/history.html'
        , [
        'results' => $results
        ]
        );

    }


    public function stepsAction()
{
    View::renderTemplate('RMA/steps.html'
    //, [
    //'results' => $results
    //]
    );

}

    public function testorderAction()
    {
        View::renderTemplate('RMA/testorder.html'
        //, [
        //'results' => $results
        //]
        );

    }






}