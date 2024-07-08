<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:59
 */
namespace App\Models;
use PDO;

class OrderModel extends \Core\Model
{



    public static function createRebuyOrder($customer_id, $payment_type_id)
    {
        $date = date('Y-m-d');
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_rebuy_order (`customer_id`,`order_date`,`payment_type_id`) 
            VALUES (?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$customer_id,$date,$payment_type_id
            ]);
            $stmt = null;
            $order_id = $db->lastInsertId();
            $message="Order Created";
            return $order_id;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }




    }

    public static function createSaleOrder($customer_id,$payment_type_id,$deviceprice)
    {
        $date = date('Y-m-d');
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_sales_order (`customer_id`,`order_date`,`payment_type_id`, `device_price`) 
            VALUES (?,?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$customer_id,$date,$payment_type_id,$deviceprice
            ]);
            $stmt = null;
            $order_id = $db->lastInsertId();
            $message="Order Created";
            return $order_id;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function createShippingLabel($order_id)
    {
        try {
            $db = static::getDB();
            $stmt =$db->prepare( "SELECT * FROM `forzaerp_sales_order` as r
            JOIN `forzaerp_customer` as c on r.customer_id=c.customer_id
            JOIN `forzaerp_customer_address` as a on c.customer_id=a.customer_id
            WHERE r.order_id=?
            ");
            $stmt->execute(['$order_id']);
            $results = $stmt->fetch();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

        public static function createWarranty($order_id)
        {
            $order_date=date('Y/m/d' );
            $end_date = date('Y-m-d', strtotime('+2 years', strtotime($order_date)));
            try {
                $db = static::getDB();
                $sql = "INSERT INTO
            forzaerp_warranty (`order_id`,`start_date`,`end_date`) 
            VALUES (?,?,?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$order_id, $order_date, $end_date
                ]);
                $stmt = null;
                $order_id ="Warranty Created";
                return $order_id;

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }

        }

        public static function CreateOrderDevice($order_id,$device_type_id,$device_storage_id,$device_condition_id,$device_connection_id,$device_colour_id)
        {
            try {
                $db = static::getDB();
                $sql = "INSERT INTO
            forzaerp_sales_order_device (`order_id`,`device_type_id`,`device_storage_id`,`device_grade`,`device_connection_id`,`device_colour_id`) 
            VALUES (?,?,?,?,?,?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$order_id,$device_type_id,$device_storage_id,$device_condition_id,$device_connection_id,$device_colour_id
                ]);
                $stmt = null;
                $order_id ="Device Created";
                return $order_id;

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }



        }


        public static function setIMEI($order_id,$imei)
        {
            try {
                $db = static::getDB();
                $sql = "INSERT INTO
            forzaerp_sales_order_device_imei (`order_id`,`device_imei`) 
            VALUES (?,?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$order_id,$imei
                ]);
               // $stmt = null;
                $message="Orders picked";
                return $message;


            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


        }

    public static function getSaleOrdersbyCustomertype($customer_type)
{
    try {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM forzaerp_sales_order AS r 
             JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id
             JOIN forzaerp_retail_payment_type as p on r.payment_type_id=p.payment_type_id
            JOIN forzaerp_sales_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
             JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            
           JOIN forzaerp_sales_order_status as f on r.order_id=f.order_id
            JOIN forzaerp_sales_order_status_type as o on f.order_status=o.status_id
            JOIN forzaerp_sales_order_state_type as l on f.order_state=l.state_id
            JOIN forzaerp_internal_shipping_status_type as w on f.internal_shipping_status=w.status_id
            JOIN forzaerp_customer_shipping_status_type as v on f.customer_shipping_status=v.status_id
            WHERE r.customer_type=? ORDER BY r.order_date 
            ');
        $stmt->execute([$customer_type
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }


}

    public static function getSaleOrders()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_sales_order AS r 
             JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id
             JOIN forzaerp_retail_payment_type as p on r.payment_type_id=p.payment_type_id
            JOIN forzaerp_sales_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
             JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            
           JOIN forzaerp_sales_order_status as f on r.order_id=f.order_id
            JOIN forzaerp_sales_order_status_type as o on f.order_status=o.status_id
            JOIN forzaerp_sales_order_state_type as l on f.order_state=l.state_id
            JOIN forzaerp_internal_shipping_status_type as w on f.internal_shipping_status=w.status_id
            JOIN forzaerp_customer_shipping_status_type as v on f.customer_shipping_status=v.status_id
            ORDER BY r.order_date 
            ');

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }


    public static function getSaleOrder($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_sales_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_sales_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
           
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            
           WHERE r.order_id=?');
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updateWarrantyImei($order_id,$imei)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_warranty SET `device_imei` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$imei,$order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function makeStatus($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            `forzaerp_sales_order_status` (`order_id`,`order_status`,`order_state`,`internal_shipping_status`,`customer_shipping_status`) 
            VALUES (?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, 4, 1, 1,1]);
            $stmt = null;

            $message = "New Order Status Created";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

           public static function getPickOrders()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_sales_order AS r 
             JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_sales_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
             JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            
           
           JOIN forzaerp_sales_order_status as f on r.order_id=f.order_id
            JOIN forzaerp_sales_order_status_type as o on f.order_status=o.status_id
           
            WHERE  f.order_status=4');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updateOrderStatus($status, $order_id)
    {
        try {
            $db = static::getDB();

            $sql = "UPDATE forzaerp_sales_order_status SET `order_status` = ? WHERE `order_id` = ?";

            $db->prepare($sql)->execute([$status, $order_id]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function updateShippingStatus($istatus, $cstatus,$order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_sales_order_status SET `internal_shipping_status` = ?, `customer_shipping_status`=? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$istatus,$cstatus, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function setOrderStatusForRMATesting($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE `forzaerp_sales_order_status` SET `order_status`=9,`order_state`=5,`internal_shipping_status`=13,`customer_shipping_status`=13 WHERE `order_id`=?";
            $db->prepare($sql)->execute([ $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function makeRMAOrder($customer_id,$date,$device_imei)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            `forzaerp_rma_order` (`customer_id`,`rma_date`,`imei`) 
            VALUES (?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$customer_id,$date,$device_imei]);
            //$stmt = null;

            $rma_id = $db->lastInsertId();
            return $rma_id;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }


    public static function makeSupplierOrder($customer_id)
    {
        try {
            $db = static::getDB();
            $date=date('Y-m-d');
            $sql = "INSERT INTO
            `forzaerp_supplier_order` (`supplier_id`,`order_date`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$customer_id,$date]);
            //$stmt = null;

            $order_id = $db->lastInsertId();
            return $order_id;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function addDeviceToSupplierOrder($order_id,$rebuy_id,$device_model,$quantity)
    {
        $date = date('Y-m-d');
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_supplier_order_device (`order_id`,`rebuy_order_id`,`device_model_id`,`device_quantity`) 
            VALUES (?,?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$order_id,$rebuy_id,$device_model,$quantity]);
            //$stmt = null;
            $order_id = $db->lastInsertId();
            //$message="Order Created";
            return $order_id;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }




    }

    public static function makeReturnOrder($order_id,$imei)
    {
        $date = date('Y-m-d');
        try{
            $db=static::getDB();
            $stmt=$db->prepare( "INSERT into
            forzaerp_return_orders (`order_id`,`device_imei`,`return_date`) VALUES (?,?,?)");

            $stmt->execute([$order_id,$imei,$date]);
            //$stmt = null;
            $order_id = $db->lastInsertId();
            //$message="Order Created";
            return $order_id;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function updateRebuyDevice($order_id,$IMEI)
    {
        try {
            $db = static::getDB();
            $stmt=$db->prepare("UPDATE `forzaerp_rebuy_order_device` SET `device_imei`=? WHERE `order_id`=?");
            $stmt->execute([ $IMEI,$order_id]);
            $message=$order_id." successfully updated";
            return $message;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function addDeviceToRebuyOrder($order_id,$device_model,$device_storage,$device_grade,$device_quote,$quantity)
    {
        try{
            $db=static::getDB();
            $stmt=$db->prepare("INSERT into
            forzaerp_rebuy_order_devices (`order_id`,`device_model`,`device_storage`,`device_grade`,`device_quote`,`device_quantity`) 
            VALUES (?,?,?,?,?,?)");

            $stmt->execute([$order_id,$device_model,$device_storage,$device_grade,$device_quote,$quantity]);
            //$stmt = null;
            $order_id = $db->lastInsertId();
            //$message="Order Created";
            return $order_id;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }




    }


    public static function makeRebuyDevices($order_id,$device_model,$device_storage,$device_grade,$device_quote)
    {
        try{
            $db=static::getDB();
            $stmt=$db->prepare("INSERT into
            forzaerp_rebuy_order_devices (`order_id`,`device_model`,`device_storage`,`device_grade`,`device_quote`,`device_quantity`) 
            VALUES (?,?,?,?,?,?)");

            $stmt->execute([$order_id,$device_model,$device_storage,$device_grade,$device_quote,$quantity]);
            //$stmt = null;
            $order_id = $db->lastInsertId();
            //$message="Order Created";
            return $order_id;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }




    }


}

