<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:57
 */

namespace App\Controllers;
use \Core\View;
use App\Models\FinanceModel;
require '..\vendor\autoload.php';

class Finance extends \Core\Controller
{
    public function indexAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/index.html'
            //['results'=>$results]
        );
    }

    public function rebuyAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/rebuy.html'
        //['results'=>$results]
        );
    }

    public function rebuypendingAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/rebuy.html'
        //['results'=>$results]
        );
    }


    public function rebuyauthorizeAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/rebuyauthorize.html'
        //['results'=>$results]
        );
    }

    public function authorizeAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/authorize.html'
        //['results'=>$results]
        );
    }

    public function businessaccountsAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/businessaccounts.html'
        //['results'=>$results]
        );
    }

    public function businessordersAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/businessorders.html'
        //['results'=>$results]
        );
    }

    public function commissionsAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/commissions.html'
        //['results'=>$results]
        );
    }

    public function completedAction()
    {
    //$results=RebuyModel::getOrders();
    View::renderTemplate('Finance/comipleted.html'
    //['results'=>$results]
    );
    }

    public function forzacreditAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/forzacredit.html'
        //['results'=>$results]
        );
    }

    public function invoicesAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/invoices.html'
        //['results'=>$results]
        );
    }

    public function ordersAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/orders.html'
        //['results'=>$results]
        );
    }

    public function paymentsAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/payments.html'
        //['results'=>$results]
        );
    }

    public function reportsAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/reports.html'
        //['results'=>$results]
        );
    }

    public function reselleraccountsAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/reselleraccounts.html'
        //['results'=>$results]
        );
    }

    public function resellerordersAction()
    {
    //$results=RebuyModel::getOrders();
    View::renderTemplate('Finance/resellerorders.html'
    //['results'=>$results]
    );
    }

    public function suppliersAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/suppliers.html'
        //['results'=>$results]
        );
    }









}