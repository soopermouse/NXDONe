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

    /**
     * @param $order_id
     * @return mixed
     */
    public static function getDevice($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id             
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_device_colour AS b ON d.device_colour_id=b.colour_id
           /** JOIN forzaerp_rebuy_inspection AS o ON o.order_id=r.order_id**/
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function InspectSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments,$date,$IMEI)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_rebuy_inspection (`order_id`,`device_type`,`device_storage`,`device_connection`,`device_condition`,`device_colour`,`device_comments`,`date`,`IMEI`) 
            VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments,$date,$IMEI

            ]);
            $stmt = null;

            $message = "Inspection updated";
            echo $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function checksubmit($IMEI, $checked, $order_id,$date)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO
            forzaerp_rebuy_device_check (`order_id`,`IMEI`,`checked`,`check_date`) 
            VALUES (?,?,?,?)');

            $stmt->execute([$order_id, $IMEI, $checked,$date

            ]);
            $stmt = null;

            $message = "check updated";
            return $message;

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
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            ');
                $results = $stmt->fetchAll();
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


        }

    }

    public static function SubmitQuote($order_id, $quote)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_rebuy_order_quote (`order_id`,`order_quote`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $quote]);
            $stmt = null;

            $message = "Quote updated";
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
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device as d ON r.order_id=d.order_id
            JOIN forzaerp_device_model as t ON d.device_type_id=t.device_id
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_rebuy_device_check as c ON r.order_id=c.order_id
            JOIN forzaerp_rebuy_order_status as s on s.order_id=r.order_id
            JOIN forzaerp_connection_type as a on d.device_connection_id=a.connection_type_id
            JOIN forzaerp_rebuy_action_status as f on s.next_action_id=f.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=f.action_id
            WHERE s.forza_order_status=4");

            $stmt->execute([4]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getInspectionById($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_inspection AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type=t.device_id
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition=i.condition_id
            JOIN forzaerp_connection_type AS c ON d.device_connection=c.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage=s.storage_type_id
            JOIN forzaerp_device_colour AS a ON d.device_colour=a.colour_id
            JOIN forzaerp_rebuy_order_status AS z ON r.order_id=z.order_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=l.action_id
            WHERE r.order_id=?
            ");

            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function OrderSubmit()
    {
        try {
            $db = static::getDB();


            $sql = "INSERT INTO
            forzaerp_rebuy_order (`device_type`,`device_storage`,`device_connection`,`device_condition`,`device_colour`) 
            VALUES (?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([ $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour
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
            $sql = "UPDATE forzaerp_rebuy_order_status SET `next_action_id` = ?  `forza_order_status` = ? WHERE `order_id` = ?";
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

    public static function setFailcard($order_id,$IMEI, $failcard, $battery, $speakers, $lcd, $camera,$microphone,$powerbutton)
    {
        try {
            $db = static::getDB();


            $sql = "INSERT INTO
            forzaerp_rebuy_inspection_failcard (`order_id`,`device_IMEI`, `failcard`,`battery`,`speakers`,`lcd`,`camera`,`microphone`,`powerbutton`)
            VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id,$IMEI, $failcard, $battery, $speakers, $lcd, $camera,$microphone,$powerbutton
            ]);
            //$stmt = null;
            return "failcard set";


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeStatus($order_id)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            `forzaerp_rebuy_order_status` (`order_id`,`forza_order_status`,`customer_order_status`,`next_action_id`) 
            VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, 1, 1, 1]);
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
            $sql = "UPDATE forzaerp_rebuy_order_status SET `forza_order_status` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$fstatus, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function updateCStatus($cstatus, $order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `customer_order_status` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$cstatus, $order_id]);

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
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id             
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            WHERE x.forza_order_status=3");
            $stmt->execute([3]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function submitSecondQuote($order_id, $quote)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_rebuy_order_secondquote (`order_id`,`second_quote`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $quote]);
            $stmt = null;

            $message = "Second Quote updated";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function retrievesecondquote($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_secondquote AS a ON r.order_id=a.order_id
             JOIN forzaerp_rebuy_order_status AS z ON r.order_id=z.order_id
            JOIN forzaerp_rebuy_action_status AS l ON z.next_action_id=l.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=l.action_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function retrievefirstoffer($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            /*JOIN forzaerp_rebuy_order_status as x on r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type as y on x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type as z on x.customer_order_status=z.cust_status_id*/
            JOIN forzaerp_rebuy_order_quote AS a ON r.order_id=a.order_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getordersbystatus()

    {
        {
            try {
                $db = static::getDB();
                $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            ORDERBY x.forza_order_status
            ');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


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
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition as i on d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type as m on d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status as x on r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_quote as a on r.order_id=a.order_id
            JOIN forzaerp_rebuy_action_status as f on x.next_action_id=f.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=f.action_id
            WHERE z.cust_status_id=4 OR z.cust_status_id=7 ");
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
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition as i on d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type as m on d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status as a on x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            JOIN forzaerp_rebuy_order_quote as q on r.order_id=q.order_id
            WHERE z.cust_status_id=12");
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
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
            /**JOIN forzaerp_device_storage_type as s on d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition as i on d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type as m on d.device_connection_id=m.connection_type_id**/
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
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
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            
            WHERE y.status_id=12");
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
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            
            WHERE r.order_id=?");
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
            $sql = "UPDATE forzaerp_rebuy_order_status SET `forza_order_status` = 15 WHERE `order_id` = ?";
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
            JOIN forzaerp_rebuy_inspection AS d ON r.order_id=d.order_id
            JOIN forzaerp_rebuy_order_quote AS q ON r.order_id=q.order_id
            JOIN forzaerp_device_model AS t ON d.device_type=t.device_id
            JOIN forzaerp_rebuy_device_condition AS l ON d.device_condition=l.condition_id
            JOIN forzaerp_rebuy_customer_payment AS p ON c.customer_id=p.cust_id
            JOIN forzaerp_rebuy_payment_types AS g ON r.payment_type_id=g.payment_type_id
            /**JOIN forzaerp_rebuy_order_status as x on r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type as y on x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type as z on x.customer_order_status=z.cust_status_id**/
            
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
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
                       
            JOIN forzaerp_rebuy_inspection AS d ON r.order_id=d.order_id
            JOIN forzaerp_rebuy_device_condition AS c ON d.device_condition=c.condition_id
            JOIN forzaerp_device_model AS t ON d.device_type=t.device_id
            JOIN forzaerp_connection_type AS e ON d.device_connection=e.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage=s.storage_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_quote as q on r.order_id = q.order_id
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            WHERE y.status_id=17");
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
                       
            JOIN forzaerp_rebuy_inspection AS d ON r.order_id=d.order_id
            JOIN forzaerp_rebuy_device_condition AS c ON d.device_condition=c.condition_id
            JOIN forzaerp_device_model AS t ON d.device_type=t.device_id
            JOIN forzaerp_connection_type AS e ON d.device_connection=e.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage=s.storage_type_id
                      
            JOIN forzaerp_rebuy_order_quote as q on r.order_id = q.order_id
            JOIN forzaerp_customer as f on r.customer_id=f.customer_id
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

    public static function getRefused1()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_rebuy_order AS r 
                       
            JOIN forzaerp_rebuy_inspection AS d ON r.order_id=d.order_id
            JOIN forzaerp_rebuy_device_condition AS c ON d.device_condition=c.condition_id
            JOIN forzaerp_device_model AS t ON d.device_type=t.device_id
            JOIN forzaerp_connection_type AS e ON d.device_connection=e.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage=s.storage_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_quote AS q ON r.order_id=q.order_id
            WHERE x.customer_order_status=12");
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
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
JOIN forzaerp_rebuy_inspection AS d ON r.order_id=d.order_id 
JOIN forzaerp_device_model AS t ON d.device_type=t.device_id 
JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition=i.condition_id 
JOIN forzaerp_connection_type AS c ON d.device_connection=c.connection_type_id 
JOIN forzaerp_device_storage_type AS s ON d.device_storage=s.storage_type_id 
JOIN forzaerp_device_colour AS a ON d.device_colour=a.colour_id 
JOIN forzaerp_rebuy_order_status as o on o.order_id=r.order_id 
JOIN forzaerp_rebuy_forza_order_status_type as b on b.status_id=o.forza_order_status 
JOIN forzaerp_rebuy_action_status AS m ON o.next_action_id=m.action_id 
JOIN forzaerp_rebuy_action_buttons as n on n.action_id=m.action_id 
WHERE o.forza_order_status=16
            ');


            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function setAccepted($order_id,$accepted_date)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO forzaerp_rebuy_device_accepted_offers (`order_id`,`accepted_date`) VALUES(?,?)
            ");
            $stmt->execute([$order_id,$accepted_date]);
            $stmt = null;

            $message = "Payment Accepted";




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
            JOIN forzaerp_rebuy_inspection AS d ON r.order_id=d.order_id
            JOIN forzaerp_rebuy_device_condition AS c ON d.device_condition=c.condition_id
            JOIN forzaerp_device_model AS t ON d.device_type=t.device_id
            JOIN forzaerp_connection_type AS e ON d.device_connection=e.connection_type_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage=s.storage_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_secondquote as q on r.order_id = q.order_id
            
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            
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
        try{
            $db=static::getDB();
            $stmt = $db->prepare(" SELECT * FROM forzaerp_rebuy_order as r 
            JOIN forzaerp_customer as c on r.customer_id=c.customer_id
            JOIN forzaerp_customer_address as a on a.customer_id=c.customer_id 
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        }
        catch (\PDOException $e)
        {
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

    public static function getOrderActionById($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_inspection AS o ON o.order_id=r.order_id
            JOIN forzaerp_rebuy_device_check as d on d.order_id=r.order_id
            JOIN forzaerp_device_model as t on o.device_type=t.device_id
            JOIN forzaerp_rebuy_device_check as c on r.order_id=c.order_id
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






}

