<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	use \Bitrix\Main\Page\Asset;

	$Asset = Asset::getInstance();
?>
<!DOCTYPE html>
<html lang="ru" prefix="og: https://ogp.me/ns#">
<head>

	<?
		$Asset->addCss(SITE_TEMPLATE_PATH.'/fonts/stylesheet.css');
		$Asset->addCss(SITE_TEMPLATE_PATH."/css/style.css");
	?>
<?
global $type_client;
$type_client = preg_match("/(ipad|iphone|android|operamobi|blackberry)/i",$_SERVER['HTTP_USER_AGENT']);
?>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=yes">
<meta property = "og:title" content = '<?$APPLICATION->ShowTitle()?>' />
<meta property = "og:image" content = "/" />
<meta property = "og:type" content = "website" />
<meta property = "og:description" content = "<?=$APPLICATION->GetProperty("description")?>" />	
<meta property = "og:url" content = "https://pro-mebelrf.ru/<?=$curPage?>" />	

<meta name="yandex-verification" content="3ebef7e6575bbdec" />

<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<?$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);?>
<?/*<link rel="canonical" href="https://pro-mebelrf.ru<?=$uri_parts[0]?>" />*/?>
<?$APPLICATION->ShowHead();?>
<title><?$APPLICATION->ShowTitle()?></title>
<script type="application/ld+json">
{
"@context": "https://schema.org/",
"@type": "Organization",
"name": "",
"telephone": "",
"email": ""
}
</script>
<style>
@font-face {
    font-family: 'Ubuntu';
    font-display: swap;
    src: local('Ubuntu'), url('/bitrix/templates/seif/font/ubuntu.woff2') format('woff2'), url('/bitrix/templates/seif/font/ubuntu.woff') format('woff');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'Ubuntu';
    font-display: swap;
    src: local('Ubuntu Medium'), local('Ubuntu-Medium'), url('/bitrix/templates/seif/font/ubuntumedium.woff2') format('woff2'), url('/bitrix/templates/seif/font/ubuntumedium.woff') format('woff');
    font-weight: 500;
    font-style: normal;
}
@font-face {
    font-family: 'Ubuntu';
    font-display: swap;
    src: local('Ubuntu Bold'), local('Ubuntu-Bold'), url('/bitrix/templates/seif/font/ubuntubold.woff2') format('woff2'), url('/bitrix/templates/seif/font/ubuntubold.woff') format('woff');
    font-weight: 700;
    font-style: normal;
}
.none{
	display: none
}
div, a{
	box-sizing: border-box;
}
</style>
<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/page_speed.php";
includeCSS(SITE_TEMPLATE_PATH."/css/normalize.css");
includeCSS(SITE_TEMPLATE_PATH."/css/lightbox.min.css");
includeCSS(SITE_TEMPLATE_PATH."/css/slick.css");
includeCSS(SITE_TEMPLATE_PATH."/css/slick-theme.css");
includeCSS(SITE_TEMPLATE_PATH."/css/style.css");
includeCSS(SITE_TEMPLATE_PATH."/css/ir-style.css");
includeCSS(SITE_TEMPLATE_PATH."/css/r-style.css");
includeCSS(SITE_TEMPLATE_PATH."/css/dd-style.css");
includeCSS(SITE_TEMPLATE_PATH."/css/rework.css");
?> 

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-214946553-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-214946553-1');
</script>

<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(75076681, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); </script>  <!-- /Yandex.Metrika counter -->
</head>
<body>
<noscript><div><img src="https://mc.yandex.ru/watch/75076681" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<?$APPLICATION->Showpanel();?> 
<?
    $pizza=$APPLICATION->GetCurPage();
    $pieces = explode("/", $pizza);
