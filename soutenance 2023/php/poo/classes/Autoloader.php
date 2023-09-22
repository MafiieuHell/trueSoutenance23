<?php
namespace App;
class Autoloader
{
    static function register()
    {
        \spl_autoload_register([
            __CLASS__,
            'autoload'

        ]);
    }

    static function autoload($class)
    {
        //on recupere dans $class la totalité du namespace de la classe concernée
        //retrait du App\
        $class = str_replace(__NAMESPACE__.'\\', '', $class);
        //on remplace les \ par des /
        $class = str_replace('\\','/', $class);
        
        //on verifie si le fichier existe
        $file = __DIR__.'/'.$class.'.php';

        if(file_exists($file)){
            require_once $file;
        }

        
    }

}