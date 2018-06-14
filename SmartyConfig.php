<?php
define('WHO', 'davide');
class SmartyConfig
{
    
    static function configure() : Smarty
    {
        /*
        if(WHO == 'marco'){ return SmartyConfig::marcoConf(); }
        else if(WHO == 'davide')
        { return SmartyConfig::davideConf(); }
        else if(WHO == 'giovanni'){ return SmartyConfig::giovConf(); }
        */
        require('lib/Smarty/Smarty.class.php');
        
        $smarty = new Smarty();
        
        $smarty->setTemplateDir('smarty/templates');
        $smarty->setCompileDir('smarty/templates_c');
        $smarty->setCacheDir('smarty/cache');
        $smarty->setConfigDir('smarty/configs');
        
        return $smarty;
    }
    
    
    static function giovConf() : Smarty
    {
        require('/opt/lampp/php/Smarty/Smarty.class.php');
        
        $smarty = new Smarty();
        
        $smarty->setTemplateDir('/opt/lampp/htdocs/deepmusic/smarty/templates');
        $smarty->setCompileDir('/opt/lampp/htdocs/deepmusic/smarty/templates_c');
        $smarty->setCacheDir('/opt/lampp/htdocs/deepmusic/smarty/cache');
        $smarty->setConfigDir('/opt/lampp/htdocs/deepmusic/smarty/configs');
        
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

