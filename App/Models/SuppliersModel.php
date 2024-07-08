<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 24/02/2019
 * Time: 21:41
 */

namespace App\Models;
use PDO;

class SuppliersModel extends \Core\Model
{


    public static function createSupplier($supplier)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_suppliers (`supplier_codename`) 
            VALUES (?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$supplier]);
            $id = $db->lastInsertId();
            // $message="Customer created!!";
            return $id;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function createSupplierOrder($supplier_id,$order_date)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_supplier_order (`supplier_id`,`order_date`)
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$supplier_id,$order_date]);
            $id = $db->lastInsertId();
            // $message="Customer created!!";
            return $id;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getSupplyOrders()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_supplier_order AS r 
             JOIN forzaerp_suppliers AS c ON r.supplier_id=c.supplier_id 
            JOIN forzaerp_supplier_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_model_id=t.device_id
             ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getSupplyOrdersByStatus($status)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_supplier_order AS r 
            JOIN forzaerp_suppliers AS c ON r.supplier_id=c.supplier_id 
            JOIN forzaerp_supplier_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS m ON d.device_model_id=m.device_id
             JOIN forzaerp_supply_order_status as s on r.order_id=s.order_id
             JOIN forzaerp_supply_order_status_types as t on t.status_id=s.status_id
             JOIN forzaerp_supply_action_types as a on a.action_type=s.action_id
             WHERE s.status_id=?');
            $stmt->execute([$status]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getSupplyOrder($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_supplier_order AS r 
             JOIN forzaerp_suppliers AS c ON r.supplier_id=c.supplier_id 
            JOIN forzaerp_supplier_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_model_id=t.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage_id=storage_type_id
            JOIN forzaerp_connection_type as l on l.connection_type_id=d.device_connection
            JOIN forzaerp_device_colour as u on u.colour_id=d.device_colour_id
            WHERE r.order_id=?
             ');
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getRebuyId($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT `rebuy_order_id` FROM forzaerp_supplier_order_device 
            WHERE order_id=?
             ');
            $stmt->execute([$order_id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getInspection()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_supplier_order as r 
            JOIN forzaerp_supply_order_device as d ON r.order_id=d.order_id
            JOIN forzaerp_device_model as t ON d.device_type_id=t.device_id
            
            JOIN forzaerp_device_status as s on s.device_imei=d.device_imei
            JOIN forzaerp_device_status_types as y on s.device_status=y.status_id
            JOIN forzaerp_connection_type as a on d.device_connection_id=a.connection_type_id
            JOIN forzaerp_device_action_types as f on s.next_action=f.action_id
           /* JOIN forzaerp_rebuy_action_buttons as b on b.action_id=f.action_id*/
            WHERE s.device_status=1");

            //$stmt->execute([4]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getSupplyDevices($status)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_supplier_order AS r 
            JOIN forzaerp_supply_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_status as f on f.device_imei=d.device_imei
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage_id=storage_type_id
            JOIN forzaerp_device_status_types as p on f.device_status=p.status_id
            JOIN forzaerp_device_action_types as a on f.next_action=a.action_id
            
            WHERE f.device_status=?
             ');
            $stmt->execute([$status]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getSupplyOrderId($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT `order_id` FROM  forzaerp_supply_order_device 
            WHERE device_imei=?
             ');
            $stmt->execute([$imei]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['order_id'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function InspectSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments,$date,$imei)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_supply_inspection (`order_id`,`device_type`,`device_storage`,`device_connection`,`device_condition`,`device_colour`,`device_comments`,`date`,`IMEI`) 
            VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments,$date,$imei

            ]);
            $id=$db->lastInsertId();

            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getSupplyDevice($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_supplier_order AS r 
            JOIN forzaerp_supply_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_status as f on f.device_imei=d.device_imei
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage_id=storage_type_id
            JOIN forzaerp_device_status_types as p on f.device_status=p.status_id
            JOIN forzaerp_device_action_types as a on f.next_action=a.action_id
            
            WHERE d.device_imei=?
             ');
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getDeviceOrderStatus($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_supplier_order AS r 
            JOIN forzaerp_supply_order_device as o on o.order_id=r.order_id
            JOIN forzaerp_device_model AS t ON o.device_type_id=t.device_id
            JOIN forzaerp_device_grade AS i ON o.device_condition_id=i.grade_id
            JOIN forzaerp_connection_type AS c ON o.device_connection_id=c.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON o.device_storage_id=s.storage_type_id
            JOIN forzaerp_device_colour AS a ON o.device_colour_id=a.colour_id
            JOIN forzaerp_device_status AS z ON o.device_imei=z.device_imei
            JOIN forzaerp_device_action_types AS l ON z.next_action=l.action_id
            JOIN forzaerp_device_status_types as h on z.device_status=h.status_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getSupplyOrdersStatus()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_supplier_order AS r 
            JOIN forzaerp_supply_order_status as s on r.order_id=s.order_id
            JOIN forzaerp_supply_order_status_types as t on t.status_id=s.status_id
            JOIN forzaerp_supply_action_types as a on a.action_type=s.action_id
            ");
           $results = $stmt->fetchAll();
           return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getDeviceCheckByImei($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_supply_inspection AS r 
            JOIN forzaerp_supply_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_status as f on f.device_imei=d.device_imei
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type as s on r.device_storage_id=s.storage_type_id
            JOIN forzaerp_device_status_types as p on f.device_status=p.status_id
            JOIN forzaerp_device_action_types as a on f.next_action=a.action_id
            
            WHERE d.device_imei=?
             ');
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function makeSupplySuborder($order_id,$suborder_id,$device_model,$quantity)
    {
        try {
            $db = static::getDB();
            $stmt =$db->prepare( "INSERT INTO
            forzaerp_supplier_suborder (`order_id`,`suborder_id`,`device_model`,`quantity`)
            VALUES (?,?,?,?)");

            $stmt->execute([$order_id,$suborder_id,$device_model,$quantity]);
            $id = $db->lastInsertId();

            return $id;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getSuborders($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_supplier_suborder AS s 
            
            JOIN forzaerp_device_model AS t ON s.device_model=t.device_id
            
            
            WHERE s.order_id=?
             ');
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkSplit($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_supplier_suborder AS s 
     
            WHERE s.order_id=?
             ');
            $stmt->execute([$order_id]);
            $total=$stmt->rowCount();
            return $total;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }




}