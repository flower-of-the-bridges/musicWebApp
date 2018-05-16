<?php

class SmartyConfig
{

    static function giovConf() : Smarty
    {
        require('/opt/lampp/php/Smarty/Smarty.class.php');
        
        $smarty = new Smarty();
        
        $smarty->setTemplateDir('/opt/lampp/htdocs/DeepMusic/smarty/templates');
        $smarty->setCompileDir('/opt/lampp/htdocs/DeepMusic/smarty/templates_c');
        $smarty->setCacheDir('/opt/lampp/htdocs/DeepMusic/smarty/cache');
        $smarty->setConfigDir('/opt/lampp/htdocs/DeepMusic/smarty/configs');
        
        return $smarty; 
    }
    
    static function davideConf () : Smarty
    {
        require('C:\xampp\php\lib\smarty-3.1.32\libs\Smarty.class.php');
        
        $smarty = new Smarty();
        
        $smarty->setTemplateDir('C:\xampp\htdocs\musicWebApp\smarty\templates');
        $smarty->setCompileDir('C:\xampp\htdocs\musicWebApp\smarty\templates_c');
        $smarty->setCacheDir('C:\xampp\htdocs\musicWebApp\smarty\cache');
        $smarty->setConfigDir('C:\xampp\htdocs\musicWebApp\smarty\configs');
        
        return $smarty;
    }
    
    static function marcoConf () : Smarty
    {
        require('C:\xampp\php\lib\Smarty\libs\Smarty.class.php');
        
        $smarty = new Smarty();
        
        $smarty->setTemplateDir('C:\xampp\htdocs\musicWebApp\smarty\templates');
        $smarty->setCompileDir('C:\xampp\htdocs\musicWebApp\smarty\templates_c');
        $smarty->setCacheDir('C:\xampp\htdocs\musicWebApp\smarty\cache');
        $smarty->setConfigDir('C:\xampp\htdocs\musicWebApp\smarty\configs');
        
        return $smarty;
    }
    
}

