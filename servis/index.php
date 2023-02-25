<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сервис");
?>
<div class="block-main company-main service-main">
	<div class="company-main-block service">
		<a href="/servis/izgotovlenie-pod-zakaz/" class="company-main-panel">
			<div class="company-main-panel-icon-1"></div>
		    <div class="company-main-panel-text">Изготовление под заказ	</div>
		</a>
		<a href="/servis/remont-i-vskrytie/" class="company-main-panel">
			<div class="company-main-panel-icon-2"></div>
		    <div class="company-main-panel-text">Ремонт и вскрытие</div>
		</a>
		<a href="/servis/garantiynoe-obsluzhivanie/" class="company-main-panel">
			<div class="company-main-panel-icon-3"></div>
		    <div class="company-main-panel-text">Гарантийное обслуживание</div>
		</a>
	</div>
</div>
<div class="content">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/servis.php"
	)
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>