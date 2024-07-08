<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 18/09/2018
 * Time: 16:22
 */

class Action
{
    public $orderid;
    public $action;
    public $message;


    public function __construct($orderid,$action)
    {
        $this->orderid=$orderid;
        $this->action=$action;


    }

    public function updateAction()
    {
        $update=new Connection->update('rebuyplus_order_status',$this->orderid,$this->action);
        if($update->num_rows==1)
        {
            $this->message="the next Action has been updated'"

        }


    }

}
