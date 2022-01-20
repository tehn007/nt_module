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

//$id = $request->getPost("id");
//$like = $request->getPost("like");
$ide = $request->getPost("ide");
$ip = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();
?>

<!-- HL*** -->
<?
$hlbl = 4; // ”казываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass(); 


$rsData = $entity_data_class::getList(array(
  "select" => array("*"),
  "order" => array("ID" => "ASC"),
  "filter" => array("UF_ID"=>$ide,"UF_GUID"=>$ip)
         ));
         
         while($arData = $rsData->Fetch()){
        //    var_dump($arData);
        $result = $arData["UF_LIKE"];
            }



/** ћассив полей дл€ добавлени€
   $data = array(
      "UF_ID"=>$id,
      "UF_LIKE"=>$like,
      "UF_GUID"=>$ip
   );

   $result = $entity_data_class::add($data);
*/
?>





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>