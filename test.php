<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");

?>

<?$APPLICATION->IncludeComponent(
	"gramor:search",
	"search",
	Array(
		"SEARCH" => $_REQUEST["search"],
		"IBLOCK_ID" => 2,
	)
);?>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>