<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 25/09/2018
 * Time: 11:16
 */
namespace App\Controllers\Admin;

class Users extends \Core\Controller


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

        echo 'user admin index';
    }


}