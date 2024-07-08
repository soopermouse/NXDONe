<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:28
 */
namespace App\Controllers;
use \Core\View;
use App\Models\SalesModel;
use App\Models\RebuyModel;
require '..\vendor\autoload.php';

class Sales extends \Core\Controller
{
    public function indexAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/index.html'
            //['results'=>$results]
        );

    }
    public function reportsAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/reports.html'
        //['results'=>$results]
        );

    }
    public function businessAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/business.html'
        //['results'=>$results]
        );

    }
    public function calendarAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/calendar.html'
        //['results'=>$results]
        );

    }
    public function infoAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/info.html'
        //['results'=>$results]
        );

    }
    public function leadsAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/leads.html'
        //['results'=>$results]
        );

    }
    public function rebuyAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/rebuy.html'
        //['results'=>$results]
        );

    }

    public function resellersAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/resellers.html'
        //['results'=>$results]
        );

    }

    public function salestagsAction()
    {

        $results = RebuyModel::getOrders();
        View::renderTemplate('Sales/salestags.html',
        ['results'=>$results]
        );

    }
}