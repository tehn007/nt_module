<?
namespace Nt\Module\Helpers;


use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 
use Bitrix\Main\Application;

class Hload {


    public function load($ide, $ip){
    $hlbl = 4;
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
        $res = $arData["UF_LIKE"];
            }
            
    return $res;        
            
            
    }

    public function addtag($n){
//echo $n;    
    $hlbl = 6;
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
    $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
    $entity_data_class = $entity->getDataClass(); 
   $rsData = $entity_data_class::getList(array(
      "select" => array("*"),
      "order" => array("ID" => "ASC"),
      "filter" => array("UF_XML_ID"=>$n)
     ));
  while($arData = $rsData->Fetch()){
      $resname = $arData["UF_XML_ID"];
//      echo $resname." !! ";
    }
    if ($resname == ""){
      $data = array(
     "UF_XML_ID"=>$n,
     "UF_Name"=>$n
    );
   $result = $entity_data_class::add($data);
   }
        
//    return $res;        

    }
}
?>





