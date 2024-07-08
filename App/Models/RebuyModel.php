<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:59
 */

namespace App\Models;
use PDO;

class RebuyModel extends \Core\Model
{
    public static function getOrders()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
            
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_order_status_types AS y ON x.rebuy_order_status =y.status_id
            JOIN forzaerp_rebuy_action_status AS a ON a.action_id=x.next_action_id
            /*JOIN forzaerp_rebuy_order_quote as a on r.order_id=a.order_id*/
            ORDER BY order_date ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    /**
     * @param $order_id
     * @return mixed
     */
    public static function getDevice($device_imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_device AS d 
			JOIN forzaerp_rebuy_device_status as l on l.imei=d.device_imei
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
           
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON l.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON l.customer_order_status=z.cust_status_id
        
            WHERE device_imei=?");
            $stmt->execute([$device_imei]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function InspectSubmit($device_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments, $date, $imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO
            forzaerp_rebuy_inspection (`device_id`,`device_type`,`device_storage`,`device_connection`,`device_condition`,`device_colour`,`device_comments`,`date`,`IMEI`) 
            VALUES (?,?,?,?,?,?,?,?,?)");

            $stmt->execute([$device_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments, $date, $imei

            ]);
            $id = $db->lastInsertId();

            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function checksubmit($device_id, $IMEI, $checked, $stolen)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO
            forzaerp_rebuy_device_check (`device_id`,`IMEI`,`checked`,`stolen`) 
            VALUES (?,?,?,?)');

            $stmt->execute([$device_id, $IMEI, $checked, $stolen]);

            $id = $db->lastInsertId();

            return $id;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function checkupdate($IMEI, $device_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_order_device SET `device_imei`=? WHERE `device_id` = ?");
            $stmt->execute([$IMEI, $device_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function status()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('INSERT INTO rebuyplus_device_forza_inspection_quote(order_id,device_type_inspected,device_storage_inspected,device_connection_type_inspected,device_condition_inspected) VALUES();');


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function GetOrderInspectionById()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_inspection');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getStatus()
    {
        {
            try {
                $db = static::getDB();
                $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r
          
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
           
            JOIN forzaerp_rebuy_order_status_types AS y ON x.rebuy_order_status=y.status_id
          
            JOIN forzaerp_rebuy_order_action_types AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=a.action_id
            ');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


        }

    }

    public static function SubmitQuote($order_id, $quote, $imei)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_rebuy_order_quote (`order_id`,`order_quote`,`imei`) 
            VALUES (?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $quote, $imei]);
            $stmt = null;

            $message = "Quote created";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function Overview()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_salestag AS j ON r.order_id=j.order_id
            JOIN forzaerp_sales_order_tags AS g ON j.sales_tag_id=g.tag_id
            JOIN forzaerp_rebuy_order_quote AS a ON r.order_id=a.order_id
            ORDER BY order_date');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }


    public static function getInspection()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order_device as d
            
            JOIN forzaerp_device_model as t ON d.device_type_id=t.device_id
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            
            JOIN forzaerp_rebuy_device_status as s on s.device_id=d.device_id
            JOIN forzaerp_connection_type as a on d.device_connection_id=a.connection_type_id
            JOIN forzaerp_rebuy_action_status as f on s.next_action_id=f.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=f.action_id
            WHERE s.forza_order_status=4");

            //$stmt->execute([4]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getInspectionById($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_device AS r 
            JOIN forzaerp_rebuy_inspection AS d ON r.device_id=d.device_id
            JOIN forzaerp_device_model AS t ON d.device_type=t.device_id
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition=i.condition_id
            JOIN forzaerp_connection_type AS c ON d.device_connection=c.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage=s.storage_type_id
            JOIN forzaerp_device_colour AS a ON d.device_colour=a.colour_id
            JOIN forzaerp_rebuy_device_status AS z ON r.device_id=z.device_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=l.action_id
            WHERE d.IMEI=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function OrderSubmit($devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour)
    {
        try {
            $db = static::getDB();


            $sql = "INSERT INTO
            forzaerp_rebuy_order (`device_type`,`device_storage`,`device_connection`,`device_condition`,`device_colour`) 
            VALUES (?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour
            ]);
            //$stmt = null;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function setStatus($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_status AS s
                JOIN forzaerp_rebuy_forza_order_status_type AS y ON s.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON s.customer_order_status=z.cust_status_id
            
            WHERE s.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetch();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function acceptQuote($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `customer_order_status` = 4 WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function refuseQuote($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `customer_order_status` = 5 WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function setAction($action, $order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `next_action_id` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$action, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function setActionandStatus($action, $fstatus, $order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `next_action_id` = ? , `forza_order_status` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$action, $fstatus, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getShipping()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_shipping AS s ON r.order_id=s.order_id
            JOIN forzaerp_rebuy_shipping_status AS d ON s.shipping_status=d.shipping_status_id
            /**WHERE s.shipping_status=7**/
            ORDER BY r.order_id');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getShippingById($order_id)
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_shipping AS s ON r.order_id=s.order_id
            JOIN forzaerp_rebuy_shipping_status AS d ON s.shipping_status=d.shipping_status_id
            JOIN forzaerp_rebuy_order_status AS z ON r.order_id=z.order_id
            JOIN forzaerp_rebuy_order_action_types AS a ON z.next_action_id=a.action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=a.action_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updateShipping($status, $order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_shipping SET `shipping_status` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$status, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function reportsStatus($fstatus)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_status AS s
                JOIN forzaerp_rebuy_forza_order_status_type AS y ON s.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON s.customer_order_status=z.cust_status_id
            
            WHERE s.forza_order_status=?");
            $stmt->execute([$fstatus]);
            $results = $stmt->fetch();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

 /*   public static function setFailcard($order_id, $IMEI, $battery, $speakers, $lcd, $camera, $microphone, $powerbutton)
    {
        try {
            $db = static::getDB();


            $sql = "INSERT INTO
            forzaerp_rebuy_inspection_failcard (`order_id`,`device_IMEI`, `battery`,`speakers`,`lcd`,`camera`,`microphone`,`powerbutton`)
            VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $IMEI, $battery, $speakers, $lcd, $camera, $microphone, $powerbutton
            ]);
            //$stmt = null;
            return "failcard set";


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }*/

    public static function makeRebuyOrderStatus($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            `forzaerp_rebuy_order_status` (`order_id`,`rebuy_order_status`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, 1]);
            $stmt = null;

            $message = "Status updated";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function createShippingStatus($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            `forzaerp_rebuy_shipping` (`order_id`,`shipping_status`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, 7]);
            $stmt = null;

            $message = "SHIPPING STATUS CREATED";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function updateFStatus($fstatus, $order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `rebuy_order_status` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$fstatus, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function UpdateDeviceCustomerStatus($cstatus, $imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_device_status SET `customer_order_status` = ? WHERE `imei` = ?");
            $stmt->execute([$cstatus, $imei]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function UpdateOrderCustomerStatus($cstatus, $order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_order_status SET `customer_order_status` = ? WHERE `order_id` = ?");
            $stmt->execute([$cstatus, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function GetRefusedOffers()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_quote AS a ON r.order_id=a.order_id
            WHERE z.cust_status_id=5");
            //$stmt->execute([$fstatus]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }


    public static function getCheck()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM  forzaerp_rebuy_order_device as o 
            JOIN forzaerp_device_model AS t ON o.device_type_id=t.device_id
            JOIN forzaerp_device_grade AS i ON o.device_condition_id=i.grade_id
           
          
            JOIN forzaerp_rebuy_device_status AS z ON o.device_id=z.device_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_forza_order_status_type as h on z.forza_order_status=h.status_id
            JOIN forzaerp_rebuy_customer_status_type as c on c.cust_status_id=z.customer_order_status
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=l.action_id
             WHERE z.forza_order_status=3");
            //$stmt->execute([3]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function submitSecondQuote($imei, $quote)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO
            forzaerp_rebuy_order_secondquote (`imei`,`second_quote`)VALUES (?,?)");

            $stmt->execute([$imei, $quote]);
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function retrievesecondquote($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
           
            JOIN forzaerp_customer as c on r.customer_id=c.customer_id
            
            JOIN forzaerp_rebuy_order_totalquote AS a ON r.order_id=a.order_id
            JOIN forzaerp_rebuy_order_status AS z ON r.order_id=z.order_id
            JOIN forzaerp_rebuy_order_action_types AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=l.action_id
            WHERE r.order_id=? AND a.quote_type=2");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function retrievefirstoffer($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_device AS r 
           
            JOIN forzaerp_device_model AS t ON r.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON r.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON r.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON r.device_connection_id=m.connection_type_id
            /*JOIN forzaerp_rebuy_order_status as x on r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type as y on x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type as z on x.customer_order_status=z.cust_status_id*/
            JOIN forzaerp_rebuy_order_quote AS a ON r.device_imei=a.imei
            WHERE r.device_imei=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }



    public static function getOffers()
    {
        {
            try {
                $db = static::getDB();
                $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_order_quote AS q ON r.order_id=q.order_id
            /**ORDERBY x.forza_order_status**/
            ');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


        }

    }


    public static function getAcceptedOffers()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_status as s on r.order_id=s.order_id
            JOIN forzaerp_rebuy_order_totalquote as t on r.order_id=t.order_id
            JOIN forzaerp_rebuy_order_action_types as f on s.next_action_id=f.action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=f.action_id
            WHERE  s.rebuy_order_status=5");
            //$stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getReturns()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order_device AS d 
            JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition as i on d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type as m on d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_device_status AS x ON d.device_imei=x.imei
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status as a on x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            JOIN forzaerp_rebuy_order_quote as q on d.device_imei=q.imei
            WHERE x.customer_order_status=12");
            //$stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRecycle()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM  forzaerp_rebuy_order_device AS d 
            JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
            /**JOIN forzaerp_device_storage_type as s on d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition as i on d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type as m on d.device_connection_id=m.connection_type_id**/
            JOIN forzaerp_rebuy_device_status AS x ON d.device_imei=x.imei
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status as a on x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            WHERE z.cust_status_id=6");
            //$stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getClose()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
         
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_order_status_types AS y ON x.rebuy_order_status=y.status_id
           
            JOIN forzaerp_rebuy_order_action_types as a on a.action_id=x.next_action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=a.action_id
            WHERE x.rebuy_order_status=7 OR x.rebuy_order_status=10 OR x.rebuy_order_status=11");
            //$stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getOrderToClose($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS d 
            
            JOIN forzaerp_rebuy_order_status AS x ON d.order_id=x.order_id
            JOIN forzaerp_rebuy_order_status_types AS y ON x.rebuy_order_status=y.status_id
            /*JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id*/
            
            WHERE d.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function closeOrder($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `rebuy_order_status` = 9 WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getPaymentDetails($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            
            JOIN forzaerp_rebuy_order_totalquote AS t ON r.order_id =t.order_id
            
           /*JOIN forzaerp_rebuy_customer_payment AS p ON c.customer_id=p.cust_id*/
            JOIN forzaerp_rebuy_payment_types AS g ON r.payment_type_id=g.payment_type_id
           JOIN forzaerp_rebuy_order_status as s on r.order_id=s.order_id
            JOIN forzaerp_rebuy_order_status_types as y on s.rebuy_order_status=y.status_id
            
            
            WHERE r.order_id=? AND t.accepted=1");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function getQuoted()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
            
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_order_totalquote as t on r.order_id=t.order_id
            
            JOIN forzaerp_rebuy_order_action_types AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=a.action_id
            WHERE x.rebuy_order_status=9");
            //$stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getQuote($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            
            join forzaerp_customer as l on l.customer_id=r.customer_id
           
            JOIN forzaerp_rebuy_order_quote as q on r.order_id = q.order_id
            
            JOIN forzaerp_rebuy_order_status AS z ON r.order_id=z.order_id
            JOIN forzaerp_rebuy_Order_action_types AS a ON z.next_action_id=a.action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=a.action_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getQuoteAmount($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `order_quote` FROM forzaerp_rebuy_order_device AS r 
             JOIN forzaerp_rebuy_order as o on r.order_id=o.order_id  
            
            JOIN forzaerp_rebuy_order_quote as q on o.order_id = q.order_id
          
            WHERE r.device_imei=?");
            $stmt->execute([$imei]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRefused1()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order_device AS r 
                  
           
            JOIN forzaerp_rebuy_device_condition AS c ON r.device_condition_id=c.condition_id
            JOIN forzaerp_device_model AS t ON r.device_type_id=t.device_id
            JOIN forzaerp_connection_type AS e ON r.device_connection_id=e.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON r.device_storage_id=s.storage_type_id
            JOIN forzaerp_rebuy_device_status AS x ON r.device_imei=x.imei
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_quote AS q ON r.device_imei=q.imei
            WHERE x.customer_order_status=5");
            //$stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getInspected()
    {

        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_device_status as r
            JOIN forzaerp_rebuy_order_device as d on r.imei=d.device_imei
             JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_connection_type AS e ON d.device_connection_id=e.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id
            JOIN forzaerp_rebuy_forza_order_status_type as f on r.forza_order_status=f.status_id
            JOIN forzaerp_rebuy_action_status as a on r.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on a.action_id=b.action_id
            WHERE forza_order_status=16
            ');


            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function setAccepted($imei, $order_id,$accepted)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO forzaerp_rebuy_device_accepted_offers (`imei`,`order_id`,`accepted`) VALUES(?,?,?)
            ");
            $stmt->execute([$imei, $order_id,$accepted]);
            $stmt = null;

            $message = "Offer Accepted";


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function AcceptDeviceOffer($accepted,$imei, $order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE `forzaerp_rebuy_device_accepted_offers` SET `accepted`=? WHERE `imei`=? AND`order_id`=?
            ");
            $stmt->execute([$accepted,$imei, $order_id]);
            $stmt = null;

            $message = "Offer status updated";
            return $message;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getSecQuote($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
             JOIN forzaerp_customer as n on n.customer_id=r.customer_id          
           
            JOIN forzaerp_rebuy_order_secondquote as q on r.order_id = q.order_id
           
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getAddressbyOrderId($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare(" SELECT * FROM forzaerp_rebuy_order as r 
            JOIN forzaerp_customer as c on r.customer_id=c.customer_id
            JOIN forzaerp_customer_address as a on a.customer_id=c.customer_id 
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getActionButtons($order_id)
    {


        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_status AS z ON r.order_id=z.order_id
            JOIN forzaerp_rebuy_action_status AS a ON z.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getOrderActionById($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_device AS r 
            JOIN forzaerp_rebuy_inspection AS o ON o.imei=r.device_imei
            
            JOIN forzaerp_device_model as t on o.device_type=t.device_id
            
            JOIN forzaerp_rebuy_device_status AS z ON r.device_imei=z.imei
            JOIN forzaerp_rebuy_action_status AS a ON z.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            WHERE r.device_imei=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getIMEI($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `device_imei` FROM 
            forzaerp_rebuy_order_device 
            WHERE order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['device_imei'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeRebuyOffer( $order_id, $quote_type,$quote,$accepted)
    {
        try {
            $db = static::getDB();


            $stmt = $db->prepare("INSERT INTO
            forzaerp_rebuy_order_totalquote(`order_id`,`quote_type`,`quote`,`accepted`) 
            VALUES (?,?,?,?)");

            $stmt->execute([$order_id, $quote_type,$quote,$accepted]);
            $id = $db->lastInsertId();
            Return $id;
            //$stmt = null;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function makeRebuyDeviceSecondOffer( $quote,$imei,$order_id)
    {
        try {
            $db = static::getDB();


            $stmt = $db->prepare("INSERT INTO
            forzaerp_rebuy_order_secondquote(`quote`,`imei`,`order_id`) 
            VALUES (?,?,?)");

            $stmt->execute([$quote, $imei, $order_id]);
            $id = $db->lastInsertId();
            Return $id;
            //$stmt = null;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function makeRebuyOrderSecondOffer( $order_id,$quote)
    {
        try {
            $db = static::getDB();


            $stmt = $db->prepare("INSERT INTO
            forzaerp_rebuy_order_totalquote(`order_id`,`quote_type`,`quote`) 
            VALUES (?,?,?)");

            $stmt->execute([$order_id,2,$quote]);
            $id = $db->lastInsertId();
            Return $id;
            //$stmt = null;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

        public static function getOrderdate($order_id)
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `order_date` FROM 
            forzaerp_rebuy_order
            WHERE order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['order_date'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function makerebuydevicestatus($order_id, $imei, $order_status, $action)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO forzaerp_rebuy_device_status (`order_id`,`imei`,`forza_order_status`,`customer_status`,`next_action_id`) VALUES(?,?,?,?,?)
            ");
            $stmt->execute([$order_id, $imei, $order_status, 13, $action]);
            $device_status = $db->lastInsertId();

            $message = $device_status . "supplier device status created";


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updaterebuydevicestatus($status, $device_id, $imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_device_status SET `forza_order_status` = ?, `customer_status`=? WHERE `device_id` = ? AND `imei`=?");
            $stmt->execute([$status, $device_id, $imei]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }



    public static function getOrderIdbyImei($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `order_id` FROM forzaerp_rebuy_order_device 
            
            WHERE device_imei=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['order_id'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getImeiStatus()
    {
        {
            try {
                $db = static::getDB();
                $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order_device as d 
            JOIN forzaerp_rebuy_order_status AS x ON d.device_imei=x.imei
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            ');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


        }

    }

    public static function getordertags()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status AS a ON a.action_id=x.next_action_id
            /*JOIN forzaerp_rebuy_order_quote as a on r.order_id=a.order_id*/
            ORDER BY order_date DESC LIMIT 10');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRebuyOrder($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            WHERE `order_id`=?');
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function findDevice($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rebuy_order_device AS r 
            
            JOIN forzaerp_rebuy_device_status as d on r.device_imei=d.imei
            JOIN forzaerp_rebuy_forza_order_status_type as t on t.status_id=d.forza_order_status
            JOIN forzaerp_rebuy_action_status as a on a.action_id=d.next_action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=d.next_action_id
            WHERE r.device_imei=?');
            $stmt->execute([$IMEI]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getDeviceStatus()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device as o on o.order_id=r.order_id
            
            JOIN forzaerp_device_model AS t ON o.device_type_id=t.device_id
            JOIN forzaerp_device_grade AS i ON o.device_condition_id=i.grade_id
            JOIN forzaerp_rebuy_device_status AS z ON o.device_id=z.device_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_forza_order_status_type as h on z.forza_order_status=h.status_id
            JOIN forzaerp_rebuy_customer_status_type as c on c.cust_status_id=z.customer_order_status
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=l.action_id
            WHERE z.forza_order_status!=15
            ");

            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getOrderDevices($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device as o on o.order_id=r.order_id
            JOIN forzaerp_device_model AS t ON o.device_type_id=t.device_id
            JOIN forzaerp_device_grade AS i ON o.device_condition_id=i.grade_id
            JOIN forzaerp_rebuy_device_status AS z ON o.device_id=z.device_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_action_buttons as b on l.action_id=b.action_id
            JOIN forzaerp_rebuy_forza_order_status_type as h on z.forza_order_status=h.status_id
            JOIN forzaerp_rebuy_customer_status_type as c on c.cust_status_id=z.customer_order_status
            WHERE r.order_id=?
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getOrderStatus()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
             JOIN forzaerp_rebuy_order_status AS s ON s.order_id=r.order_id
            JOIN forzaerp_rebuy_order_status_types as t on s.rebuy_order_status=t.status_id
           
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=s.next_action_id
            WHERE s.rebuy_order_status!=8
             
            ");

            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function massdeviceupdatestatus($status, $action, $order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_device_status SET `forza_order_status` = ?, `next_action_id`=? WHERE `order_id` = ?");
            $stmt->execute([$status, $action, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getDeviceId($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `device_id` FROM forzaerp_rebuy_order_device 
            WHERE `device_imei`=?");
            $stmt->execute([$imei]);

            $id = $stmt->fetch(PDO::FETCH_ASSOC);
            return $id['device_id'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkQuote($imei, $order_id, $offer_type)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_offer
            WHERE  `order_id`=? ");
            $stmt->execute([$order_id]);
            $id = $stmt->fetchAll();
            return $id;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getOrderDevicesStatus($order_id)
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device as o on o.order_id=r.order_id
            JOIN forzaerp_device_model AS t ON o.device_type_id=t.device_id
            JOIN forzaerp_device_grade AS i ON o.device_condition_id=i.grade_id
            JOIN forzaerp_rebuy_device_status AS z ON o.device_id=z.device_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_action_buttons as b on l.action_id=b.action_id
            JOIN forzaerp_rebuy_forza_order_status_type as h on z.forza_order_status=h.status_id
            JOIN forzaerp_rebuy_customer_status_type as c on c.cust_status_id=z.customer_order_status
            WHERE r.order_id=?
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function acceptOffer($accepted, $order_id, $imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_device_accepted_offers SET `accepted` = ? WHERE `order_id` = ? AND `imei`=?");
            $stmt->execute([$accepted, $order_id, $imei]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAcceptedOffersByOrder($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM  forzaerp_rebuy_order_device as d 
            JOIN forzaerp_rebuy_order_offer as o on o.imei=d.device_imei
            JOIN forzaerp_rebuy_device_accepted_offers as a on o.imei=a.imei
            WHERE d.order_id=? AND accepted=1
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getOrderQuotes($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT SUM(`order_quote`) as total FROM  forzaerp_rebuy_order as r
            JOIN forzaerp_rebuy_order_quote as o on o.order_id=r.order_id
            JOIn forzaerp_rebuy_order_device as d on d.device_imei=o.imei
           /* JOIN forzaerp_rebuy_device_accepted_offers as f on f.imei=d.device_imei*/
            WHERE d.order_id=? 
            /*AND f.accepted = 0*/
            
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['total'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getOrderSecondQuotes($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT SUM(`quote`) as total FROM  forzaerp_rebuy_order as r
            JOIN forzaerp_rebuy_order_secondquote as o on o.order_id=r.order_id
            JOIn forzaerp_rebuy_order_device as d on d.device_imei=o.imei
           /* JOIN forzaerp_rebuy_device_accepted_offers as f on f.imei=d.device_imei*/
            WHERE d.order_id=? 
            /*AND f.accepted = 0*/
            
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['total'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getOrderState()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT `order_id` FROM  forzaerp_rebuy_order_status 
            /*WHERE `rebuy_order_status`!=4*/
            ");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getOrderSecondOffers($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM  forzaerp_rebuy_order as r
            
            JOIn forzaerp_rebuy_order_device as d on d.order_id=r.order_id
            JOIN forzaerp_rebuy_device_status as s on s.imei=d.device_imei
            JOIN forzaerp_rebuy_device_accepted_offers as a on a.imei=d.device_imei
            JOIN forzaerp_rebuy_order_secondquote as f on f.imei=d.device_imei
            JOIN forzaerp_device_colour as c on d.device_colour_id=c.colour_id
            JOIN forzaerp_device_model as m on d.device_type_id=m.device_id
            JOIN forzaerp_device_storage_type as t on d.device_storage_id=t.storage_type_id
            JOIN forzaerp_device_grade as g on d.device_condition_id = g.grade_id
            JOIN forzaerp_connection_type as h on h.connection_type_id=d.device_connection_id
            WHERE d.order_id=? 
              /*AND f.accepted = 0*/
            
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function getOrderOffers($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM  forzaerp_rebuy_order as r
            
            JOIn forzaerp_rebuy_order_device as d on d.order_id=r.order_id
            JOIn forzaerp_rebuy_device_status as s on s.imei=d.device_imei
            JOIN forzaerp_rebuy_device_accepted_offers as a on a.imei=d.device_imei
            JOIN forzaerp_rebuy_order_quote as f on f.imei=d.device_imei
            JOIN forzaerp_device_colour as c on d.device_colour_id=c.colour_id
            JOIN forzaerp_device_model as m on d.device_type_id=m.device_id
            JOIN forzaerp_device_storage_type as t on d.device_storage_id=t.storage_type_id
            JOIN forzaerp_device_grade as g on d.device_condition_id = g.grade_id
            JOIN forzaerp_connection_type as h on h.connection_type_id=d.device_connection_id
            WHERE d.order_id=? 
              /*AND f.accepted = 0*/
            
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function getOrdersbyStatus($status_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
             JOIN forzaerp_rebuy_order_status AS s ON s.order_id=r.order_id
            JOIN forzaerp_rebuy_order_status_types as t on s.rebuy_order_status=t.status_id
           
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=s.next_action_id
            WHERE s.rebuy_order_status=?
           
            ");
            $stmt->execute([$status_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function setOrderQuote($order_id,$quote_type,$quote)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO forzaerp_rebuy_order_totalquote (`order_id`,`quote_type`,`quote`) VALUES(?,?,?)
            ");
            $stmt->execute([$order_id,$quote_type,$quote]);
            $quote_id = $db->lastInsertId();
            return $quote_id;




        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getOrderQuote($order_id,$quote_type)
    {
        try {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT `quote` FROM forzaerp_rebuy_order AS r 
                     JOIN forzaerp_rebuy_order_totalquote as t on r.order_id=t.order_id
                      WHERE r.order_id=? AND quote_type=?                  
                    ");
        $stmt->execute([$order_id, $quote_type]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['quote'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function acceptOrderOffer($order_id,$accepted,$quote_type)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_order_totalquote SET `accepted` = ? WHERE `order_id` = ? AND `quote_type`=?");
            $stmt->execute([$accepted, $order_id,$quote_type]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getOrderDevicesbyStatus($order_id,$status_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device as o on o.order_id=r.order_id
            JOIN forzaerp_device_model AS t ON o.device_type_id=t.device_id
            JOIN forzaerp_device_grade AS i ON o.device_condition_id=i.grade_id
            JOIN forzaerp_rebuy_device_status AS z ON o.device_id=z.device_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_action_buttons as b on l.action_id=b.action_id
            JOIN forzaerp_rebuy_forza_order_status_type as h on z.forza_order_status=h.status_id
            JOIN forzaerp_rebuy_customer_status_type as c on c.cust_status_id=z.customer_order_status
            WHERE r.order_id=? AND z.forza_order_status=?
            ");
            $stmt->execute([$order_id,$status_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getOrderDevicesImei($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `device_imei` FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device as o on o.order_id=r.order_id
            JOIN forzaerp_device_model AS t ON o.device_type_id=t.device_id
            JOIN forzaerp_device_grade AS i ON o.device_condition_id=i.grade_id
            JOIN forzaerp_rebuy_device_status AS z ON o.device_id=z.device_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_action_buttons as b on l.action_id=b.action_id
            JOIN forzaerp_rebuy_forza_order_status_type as h on z.forza_order_status=h.status_id
            JOIN forzaerp_rebuy_customer_status_type as c on c.cust_status_id=z.customer_order_status
            WHERE r.order_id=?
            ");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRefusedFirstOffers()
    {

        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS d 
         
            JOIN forzaerp_rebuy_order_status AS x ON d.order_id=x.order_id
            JOIN forzaerp_rebuy_order_status_types AS y ON x.rebuy_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_action_types as a on x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_order_action_buttons as b on b.action_id=a.action_id
            JOIN forzaerp_rebuy_order_totalquote as q on d.order_id=q.order_id
            WHERE x.customer_order_status=5
            ");
            //$stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function retrieveFirstOrderOffer($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
          JOIN forzaerp_rebuy_order_status as x on r.order_id=x.order_id
            JOIN forzaerp_rebuy_order_status_types as y on x.rebuy_order_status=y.status_id
       
            JOIN forzaerp_rebuy_order_totalquote AS a ON r.order_id=a.order_id
            WHERE r.order_id=? AND a.quote_type=1");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getDeviceQuote($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order as o 
            JOIN forzaerp_rebuy_order_device as d on o.order_id=d.order_id
            JOIN forzaerp_connection_type as c on c.connection_type_id=d.device_connection_id
            JOIN forzaerp_device_model as m on d.device_type_id=m.device_id
            JOIN forzaerp_rebuy_device_condition as g on d.device_condition_id=g.condition_id
            JOIN forzaerp_device_storage_type as t on t.storage_type_id=d.device_storage_id
            JOIN forzaerp_rebuy_order_quote as q on q.imei=d.device_imei
            WHERE d.device_imei=? ");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getDeviceOfferStatus($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `accepted` FROM forzaerp_rebuy_order as o 
            JOIN forzaerp_rebuy_order_device as d on o.order_id=d.order_id
            JOIN forzaerp_connection_type as c on c.connection_type_id=d.device_connection_id
            JOIN forzaerp_device_model as m on d.device_type_id=m.device_id
            JOIN forzaerp_rebuy_device_condition as g on d.device_condition_id=g.condition_id
            JOIN forzaerp_device_storage_type as t on t.storage_type_id=d.device_storage_id
            JOIN forzaerp_rebuy_order_quote as q on q.imei=d.device_imei
            JOIN forzaerp_rebuy_device_accepted_offers  as a on a.imei=d.device_imei
            WHERE o.order_id=? AND a.quote_type=1");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function validateOrderOffer($order_id,$quote_type)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order as o 
            
            JOIN forzaerp_rebuy_order_totalquote  as a on a.order_id=o.order_id
            WHERE o.order_id=? AND a.quote_type=?");
            $stmt->execute([$order_id,$quote_type]);
            $results = $stmt->fetchAll();
            if($results)
            {
                return true;
            }else{
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getOrderOffer($order_id,$quote_type)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("	SELECT * FROM forzaerp_rebuy_order AS d 
            JOIN forzaerp_rebuy_device_accepted_offers as o on o.order_id=d.order_id
          	 WHERE d.order_id=1 ANd quote_type=1");
            $stmt->execute([$order_id, $quote_type]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getIMEIbyDeviceId($device_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("	SELECT `device_imei` FROM forzaerp_rebuy_order_device 
            
          	 WHERE device_id=? ");
            $stmt->execute([$device_id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['device_imei'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }




}