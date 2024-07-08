<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:59
 */

namespace App\Models;
use PDO;

class UserModel extends \Core\Model
{
    static function getUser($user_id)
    {
        try{
            $db=static::getDB();
            $stmt=$db->query('SELECT * FROM forzaerp_users as u
            JOIN forzaerp_user_roles as r on u.user_role=r.user_role_id
            JOIN forzaerp_departments as d on u.user_department=d.user_department_id
            WHERE user_id=$user_id');
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }




    }






}