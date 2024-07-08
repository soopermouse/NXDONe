<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 31/12/2018
 * Time: 11:31
 */

namespace Core;
use App\Models\RebuyModel;

class Offer
{

    public $offer;
    public $order_id;
    public $imei;

    public $offer_type;
    public $newoffer;



    public function __construct($offer,$imei,$order_id,$offer_type)
    {
        $this->offer=$offer;
        $this->order_id=$order_id;
        $this->imei=$imei;

        $this->offer_type=$offer_type;


    }

    public static function makerebuyOrderOffer($order_id, $quote_type, $quote, $accepted)
    {
        $newoffer=RebuyModel::makeRebuyOffer($order_id, $quote_type,$quote,$accepted);
        return $newoffer;

    }

    public static function makeRebuyDeviceOffer($quote,$imei,$order_id,$offer_type)
    {
        $newoffer=RebuyModel::makeRebuyOffer($order_id, $quote_type,$quote,$accepted);
        return $newoffer;

    }

}
