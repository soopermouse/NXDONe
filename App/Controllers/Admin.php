<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 16/02/2019
 * Time: 02:41
 */
namespace App\Controllers;
use \Core\View;
use \Core\Rebuy;
use \Core\Order;
use App\Models\RebuyModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '..\vendor\autoload.php';


class Admin extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate('Admin/index.html');
    }

}