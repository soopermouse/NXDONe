<?php



namespace Core;


class View
{
    /**
     * @param string $view
     * @return void
     */
    public static function render($view,$args=[])
    {
        extract($args,EXTR_SKIP);
        $file="../App/Views/$view";
        if(is_readable($file))
        {
            require $file;
        }else{

            throw new \Exception( "$file not found");
        }

    }

    public static function rendertemplate($template,$args=[])
    {
        static $twig=null;

        if($twig===null)
        {
            $loader=new \Twig_Loader_Filesystem('../App/Views');
            $twig=new \Twig_Environment($loader);
        }
        echo $twig->render($template,$args);

    }





}