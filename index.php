<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
\Bitrix\Main\Loader::includeModule('iblock');
$ip = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();
Asset::getInstance()->addJs("/bitrix/js/nt.module/like.js");
$arFilter = Array("IBLOCK_ID"=>54,);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
//print_r($res);
$res->NavStart(0);?>
<table id='votetable'>
 <?while($ob = $res->GetNextElement())
{$arFields = $ob->GetFields(); 
$arProps=$ob->GetProperties();
 $img_path = '/upload/iblock/rssnews/'.$arProps[IMG][VALUE];
?>
<tr>
	<td>
<?
print("<DIV>".$arProps[1067][VALUE]."</DIV>");
 //print("<DIV>".$arProps[1068][VALUE]."</DIV>");
print("<DIV>".$arProps[TITLE][VALUE]."</DIV>");
print("<DIV>".$arProps[PUBDATE][VALUE]."</DIV>");
print("<DIV>".$arProps[DESCRIPTION][VALUE]."</DIV>");
print("<DIV>* ".$arProps[TAG][VALUE]."</DIV>");
?>
	</td>
	<td>
<?echo "<img src='".$img_path."' alt=''><br>";?>
<?

print("<div class='wrapvote' id=".$arFields[ID].">");
 //если голосовал раньше
 if (Loader::includeModule('nt.module')) {
$arRes=\Nt\Module\Helpers\hload::load($arFields[ID],$ip);
 }
if ($arRes == "0") {print("<div>No</div>");}
elseif ($arRes == "1") {print("<div>Yes</div>");}
 //если не голосовал раньше
 else{
print("<div class='like' id=".$arFields[ID].">
 <a href='javascript:void(0);'>Да</a>
		</div>
		<div class='dislike' id=".$arFields[ID].">
 <a href='javascript:void(0);'>Нет</a>
			</div>");
 }
print("</div>");
?>
	</td>
</tr>
<?}?>

</table>
<?echo $res->NavPrint("Новости");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>