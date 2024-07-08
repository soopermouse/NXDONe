<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 22/09/2018
 * Time: 13:38
 */
namespace Core;
 class Router
 {

     /**
      * @var array
      */
protected $routes=[];
     /**
      * @var array
      */
protected $params=[];

     /**
      * @param string $route
      * @param array $params
      * @return void
      */
public function add($route,$params=[])
{
    $route=preg_replace('/\//','\\/',$route);
    $route=preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$route);
    $route=preg_replace('/\{([a-z]+):([^\}]+)\}/','(?P<\1>\2)',$route);
    $route='/^'.$route.'$/i';

    $this->routes[$route]=$params;

}

     /**
      * @return array
      */
public function getRoutes()
{
return $this->routes;

}

public function match($url)
{
    foreach ($this->routes as $route => $params) {

        //$reg_exp="/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        if (preg_match($route, $url, $matches)) {
            //$params=[];

            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }
            $this->params = $params;
            return true;

        }

    }
    return false;

}

public function getParams()
{
    return $this->params;
}


public function dispatch($url)
{
    $url=$this->removeQueryStringVariables($url);
    if($this->match($url))
    {
        $controller=$this->params['controller'];
        $controller=$this->convertToStudlyCaps($controller);
        $controller=$this->getNamespace().$controller;

        if(class_exists($controller))
        {
            $controller_object=new $controller($this->params);

            $action=$this->params['action'];
            $action=$this->convertToCamelCase($action);

            if(is_callable([$controller_object,$action]))
            {
                $controller_object->$action();

            }else{
                throw new \Exception("Method $action in controller $controller not found");
            }

        }else{
            throw new \Exception("Controller class $controller not found");
        }
    }else{

        throw new \Exception("No route matched");
    }

}


protected function convertToStudlyCaps($string)
{
    return str_replace(' ','',ucwords(str_replace('-','',$string)));

}

protected function convertToCamelCase($string)
{
    return lcfirst($this->convertToStudlyCaps($string));

}

     /**
      * @param $url
      */
     protected function removeQueryStringVariables($url)
     {
         if ($url != '') {
             $parts = explode('&', $url, 2);

             // if (strpos($parts[0], '0') === false) {     // this line is incorrect
             if (strpos($parts[0], '=') === false) {        // this is the correct version
                 $url = $parts[0];
             } else {
                 $url = '';
             }
         }

         return $url;
     }

     /**
      * Get the namespace for the controller class. The namespace defined in the
      * route parameters is added if present.
      *
      * @return string The request URL
      */
     protected function getNamespace()
    {
        $namespace='App\Controllers\\';
        if(array_key_exists('namespace',$this->params))
        {
            $namespace.=$this->params['namespace'].'\\';
        }

        return $namespace;

    }


 }

