<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 
use Bitrix\Main\Application;
$request = Application::getInstance()->getContext()->getRequest();

$id = $request->getPost("id");
$like = $request->getPost("like");
$ip = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();
$hlbl = 4;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass(); 


   $data = array(
      "UF_ID"=>$id,
      "UF_LIKE"=>$like,
      "UF_GUID"=>$ip
   );

   $result = $entity_data_class::add($data);

?>





