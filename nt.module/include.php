<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

Loader::registerAutoLoadClasses('nt.module', array(
//    'Nt\\Module\\Main' => 'lib/main.php',
    'Nt\\Module\\Helpers' => 'lib/helpers/hload.php',
));

/*
CModule::AddAutoloadClasses(
    "nt.module",
	array(
	"Nt\\Module\\Main" => "lib/Main.php",
	    )
    );
    
*/
    $module_id = pathinfo(dirname(__DIR__))["basename"];

    $arJsConfig = array( 
        'nt_module' => array( 
        'js' => '/bitrix/js/'.$module_id.'/like.js', 
        'css' => '/bitrix/css/.$module_id./like.min.css', 
        'rel' => array(), 
        ) 
    ); 
foreach ($arJsConfig as $ext => $arExt) { 
    \CJSCore::RegisterExt($ext, $arExt); 
        };
?>