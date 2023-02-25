<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Изготовление под заказ");
?>
<div class="catalog">
	<div class="catalog-menu mobile">
		<div class="catalog-menu-mobile-title">Меню</div>
		<ul class="catalog-menu-mobile-menu">
			<li>
				<div class="catalog-menu-mobile-link">Сервис</div>
				<ul>
					<li class="catalog-menu-mobile-link"><a href="/servis/izgotovlenie-pod-zakaz/">Изготовление под заказ</a></li>
					<li><a href="/servis/remont-i-vskrytie/">Ремонт и вскрытие</a></li>
					<li><a href="/servis/garantiynoe-obsluzhivanie/">Гарантийное обслуживание</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="catalog-menu content-menu desktop">
		<ul class="catalog-menu-one">
			<li class="active">
				<a href="/servis/izgotovlenie-pod-zakaz/" class="catalog-menu-link-one">Изготовление под заказ</a>
			</li>
			<li>
				<a href="/servis/remont-i-vskrytie/" class="catalog-menu-link-one">Ремонт и вскрытие</a>
			</li>
			<li>
				<a href="/servis/garantiynoe-obsluzhivanie/" class="catalog-menu-link-one">Гарантийное обслуживание</a>
			</li>
		</ul>
	</div>
	<div class="content">
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/include/izgotovlenie-pod-zakaz.php"
		)
	);?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>