?>
<?
CModule::IncludeModule('iblock');
$arFilter = array(		
    'ACTIVE' => 'Y',
    'IBLOCK_ID' => 2,
    'GLOBAL_ACTIVE'=>'Y',
);
$arSelect = array('IBLOCK_ID','ID','NAME','DEPTH_LEVEL','IBLOCK_SECTION_ID','SECTION_PAGE_URL','PICTURE');
$arOrder = array('DEPTH_LEVEL'=>'ASC','SORT'=>'ASC');
$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
$sectionLinc = array();
$arResult['ROOT'] = array();
$sectionLinc[0] = &$arResult['ROOT'];
while($arSection = $rsSections->GetNext()) {
    $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
    $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
}
?>
<? if ($type_client != 1) {?>
<header>
	<div class="header">
		<?if($APPLICATION->GetCurPage() == '/'):?>
			<div class="header-logo">
				<svg width="186" height="60">
			        <use xlink:href="#logo"></use>
			    </svg>
				<a href="/search/" class="fixed-search">
					<svg width="20" height="20">
						<use xlink:href="#search"></use>
					</svg>
				</a>
		    	<!--<div class="header-logo-text">
			    	Интернет-магазин<br> сейфов и<br> металлической мебели
			    </div>-->
			</div>
		<?else:?>
			<div>
			<a href="/" class="header-logo">
				<svg width="186" height="60">
			        <use xlink:href="#logo"></use>
			    </svg>
			</a>

				<a href="/search/" class="fixed-search">
					<svg width="20" height="20">
						<use xlink:href="#search"></use>
					</svg>
				</a>
			    <!--<div class="header-logo-text">
			    	Интернет-магазин<br> сейфов и<br> металлической мебели
			    </div>-->
			</div>
		<?endif;?>
		<nav>
			<ul class="header-nav">
			
				<li>
					<a href="/catalog/" class="header-nav-link-one">Каталог</a>
					<ul>
						<?foreach($sectionLinc[0]['CHILD'] as $key => $value):?>
							<li>
								<a href="<?=$value['SECTION_PAGE_URL']?>" class="header-nav-link-two"><?=$value['NAME']?></a>
								<?if($value['CHILD']):?>
									<ul>
										<?foreach($value['CHILD'] as $key => $value1):?>
											<?if($value1):?>
												<li>
													<a href="<?=$value1['SECTION_PAGE_URL']?>" class="header-nav-link-three"><?=$value1['NAME']?></a>
												</li>
											<?endif;?>
										<?endforeach;?>
									</ul>
								<?endif;?>
							</li>
						<?endforeach;?>
					</ul>
				</li>
				<li>
					<a href="/kak-kupit/" class="header-nav-link-one">Как купить</a>
				</li>
				<li>
					<a href="/dostavka/" class="header-nav-link-one">Доставка и оплата</a>
				</li>
				<li>
					<a href="/servis/" class="header-nav-link-one">Сервис</a>
					<ul>
						<li>
							<a href="/servis/izgotovlenie-pod-zakaz/" class="header-nav-link-two">Изготовление под заказ</a>
						</li>
						<li>
							<a href="/servis/remont-i-vskrytie/" class="header-nav-link-two">Ремонт и вскрытие</a>
						</li>
						<li>
							<a href="/servis/garantiynoe-obsluzhivanie/" class="header-nav-link-two">Гарантийное обслуживание</a>
						</li>
					</ul>
				</li>
				<!--<li>
					<a href="/aktsii/" class="header-nav-link-one">Акции</a>
				</li>-->
				<li>
					<a href="/o-kompanii/" class="header-nav-link-one">О компании</a>
					<ul>
						<li>
							<a href="/proizvoditeli/" class="header-nav-link-two">Производители</a>
						</li>
						<li>
							<a href="/otzyvy/" class="header-nav-link-two">Отзывы</a>
						</li>
						<li>
							<a href="/novosti/" class="header-nav-link-two">Новости</a>
						</li>
						<li>
							<a href="/prays-list/" class="header-nav-link-two">Прайс-лист</a>
						</li>
						<li>
							<a href="/sertifikaty/" class="header-nav-link-two">Документы</a>
						</li>
						<li>
							<a href="/aktsii/" class="header-nav-link-two">Акции</a>
						</li>
						<?/*?><li>
							<a href="/stati/" class="header-nav-link-two">Статьи</a>
						</li><?*/?>
					</ul>
				</li>
				<li>
					<a href="/kontakty/" class="header-nav-link-one">Контакты</a>
				</li>
			</ul>
		</nav>
		<div class="header-contact">
			<!--<svg width="30" height="30">
		        <use xlink:href="#phone"></use>
		    </svg>-->
		    <div class="header-contact-main">
		    	<div class="header-phone">
		    		<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/bitrix/templates/seif/include/file/phone.php"
						)
					);?>
		    	</div>
		    	<div class="header-fos" onclick="fosPopup('Заказать звонок','Заказать звонок','ZVONOK');">Заказать звонок</div>
		    	<div class="header-mail">
		    		<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/bitrix/templates/seif/include/file/mail.php"
						)
					);?>
		    	</div>
		    </div>
		</div>
		<div class="header-burger">
			<span></span>
		</div>
	</div>
