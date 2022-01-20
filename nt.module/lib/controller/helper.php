<?php

namespace Nt\Module\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader; 
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 
use Bitrix\Main\Application;

Loader::includeModule("highloadblock");

?>



class Helper extends Controller{

    public function appendAction(){

	$request = Application::getInstance()->getContext()->getRequest();
        $id = $request->getPost("id");
	$like = $request->getPost("like");
//$id = $ID;
//$like = $LIKE;
	$hlbl = 4; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
	$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
	$entity_data_class = $entity->getDataClass(); 
	// Массив полей для добавления
	 $data = array(
	 "UF_ID"=>$id,
	 "UF_LIKE"=>$like
          );
	 $result = $entity_data_class::add($data);
    }

public function applyAction()
    {
        $request = $this->getRequest();
        return ['response' => 'success'];
    }




}

?>