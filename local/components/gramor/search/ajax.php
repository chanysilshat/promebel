<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent(
	"gramor:search",
	"search",
	Array(
		"SEARCH_MODE" => "Y",
        "SEARCH" => $_REQUEST["search"],
        "IBLOCK_ID" => 2,
	)
);?>