<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 27/09/2018
 * Time: 11:36
 */

namespace App\Models;
use PDO;

class FinanceModel extends \Core\Model
{

    public static function getData()

   {
       try{
           $db=static::getDB();
           //$stmt=$db->query(' ')

           //$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
           //return $results;
       }
       catch (\PDOException $e)
       {
           echo $e->getMessage();
       }

   }

   public static function createPaymentData($customer_id,$order_id,$IBAN, $tnv)
   {

           try{
               $db=static::getDB();
               $stmt=$db->prepare('INSERT INTO forzaerp_rebuy_customer_payment (`cust_id`,`order_id`,`cust_iban`,`cust_tnv`) VALUES(?,?,?,?)');

               $stmt->execute([$customer_id,$order_id,$IBAN, $tnv
               ]);
                $message="payment data created";
                return $message;

           }
           catch (\PDOException $e)
           {
               echo $e->getMessage();
           }


   }
    public static function createRebuyPayment($order_id,$customer_id,$offer,$customer_payment_type)
    {
        try{
            $db=static::getDB();
            $stmt=$db->prepare('INSERT INTO forzaerp_rebuy_customer_payment (`cust_id`,`order_id`,`offer`,`customer_payment_type`) VALUES(?,?,?,?)');

            $stmt->execute([$customer_id,$order_id,$offer, $customer_payment_type
            ]);
            $message="payment data created";
            return $message;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }


}