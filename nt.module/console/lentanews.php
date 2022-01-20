<?

$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', realpath(dirname(__FILE__) . '/../../../../'));
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);


while (ob_get_level()) {
    ob_end_flush();
    }
use Bitrix\Main\Loader;    
/*
*Получаем rss
*/
$s=0;
    if (CModule::IncludeModule("iblock")){
    $arRes = CIBlockRSS::GetNewsEx("www.lenta.ru", 80, "/rss/news/", "");
    $arRes = CIBlockRSS::FormatArray($arRes);
//        for ($i = 0; $i < count($arRes["item"]); $i++):
        for ($i = 0; $i < 65; $i++){

$file=CFile::MakeFileArray($arRes["item"][$i]["enclosure"]["url"]);
$fileSave = CFile::SaveFile(
    $file,
    'iblock',
    false,
    false,
	$dirAdd='/rssnews'
);
    $el = new CIBlockElement;
 $GUID=$arRes["item"][$i]["link"];//
 $CATEGORY=$arRes["item"][$i]["category"];//
 $TITLE=$arRes["item"][$i]["title"];//
 $DESCRIPTION=$arRes["item"][$i]["description"];//
 $IMG=$file[name];//
 $PUBDATE=$arRes["item"][$i]["pubDate"];//
//
$arFilter = Array(
"IBLOCK_ID"=>54,
"PROPERTY_1067_VALUE"=>$GUID
);

$res=CIBlockElement::GetList(Array(), $arFilter, false);
if ($res->SelectedRowsCount()==0){

    $PROP = array();
    $PROP[1067]=$GUID;
//добавление тэга в инфоблок


 if (Loader::includeModule('nt.module')) {
\Nt\Module\Helpers\hload::addtag($CATEGORY);
  }
 


//    
    $PROP[1073]=$CATEGORY;
    $PROP[1068]=$TITLE;
    $PROP[1069]=$DESCRIPTION;
    $PROP[1070]=$IMG;
    $PROP[1072]=$PUBDATE;
//    $PROP[1073]=$arRes;
    
    $arLoadProductArray = Array(
    "IBLOCK_ID"      => 54,
    "NAME"           => $arRes["item"][$i]["title"],
    "PROPERTY_VALUES"=> $PROP,
    );
    if($PRODUCT_ID = $el->Add($arLoadProductArray))
$s++;
    else
	echo "Error: ".$el->LAST_ERROR;
	  }
     }
    }
     
    echo 'Added '.$s.' news!';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>