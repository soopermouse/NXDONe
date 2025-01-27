<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 27/09/2018
 * Time: 12:58
 */

 namespace Core;
 use PDO;
use \App\Config;

 abstract class Model
 {
     protected static function getDB()
     {
         static $db=null;

         if($db===null)
         {
           // $host='localhost';
            //$dbname='magwork';
            //$username='root';
            //$password='';

            try {
                $dsn='mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME;
                $db=new PDO($dsn,Config::DB_USER,Config::DB_PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            }catch(\PDOException $e){

                echo $e->getMessage();
            }
         }
         return $db;

     }




 }