<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 27/09/2018
 * Time: 17:00
 */
namespace Core;
 class Error
 {
     /**
      * @param int $level
      * @param string $message
      * @param string $file
      * @param int $line
      * }return void
      */
     public static function errorhandler($level, $message,$file, $line)
     {
        if(error_reporting()!==0)
        {
            throw new \ErrorException($message,0,$level,$file,$line);

        }

     }

     public static function exceptionHandler($exception)

     {
         if (\App\Config::SHOW_ERRORS)
          {
             echo '<h1>Fatal error </h1>';
             echo "<p>Uncaught exception :'" . get_class($exception) . '"' . '</p>';
             echo "<p>Message :" . $exception->getMessage() . '"' . '</p>';
             echo "<p>Stack Trace:<pre></pre>" . $exception->getTraceAsString() . '"' . '</pre></p>';
             echo "<p>Thrown in :" . $exception->getFile() . "'on line " . $exception->getLine() . "</p>";

         }else{
            $log=dirname(__DIR__).'/logs/'.date('Y-m-d').".txt";
            ini_set('error_log',$log);
                 $message= "<p>Uncaught exception :'" . get_class($exception) . '"' . '</p>';
                 $message.= "<p>Message :" . $exception->getMessage() . '"' . '</p>';
                 $message.= "<p>Stack Trace:<pre></pre>" . $exception->getTraceAsString() . '"' . '</pre></p>';
                 $message.= "<p>Thrown in :" . $exception->getFile() . "'on line " . $exception->getLine() . "</p>";
                error_log($message);
                echo "<h1>An error occurred</h1>";

             }
     }


 }
