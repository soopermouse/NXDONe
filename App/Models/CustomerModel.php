<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 18/10/2018
 * Time: 17:04
 */

namespace App\Models;
use PDO;

class CustomerModel extends \Core\Model
{
   public $customer_id;

    public static function getRebuyCustomerData($order_id)
    {
        try{
            $db=static::getDB();

            $stmt = $db->prepare("SELECT * FROM forzaerp_customer as c
            JOIN forzaerp_rebuy_order as r on r.customer_id=c.customer_id
            JOIN forzaerp_rebuy_customer_payment as p on c.customer_id=p.cust_id
            JOIN forzaerp_rebuy_payment_types  as t on r.payment_type_id=t.payment_type_id
            JOIN forzaerp_customer_address as a on c.customer_id=a.customer_id
            WHERE r.order_id=?
            ");

            $stmt->execute([$order_id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function getRetailCustomerData($order_id)
    {
        try{
            $db=static::getDB();

            $stmt = $db->prepare('SELECT * FROM forzaerp_customer as c
            JOIN forzaerp_sales_order as r on r.customer_id=c.customer_id
            JOIN forzaerp_retail_customer_payment as p on c.customer_id=p.customer_id
            JOIN forzaerp_retail_payment_type  as t on r.payment_type_id=t.payment_type_id
            JOIN forzaerp_customer_address as a on c.customer_id=a.customer_id
            WHERE r.order_id=?');

            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function getRMACustomerData($order_id)
    {
        try{
            $db=static::getDB();

            $stmt = $db->prepare("SELECT * FROM forzaerp_customer as c
            JOIN forzaerp_rma_order as r on r.customer_id=c.customer_id
            JOIN forzaerp_customer_address as a on c.customer_id=a.customer_id
            WHERE r.rma_id=?
            ");

            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }


    public static function createCustomer($firstname, $lastname, $email,$phone, $customer_type)
    {
        try{
            $db=static::getDB();
            $stmt = $db->prepare("INSERT INTO forzaerp_customer (`customer_first_name`,`customer_last_name`,`customer_email`,`customer_phone_no`,`customer_type`) VALUES(?,?,?,?,?)
            ");

            $stmt->execute([
                $firstname,
                $lastname,
                $email,
                $phone,
                $customer_type]);
           // $stmt = null;
            $id = $db->lastInsertId();
           // $message="Customer created!!";
            return $id;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }



    }

    public static function createAddress($customer_id,$customer_post_code,$customer_street_number,$customer_addition,$customer_street_name,$customer_city,$customer_country )
    {

        try{
            $db=static::getDB();
            $stmt = $db->prepare("INSERT INTO forzaerp_customer_address
        (`customer_id`,`postcode`,`street_no`,`addition`,`street_name`,`city`,`country`) VALUES(?,?,?,?,?,?,?)
            ");

            $stmt->execute([
                $customer_id,$customer_post_code,$customer_street_number,$customer_addition,$customer_street_name,$customer_city,$customer_country
                ]);
            // $stmt = null;
            //$id = $db->lastInsertId();
            $message="Address created!!";
            //echo $id;
            return $message;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }
    
    public static function getContactDetails($customer_id)
    {
        
        
        
        
    }

    public static function getAddress($customer_id)
    {
        try{
            $db=static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_customer as c 
            JOIN forzaerp_customer_address as a on c.customer_id=a.customer_id WHERE c.customer_id=?");

            $stmt->execute([$customer_id]);
            $results = $stmt->fetchAll();
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function getCustomerData($first_name,$last_name)
    {
        try{
            $db=static::getDB();

            $stmt = $db->prepare("SELECT * FROM forzaerp_customer as c
            
            JOIN forzaerp_customer_address as a on c.customer_id=a.customer_id
            WHERE c.customer_first_name=? AND customer_last_name=?
            ");

            $stmt->execute([$first_name,$last_name]);
            $results = $stmt->fetchAll();
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function editCustomerData($first_name,$last_name,$customer_id)
    {
        try{
            $db=static::getDB();

            $stmt = $db->prepare("UPDATE forzaerp_customer SET `customer_first_name`=?, `customer_last_name`=?
            WHERE customer_id=?
            ");

            $stmt->execute([$first_name,$last_name,$customer_id]);
            $id = $db->lastInsertId();

            return $id;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }






}