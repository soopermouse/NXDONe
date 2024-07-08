<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 07/09/2018
 * Time: 12:08
 */

class Connection
{
    public $host='localhost';
    public $username='root';
    public $database='magwork';
    public $password='';
    public $link;

    public function __construct($host,$username,$database,$password)
    {
        $this->host=$host;
        $this->username=$username;
        $this->database=$database;
        $this->password=$password;



    }

    public function connect()
    {
        $this->link = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (!$this->link) {
            echo "Connection to the database could not be established";


        } else {

            echo "database connected!!";
        }
        return $this->link;
    }

        public function insert($table, $fields,$inputarray)
        {
            $sql="(INSERT INTO $table $fields VALUES $inputarray;)";
            $results=Mysqli_query($this->connect(),$sql);


        }


        public function select($table, $paramarray)
        {
            $query="(SELECT * FROM $table WHERE $paramarray;)";
            $results=Mysqli_query($this->connect(),$query);
            if($results->num_rows>0){
                while ($row = $results->fetch_object()) {
                    foreach ($row as $r){
                        echo $r.'<br>';
                    }
                }
            }
        }




        public function update()
        {
            $query;
         }




}

$connection=new Connection('127.0.0.1','root','magwork','');
$connection->connect();

class Database
{
    private static $dbName = 'crud_tutorial' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'root';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection through whole application
        if ( null == self::$cont )
        {
            try
            {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}