</header>
<div class="menu-mob">
	<div class="menu-mob-close">x</div>
	<ul>
		<li>
			<a href="/o-kompanii/" class="header-nav-link-one">О компании</a>
		</li>
		<li>
			<a href="/proizvoditeli/" class="header-nav-link-one">Производители</a>
		</li>
		<li>
			<a href="/otzyvy/" class="header-nav-link-one">Отзывы</a>
		</li>
		<li>
			<a href="/novosti/" class="header-nav-link-one">Новости</a>
		</li>
		<li>
			<a href="/prays-list/" class="header-nav-link-one">Прайс-лист</a>
		</li>
		<li>
			<a href="/sertifikaty/" class="header-nav-link-two">Документы</a>
		</li>
		<li>
			<a href="/catalog/" class="header-nav-link-one">Каталог</a>
		</li>
		<li>
			<a href="/kak-kupit/" class="header-nav-link-one">Как купить</a>
		</li>
		<li>
			<a href="/dostavka/" class="header-nav-link-one">Доставка и оплата</a>
		</li>
		<li>
			<a href="/servis/" class="header-nav-link-one">Сервис</a>
		</li>
		<li>
			<a href="/servis/izgotovlenie-pod-zakaz/" class="header-nav-link-one">Изготовление под заказ</a>
		</li>
		<li>
			<a href="/servis/remont-i-vskrytie/" class="header-nav-link-one">Ремонт и вскрытие</a>
		</li>
		<li>
			<a href="/servis/garantiynoe-obsluzhivanie/" class="header-nav-link-one">Гарантийное обслуживание</a>
		</li>
		<li>
			<a href="/aktsii/" class="header-nav-link-one">Акции</a>
		</li>
		<li>
			<a href="/kontakty/" class="header-nav-link-one">Контакты</a>
		</li>
	</ul>
</div>
<div class="main">
	<?if($APPLICATION->GetCurPage() == '/'):?>
		<div class="slider-main">
			<div class="slider">
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "slider", Array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
						"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
						"AJAX_MODE" => "N",	// Включить режим AJAX
						"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
						"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
						"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
						"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
						"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
						"CACHE_GROUPS" => "Y",	// Учитывать права доступа
						"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
						"CACHE_TYPE" => "A",	// Тип кеширования
						"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
						"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
						"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
						"DISPLAY_DATE" => "Y",	// Выводить дату элемента
						"DISPLAY_NAME" => "Y",	// Выводить название элемента
						"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
						"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
						"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
						"FIELD_CODE" => array(	// Поля
							0 => "",
							1 => "HREF",
							2 => "PREVIEW",
						),
						"FILTER_NAME" => "",	// Фильтр
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
						"IBLOCK_ID" => "1",	// Код информационного блока
						"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
						"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
						"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
						"NEWS_COUNT" => "10",	// Количество новостей на странице
						"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
						"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
						"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
						"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
						"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
						"PAGER_TITLE" => "Новости",	// Название категорий
						"PARENT_SECTION" => "",	// ID раздела
						"PARENT_SECTION_CODE" => "",	// Код раздела
						"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
						"PROPERTY_CODE" => array(	// Свойства
							0 => "",
							1 => "HREF",
							2 => "PREVIEW",
						),
						"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
						"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
						"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
						"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
						"SET_STATUS_404" => "N",	// Устанавливать статус 404
						"SET_TITLE" => "N",	// Устанавливать заголовок страницы
						"SHOW_404" => "N",	// Показ специальной страницы
						"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
						"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
						"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
						"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
						"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
					),
					false
				);?>
			</div>
			<div class='slider-inner'><div class="slider-count">01</div></div>
		</div>
	<?endif;?>
	<?if($APPLICATION->GetCurPage() != '/'):?>
		<?if((CSite::InDir('/catalog/')) && ($pieces[3]!="")):?>
			<div class="container-cat-detail">
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
					"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0",
					),
					false
				);?>
			</div>
		<?elseif((CSite::InDir('/catalog/')) && ($pieces[3]=="")):?>
			<div class="container">
		<?else:?>
			<div class="container">
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
					"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0",
					),
					false
				);?>
				<div class="container-title"><?=$APPLICATION->ShowTitle(false)?></div>
					<div class="container-main">
		<?endif;?>
	<?endif;?>

<?}else{?>
	<?$APPLICATION->IncludeFile('/bitrix/templates/seif/include-template-mobile/header.php');?>
<?}?>