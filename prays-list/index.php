<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Прайс-лист");
?>
<div class="catalog">
	<div class="catalog-menu mobile">
		<div class="catalog-menu-mobile-title">Меню</div>
		<ul class="catalog-menu-mobile-menu">
			<li>
				<div class="catalog-menu-mobile-link">О компании</div>
				<ul>
					<li><a href="/proizvoditeli/">Производители</a></li>
					<li><a href="/otzyvy/">Отзывы</a></li>
					<li><a href="/novosti/">Новости</a></li>
					<li class="catalog-menu-mobile-link"><a href="/prays-list/">Прайс-лист</a></li>
					<li><a href="/sertifikaty/">Документы</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="catalog-menu content-menu desktop">
		<ul class="catalog-menu-one">
			<li>
				<a href="/proizvoditeli/" class="catalog-menu-link-one">Производители</a>
			</li>
			<li>
				<a href="/otzyvy/" class="catalog-menu-link-one">Отзывы</a>
			</li>
			<li>
				<a href="/novosti/" class="catalog-menu-link-one">Новости</a>
			</li>
			<li class="active">
				<a href="/prays-list/" class="catalog-menu-link-one">Прайс-лист</a>
			</li>
			<li>
				<a href="/sertifikaty/" class="catalog-menu-link-one">Документы</a>
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
			"PATH" => "/include/prays-list.php"
		)
	);?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>