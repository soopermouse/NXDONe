<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 29/09/2018
 * Time: 08:08
 */
namespace App\Controllers\Admin;
class Dashboard extends \Core\Controller


{

    /**
     * @return void
     */
    protected function before()
    {


    }

    /**
     * @return void
     */
    public function indexAction()
    {

        echo 'Admin Index';
    }


}