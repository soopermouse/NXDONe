<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 24/09/2018
 * Time: 14:56
 */
namespace Core;
use App\Models\OrderModel;
use \Core\Customer;
class Order
{





    public function __construct()
    {







    }

    public function makeCustomer($customer_first_name, $customer_last_name,$customer_email,$customer_postcode, $customer_street_number,$customer_addition, $customer_street_name,$customer_city,$customer_country)
    {
        $customer=new Customer($customer_first_name, $customer_last_name,$customer_email,$customer_postcode, $customer_street_number,$customer_addition, $customer_street_name,$customer_city,$customer_country);
        $this->customer_id=$customer->createCustomer();
        return $this->customer_id;



    }

    public function createOrder($customer_id,$payment_type)
    {
        $order_id=OrderModel::createRebuyOrder($customer_id,$payment_type);
        return $order_id;

    }

    public function getTotal()
    {

    }

    public function AddDeviceToOrder($device_type,$device_storage,$device_connection,$device_condition,$device_price)
    {
        $device=new Device($device_type,$device_storage,$device_connection,$device_condition,$device_price);
        return $device;


    }
















}