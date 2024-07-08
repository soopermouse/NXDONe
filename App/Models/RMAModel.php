<?php
/**
 * Created by PhpStorm.
 * User: darke
 * Date: 31/10/2018
 * Time: 20:03
 */


namespace App\Models;
use PDO;

class RMAModel extends \Core\Model
{


    public static function getWarranty($imei)
    {

            try {
                $db = static::getDB();
                $stmt = $db->prepare("SELECT * FROM forzaerp_sales_order AS r 
                JOIN forzaerp_warranty as w on r.order_id=w.order_id
                JOIN forzaerp_sales_order_device as d on d.order_id=r.order_id
                JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
                JOIN forzaerp_device_storage_type as s on d.device_storage_id=s.storage_type_id
                JOIN forzaerp_connection_type as c on d.device_connection_id=c.connection_type_id
                JOIN forzaerp_device_colour as l on d.device_colour_id=l.colour_id
                WHERE w.device_imei=?");
                $stmt->execute([$imei]);
                $results = $stmt->fetchAll();
                //return $results;
                $count = $stmt->rowCount();
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }



    }

    public static function makeRMADetails($rma_id,$problem_id,$comments,$date)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            `forzaerp_rma_order_details` (`rma_id`,`problem_id`,`comments`,`date`) 
            VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$rma_id,$problem_id,$comments,$date]);
            //$stmt = null;
            $message="rma details entered";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }



    }

    public static function checkIMEI($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_warranty WHERE device_imei=?");
            $stmt->execute([$imei]);

            $count = $stmt->rowCount();
            return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

     public static function getRMAs()
     {
         try {
             $db = static::getDB();
             $stmt = $db->query('SELECT * FROM forzaerp_rma_order AS r 
           JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
            JOIN forzaerp_rma_action_types as l on l.action_id=s.next_action_id
            JOIN forzaerp_rma_action_buttons as b on b.action_id=l.action_id
            ORDER BY rma_date DESC');
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
             return $results;
         } catch (\PDOException $e) {
             echo $e->getMessage();
         }
     }

     public static function createStatus($rma_id)
     {
         try {
             $db = static::getDB();
             $sql = "INSERT INTO
            forzaerp_rma_order_status (`rma_id`,`status_id`,`shipping_status_id`)
            VALUES ($rma_id,1,1)";
             $stmt = $db->prepare($sql);
             $stmt->execute([$rma_id,1,1]);
             //$stmt = null;
             $message="RMA order status entered";
             return $message;

         } catch (\PDOException $e) {
             echo $e->getMessage();
         }


     }

     public static function makeRMAInspection($rma_id,$imei,$buttons_inspection_id,$camera_inspection_id,$connections_inspection_id,$misc_inspection_id,$power_inspection_id,$screen_inspection_id,$sound_inspection_id,$date)
     {
         try {
             $db = static::getDB();
             $sql = "INSERT INTO
            forzaerp_inspection(`rma_id`,`device_imei`,`buttons_inspection_id`,`camera_inspection_id`,`connections_inspection_id`,`misc_inspection_id`, `power_inspection_id`,`screen_inspection_id`,`sound_inspection_id`,`date`)
            VALUES (?,?,?,?,?,?,?,?,?,?)";
             $stmt = $db->prepare($sql);
             $stmt->execute([$rma_id,$imei,$buttons_inspection_id,$camera_inspection_id,$connections_inspection_id,$misc_inspection_id,$power_inspection_id,$screen_inspection_id,$sound_inspection_id,$date]);
             //$stmt = null;
             $message="inspection details entered";
             return $message;

         } catch (\PDOException $e) {
             echo $e->getMessage();
         }


     }



    public static function getIMEI($rma_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `imei` FROM forzaerp_rma_order
            WHERE rma_id=?");
            $stmt->execute([$rma_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRMA($rma_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
            WHERE r.rma_id=?');
            $stmt->execute([$rma_id]);

            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }





    public static function getInspection($rma_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_sound as s 
            JOIN forzaerp_inspection_details_screen as d on s.rma_id=d.rma_id
            JOIN forzaerp_inspection_details_power as p on s.rma_id=p.rma_id
            JOIN forzaerp_inspection_details_misc as m on m.rma_id=s.rma_id
            JOIN forzaerp_inspection_details_connections as c on s.rma_id=c.rma_id
            JOIN forzaerp_inspection_details_camera as i on i.rma_id=s.rma_id
            JOIN forzaerp_inspection_details_buttons as b on b.rma_id=s.rma_id
            WHERE s.rma_id=?');
            $stmt->execute([$rma_id]);
            $count = $stmt->rowCount();
           // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }



    public static function setRMAStatus($status, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `status_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$status, $rma_id]);
            $message="status updated";
            return $message;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRMAsForInspection()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
           WHERE s.status_id=3');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getShipping()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rma_order_status AS r 
            JOIN forzaerp_rma_shipping_status AS d ON r.shipping_status_id=d.shipping_status_id
          ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getRMAsByStatus($status_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
            JOIN forzaerp_rma_action_types as l on l.action_id=s.next_action_id
            JOIN forzaerp_rma_action_buttons as b on b.action_id=l.action_id
           WHERE s.status_id=?');
            $stmt->execute([$status_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRMAHistory($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
           JOIN forzaerp_device_history as h on r.imei=h.imei
           JOIN forzaerp_event_type as e on h.event_type=e.event_type_id
           JOIN forzaerp_device_model as m on m.device_id=r.device_id
           WHERE r.imei=?
            ORDER BY rma_date');
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getShippingById($rma_id)
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_rma_shipping AS s ON r.rma_id=s.rma_id
            JOIN forzaerp_rma_shipping_status AS d ON s.shipping_status=d.shipping_status_id
            JOIN forzaerp_rma_order_status AS z ON r.rma_id=z.rma_id
           /**JOIN forzaerp_action_status AS a ON z.next_action_id=a.action_id
            JOIN forzaerp_rma_action_buttons as b on b.action_id=a.action_id**/
            WHERE r.rma_id=?");
            $stmt->execute([$rma_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function createShippingStatus($rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            `forzaerp_rma_shipping` (`rma_id`,`shipping_status`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$rma_id, 7]);
            $stmt = null;

            $message = "RMA SHIPPING STATUS CREATED";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function updateFStatus($fstatus, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `shipping_status_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$fstatus, $rma_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }
    public static function updateOStatus($ostatus, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `status_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$ostatus, $rma_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function updateShipping($status, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `shipping_status_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$status, $rma_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function getCustomerId($rma_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `customer_id` FROM forzaerp_rma_order 
            WHERE rma_id=?");
            $stmt->execute([$rma_id]);
            $results = $stmt->fetch();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRMAbyStatus($status_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
          
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
           WHERE s.status_id=? ORDER BY rma_date');
            $stmt->execute([$status_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRMAId($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT rma_id FROM forzaerp_rma_order 
            WHERE `imei`=? ");
            $stmt->execute([$imei]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['rma_id'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function setAction($action, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `next_action_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$action, $rma_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}