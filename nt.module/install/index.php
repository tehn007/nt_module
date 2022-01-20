<?

IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Loader;



if (class_exists('nt.mudule')) {
    return;
}



Class Nt_Module extends CModule{

    const MODULE_ID = "nt.module";
    var $MODULE_ID = self::MODULE_ID;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $errors;

    function __construct()
    {
        //$arModuleVersion = array();
        $this->MODULE_VERSION = "1.0.0";
        $this->MODULE_VERSION_DATE = "10.01.2022";
        $this->MODULE_NAME = "nt_module news fom RSS";
        $this->MODULE_DESCRIPTION = "nt news";
    }

    function DoInstall()
    {
    
	global $DOCUMENT_ROOT, $APPLICATION;
      if (!IsModuleInstalled("nt.module"))
      {
	$this->InstallEvents();
        $this->InstallFiles();
        \Bitrix\Main\ModuleManager::RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Установка модуля"." \"".Loc::getMessage("NAME")."\"", __DIR__."/step.php");

      }
        return true;        
        
        
    }

    function DoUninstall()
    {
	global $DOCUMENT_ROOT, $APPLICATION;
	$this->UnInstallFiles();
	$this->UnInstallDB();
	$this->UnInstallEvents();

	ModuleManager::unRegisterModule($this->MODULE_ID);
	$APPLICATION->IncludeAdminFile("Удаление модуля"." \"".Loc::getMessage("NAME")."\"", __DIR__."/unstep.php" );

  return false;

    }

    function InstallDB()
    {
//          if (Loader::includeModule($this->MODULE_ID)) {
//            Main::getEntity()->createDbTable();
//        }

    }

    function UnInstallDB()
    {
//        if (Loader::includeModule($this->MODULE_ID)) {
//            $connection = Application::getInstance()->getConnection();
//            $connection->dropTable(Main::getTableName());
//        }

    }


    function InstallEvents()
    {

EventManager::getInstance()->registerEventHandler(
       "main",
       "OnBeforeEndBufferContent",
       $this->MODULE_ID,
        "Nt\Module\Main",
        "appendScriptsToPage"
 );
    return false;

    }

    function UnInstallEvents()
    {

EventManager::getInstance()->unRegisterEventHandler(
     "main",
       "OnBeforeEndBufferContent",
       $this->MODULE_ID,
        "Nt\Module;\Main",
        "appendScriptsToPage"
 );

    return false;
    }

    function InstallFiles()
    {
  $documentRoot = Application::getDocumentRoot();
CopyDirFiles(
       __DIR__."/files/scripts",
        Application::getDocumentRoot()."/bitrix/js/".$this->MODULE_ID."/",
       true,
       true
    );
/*
  CopyDirFiles(
       __DIR__."/files/styles",
     Application::getDocumentRoot()."/bitrix/css/".$this->MODULE_ID."/",
      true,
       true
    );
*/
CopyDirFiles(
       __DIR__."/files/components",
        Application::getDocumentRoot()."/bitrix/components/",
       true,
       true
    );

  return true;
            }

    function UnInstallFiles()
    {

DeleteDirFilesEx("/local/components/nt");
  return true;

    }
}