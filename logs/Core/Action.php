<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 29/11/2018
 * Time: 16:43
 */

namespace Core;
abstract class Action
{
    public static function setAction()
    {


    }


    public static function setActionButton($action_id)
    {


        switch($action_id)
        {
            case 2:
                $button="check";
                $link="{{result.order_id}}/check";
                break;
            case 6:
                $button="Inspection";
                $link="{{result.order_id}}/inspect";
                break;
                //finish with appropriate  links/buttons
            case 7:
                $button="Quote";
                $link="{{result.order_id}}/quote";
                break;

            case 8:
                $button="Send Offer";
                $link="{{result.order_id}}/sendmail";
                break;

            case 9:
                $button="Send for Payment";
                $link="{{result.order_id}}/pay";
                break;

            case 10:
                $button="Send Second Offer";
                $link="";
                break;
        }


        $response=array($button,$link);
        return $response;



    }


}