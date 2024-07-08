<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:41
 */
namespace App\Controllers;
use \Core\View;
use App\Models\LogisticsModel;
require '..\vendor\autoload.php';
class Logistics extends \Core\Controller
{
    public function indexAction()
    {


        View::renderTemplate('Logistics/index.html'

        );

    }

    public function ordersAction()
    {
        View::renderTemplate('Logistics/orders.html'

        );
    }

    public function pickAction()
    {
        View::renderTemplate('Logistics/pick.html'

        );
    }

    public function rebuyAction()
    {
        View::renderTemplate('Logistics/rebuy.html'

        );
    }

    public function RMAAction()
    {
        View::renderTemplate('Logistics/RMA.html'

        );
    }

    public function reportsAction()
    {
        View::renderTemplate('Logistics/reports.html'

        );
    }

    public function returnsAction()
    {
        View::renderTemplate('Logistics/reports.html'

        );
    }
}