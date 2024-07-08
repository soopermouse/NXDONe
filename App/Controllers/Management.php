<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 10/04/2019
 * Time: 12:16
 */

namespace App\Controllers;
use \Core\View;
require '..\vendor\autoload.php';

class Management extends \Core\Controller
{
    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }


    public function indexAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/index.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function RebuyAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/rebuy.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function RMAAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/RMA.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function ReturnsAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/returns.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function InventoryAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/Inventory.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function LogisticsAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/logistics.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function SuppliersAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/suppliers.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function OrdersAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/orders.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function SalesAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/sales.html'
        //, [
        // 'results' => $results
        // ]
        );

    }

    public function FinanceAction()
    {

        // $results = CustomerModel::getCustomers();
        View::renderTemplate('Management/finance.html'
        //, [
        // 'results' => $results
        // ]
        );

    }


}