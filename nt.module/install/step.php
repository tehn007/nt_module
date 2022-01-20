<?
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(!check_bitrix_sessid()){

   return;
}

if($errorException = $APPLICATION->GetException()){

  echo(CAdminMessage::ShowMessage($errorException->GetString()));
}else{

    echo(CAdminMessage::ShowNote(Loc::getMessage("STEP_BEFORE")." ".Loc::getMessage("STEP_AFTER")));
}
?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>">
  <input type="hidden" name="lang" value="<? echo(LANG); ?>" />
 <input type="submit" value="<? echo(Loc::getMessage("STEP_SUBMIT_BACK")); ?>">
</form>