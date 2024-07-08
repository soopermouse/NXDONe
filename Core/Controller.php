<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 24/09/2018
 * Time: 14:56
 */
namespace Core;
abstract class Controller
{
    /**
     * @var array
     */
    protected $route_params=[];

    /**
     * Controller constructor.
     * @param array $route_params
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params=$route_params;

    }

    public function __call($name,$args)
    {
        $method=$name.'Action';
        if(method_exists($this,$method))
        {
            if($this->before()!==false)
            {
                call_user_func_array([$this,$method],$args);
                $this->after();

            }
        }else{

            throw new  \Exception("Method $method not found in controller ".get_class($this));
        }

    }

    protected function before()
    {


    }


    protected function after()
    {

    }

}