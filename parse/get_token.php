<?php ob_start(); ?>
<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 3600');    // cache for 1 day
}
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();
CModule::IncludeModule("iblock");


if ($_POST['token']){

$el = new CIBlockElement;
$PROP = array();


$arLoadProductArray = Array(  
  "MODIFIED_BY"    => $USER->GetID(), 
  "IBLOCK_SECTION_ID" => "",
  "IBLOCK_ID"      => "41",
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $_POST['token'],
  "ACTIVE"         => "Y",            
  "PREVIEW_TEXT"   => "",
  "DETAIL_TEXT"    => "",
  "PREVIEW_PICTURE" => $arIMAGE
  );
//создание элемента инфоблока резюме
if($PRODUCT_ID = $el->Add($arLoadProductArray))
{//если успешно добавлен
  
$name = $_POST["name"];
$arParams = array("replace_space"=>"_","replace_other"=>"_");
$trans = Cutil::translit($name,"ru",$arParams);
$id1=$PRODUCT_ID;
$trans=$trans."_".$id1;
$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), 
  "IBLOCK_SECTION_ID" => "",
  "IBLOCK_ID"      => 41,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $_POST["token"],
  "ACTIVE"         => "Y",            
  "PREVIEW_TEXT"   => "",
  "DETAIL_TEXT"    => "",
  "PREVIEW_PICTURE" => $arIMAGE,
  "CODE"=>$trans,
  "DATE_ACTIVE_FROM"    => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time()+7200),
  );
$res = $el->Update($PRODUCT_ID,$arLoadProductArray);	
}
else{//если неуспешно
  echo "Произошла ошибка добавления";
  echo $el->LAST_ERROR;
}

}


?>