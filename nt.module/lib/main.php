<?php

namespace Nt\Soc;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;

class Main{

    public function appendScriptsToPage(){

      if(!defined("ADMIN_SECTION") && ADMIN_SECTION !== true){
         $module_id = pathinfo(dirname(__DIR__))["basename"];
	if($GLOBALS['APPLICATION']->GetCurDir() == SITE_DIR){
          Asset::getInstance()->addJs("/bitrix/js/".$module_id."/script.js");
//          Asset::getInstance()->addCss("/bitrix/css/".$module_id."/style.min.css");
		}
        }

       return false;
   }
}


