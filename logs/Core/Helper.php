<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 27/11/2018
 * Time: 13:29
 */

 namespace Core;
  Abstract class Helper
  {

        public static function IsChecked($chkname,$value)
        {
            if(!empty($_POST[$chkname]))
            {
                foreach($_POST[$chkname] as $chkval)
                {
                    if($chkval == $value)
                    {
                        return true;
                    }
                }
            }
            return false;
        }



  }