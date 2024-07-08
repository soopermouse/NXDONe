<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:59
 */

namespace App\Models;
use PDO;

class LoginModel extends \Core\Model
{
    public static $user = [];


    public static function getLoginDetails($username, $password)
    {
        try {

            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_users WHERE user_name = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user['user_password'] == $password) {

                header('Location: Home/index
                ');
            } else {
                die("wrong username or password. Please hit the back button of your browser and try again");
            }
            //echo $message;

            /*$stmt=$db->prepare('SELECT * FROM users WHERE user_name=:username and user_password=:password');
            //$stmt = $pdo->prepare("SELECT * FROM users WHERE user_name=:username and user_password=:password");
            $stmt->execute(['user_name' => $username,
                'user_password'=>$password]);
            $user = $stmt->fetch();
            //$count=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if($stmt->fetchColumn() > 0)
            {
                echo $message;

            }*/
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        print_r($user);


    }

    static function getUser($username,$password)
    {
        try {
            $user=self::getLoginDetails($username,$password);
            $id=$user['user_id'];
            $db = static::getDB();

            $stmt = $db->query('SELECT * FROM forzaerp_users as u
            JOIN user_role as r on u.user_role=r.user_role_id
            JOIN forzaerp_departments as d on u.user_department=d.user_department_id
            WHERE user_id=$id');
            $userresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $userresults;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    /**
     * @param array $user
     */
    public static function setUser(array $username, $password): void
    {
        self::$user = self::getLoginDetails($username,$password);
        echo self::$user;
    }

}

