<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Производители");
?><div class="catalog">
	<div class="catalog-menu mobile">
		<div class="catalog-menu-mobile-title">Меню</div>
		<ul class="catalog-menu-mobile-menu">
			<li>
				<div class="catalog-menu-mobile-link">О компании</div>
				<ul>
					<li class="catalog-menu-mobile-link"><a href="/proizvoditeli/">Производители</a></li>
					<li><a href="/otzyvy/">Отзывы</a></li>
					<li><a href="/novosti/">Новости</a></li>
					<li><a href="/prays-list/">Прайс-лист</a></li>
					<li><a href="/sertifikaty/">Документы</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="catalog-menu content-menu desktop">
		<ul class="catalog-menu-one">
			<li class="active"> <a class="catalog-menu-link-one" href="/proizvoditeli/">Производители</a> </li>
			<li> <a class="catalog-menu-link-one" href="/otzyvy/">Отзывы</a> </li>
			<li> <a class="catalog-menu-link-one" href="/novosti/">Новости</a> </li>
			<li> <a class="catalog-menu-link-one" href="/prays-list/">Прайс-лист</a> </li>
			<li> <a href="/sertifikaty/" class="catalog-menu-link-one">Документы</a> </li>
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
		"PATH" => "/include/proizvoditeli.php"
	)
);?>
	</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>