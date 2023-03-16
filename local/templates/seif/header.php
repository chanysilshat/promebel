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
//global $type_client;
//$type_client = preg_match("/(ipad|iphone|android|operamobi|blackberry)/i",$_SERVER['HTTP_USER_AGENT']);
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
<?// if ($type_client != 1) {?>
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
			<div class="m-header-phone" onclick="fosPopup('Заказать звонок','Заказать звонок','ZVONOK');">
            		<?$APPLICATION->IncludeComponent(
            			"bitrix:main.include",
            			"",
            			Array(
            				"AREA_FILE_SHOW" => "file",
            				"AREA_FILE_SUFFIX" => "inc",
            				"EDIT_TEMPLATE" => "",
            			)
            		);?>
            	</div>
			<div class="header-burger" data-item="0">
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
	<nav class="m-menu">
    	<div class="m-menu-main">
    		<ul class="m-menu-items-one" style="height: auto;">
    			<li class="m-menu-item-one">
    				<a href="" class="m-menu-link-one">О компании</a>
    				<ul class="m-menu-items-two">
    					<li class="m-menu-item-two">
    						<a href="/o-kompanii/" class="m-menu-link-two m-menu-link-end">О компании</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/proizvoditeli/" class="m-menu-link-two m-menu-link-end">Производители</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/otzyvy/" class="m-menu-link-two m-menu-link-end">Отзывы</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/novosti/" class="m-menu-link-two m-menu-link-end">Новости</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/prays-list/" class="m-menu-link-two m-menu-link-end">Прайс-лист</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/sertifikaty/" class="m-menu-link-two m-menu-link-end">Документы</a>
    					</li>
    				</ul>
    			</li>
    			<li class="m-menu-item-one">
    				<a href="" class="m-menu-link-one">Каталог</a>
    				<ul class="m-menu-items-two">
    					<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="1">Сейфы</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="2">Медицинская мебель <br>и оборудование</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="3">Металлические мебель</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="4">Металлические стеллажи</a>
    					</li>
    					<!--<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="5">Мобильный архив</a>
    					</li>-->
    					<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="6">Производственная мебель</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="7">Автоматические системы <br>хранения</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="" class="m-menu-link-two" data-item="8">Другая продукция</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/catalog/stellazhi-dlya-sklada-metallicheskie-palletnye/" class="m-menu-link-two m-menu-link-end">Стеллажи для склада <br>металлические паллетные</a>
    					</li>
    				</ul>
    			</li>

    			<li class="m-menu-item-one">
    				<a href="/kak-kupit/" class="m-menu-link-one">Как купить</a>
    			</li>
    			<li class="m-menu-item-one">
    				<a href="/dostavka/" class="m-menu-link-one">Доставка и оплата</a>
    			</li>
    			<li class="m-menu-item-one">
    				<a href="" class="m-menu-link-one">Сервис</a>
    				<ul class="m-menu-items-two">
    					<li class="m-menu-item-two">
    						<a href="/servis/izgotovlenie-pod-zakaz/" class="m-menu-link-two m-menu-link-end">Изготовление под заказ</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/servis/remont-i-vskrytie/" class="m-menu-link-two m-menu-link-end">Ремонт и вскрытие</a>
    					</li>
    					<li class="m-menu-item-two">
    						<a href="/servis/garantiynoe-obsluzhivanie/" class="m-menu-link-two m-menu-link-end">Гарантийное обслуживание</a>
    					</li>
    				</ul>
    			</li>
    			<li class="m-menu-item-one">
    				<a href="/aktsii/" class="m-menu-link-one">Акции</a>
    			</li>
    			<li class="m-menu-item-one">
    				<a href="/kontakty/" class="m-menu-link-one">Контакты</a>
    			</li>
    		</ul>
    			<div class="m-menu-dop" style="height: 0px;">
    				<div class="m-menu-dop-link" data-item="0"></div>
    				<ul class="m-menu-items-three" data-item="1">
    					<li class="m-menu-item-three">
    						<a href="/catalog/seyfy-yevropeyskoy-sertifikatsii/" class="m-menu-link-three">Сейфы Европейской сертификации</a>
    						<a href="/catalog/vzlomostoykie-seyfy-i-klassa/" class="m-menu-link-three">Взломостойкие сейфы I класса</a>
    						<a href="/catalog/vzlomostoykie-seyfy-ii-klassa/" class="m-menu-link-three">Взломостойкие сейфы II класса</a>
    						<a href="/catalog/vzlomostoykie-seyfy-iii-klassa/" class="m-menu-link-three">Взломостойкие сейфы III класса</a>
    						<a href="/catalog/vzlomostoykie-seyfy-iv-klassa/" class="m-menu-link-three">Взломостойкие сейфы IV класса</a>
    						<a href="/catalog/vzlomostoykie-seyfy-v-klassa/" class="m-menu-link-three">Взломостойкие сейфы V класса</a>
    						<a href="/catalog/ognestoykie-seyfy/" class="m-menu-link-three">Огнестойкие сейфы</a>
    						<a href="/catalog/ognestoykie-kartoteki/" class="m-menu-link-three">Огнестойкие картотеки</a>
    						<a href="/catalog/seyfy-sochetayushchie-ognestoykost-i-ustoychivost-k-vzlomu/" class="m-menu-link-three">Сейфы, сочетающие огнестойкость <br>и устойчивость к взлому</a>
    						<a href="/catalog/mebelnye-i-ofisnye-seyfy/" class="m-menu-link-three">Мебельные и офисные сейфы</a>
    						<a href="/catalog/gostinichnye-seyfy/" class="m-menu-link-three">Гостиничные сейфы</a>
    						<a href="/catalog/vstraivaemye-seyfy/" class="m-menu-link-three">Встраиваемые сейфы</a>
    						<a href="/catalog/oruzheynye-shkafy-i-seyfy/" class="m-menu-link-three">Оружейные шкафы и сейфы</a>
    						<a href="/catalog/eksklyuzivnye-seyfy/" class="m-menu-link-three">Эксклюзивные сейфы</a>
    						<a href="/catalog/depozitnye-yacheyki/" class="m-menu-link-three">Депозитные ячейки</a>
    						<a href="/catalog/depozitnye-seyfy/" class="m-menu-link-three">Депозитные сейфы</a>
    						<a href="/catalog/smart-seyfy/" class="m-menu-link-three">SMART-сейфы</a>
    						<a href="/catalog/tempokassy/" class="m-menu-link-three">Темпокассы</a>
    						<a href="/catalog/dopolnitelnye-aksessuary-dlya-seyfov/" class="m-menu-link-three">Дополнительные аксессуары для сейфов</a>
    					</li>
    				</ul>
    				<ul class="m-menu-items-three" data-item="2">
    					<li class="m-menu-item-three">
    						<a href="/catalog/seyfy-termostaty/" class="m-menu-link-three">Сейфы термостаты</a>
    						<a href="/catalog/meditsinskie-shkafy/" class="m-menu-link-three">Медицинские шкафы</a>
    						<a href="/catalog/arkhivnye-meditsinskie-shkafy/" class="m-menu-link-three">Архивные медицинские шкафы</a>
    						<a href="/catalog/meditsinskie-stellazhi-ctm-ms/" class="m-menu-link-three">Медицинские стеллажи CTM MS</a>
    						<a href="/catalog/meditsinskie-shkafy-dlya-razdevalok/" class="m-menu-link-three">Медицинские шкафы для раздевалок</a>
    						<a href="/catalog/kartoteki-meditsinskie/" class="m-menu-link-three">Картотеки медицинские</a>
    						<a href="/catalog/tumby-meditsinskie-podkatnye/" class="m-menu-link-three">Тумбы медицинские подкатные</a>
    						<a href="/catalog/meditsinskie-stoliki/" class="m-menu-link-three">Медицинские столики</a>
    						<a href="/catalog/meditsinskie-krovati/" class="m-menu-link-three">Медицинские кровати</a>
    						<a href="/catalog/kushetki-i-banketki-meditsinskie/" class="m-menu-link-three">Кушетки и банкетки медицинские</a>
    						<a href="/catalog/telezhki-dlya-perevozki-bolnykh/" class="m-menu-link-three">Тележки для перевозки больных</a>
    						<a href="/catalog/aptechki/" class="m-menu-link-three">Аптечки</a>
    						<a href="/catalog/shirmy-i-stoyki/" class="m-menu-link-three">Ширмы и стойки</a>
    					</li>
    				</ul>
    				<ul class="m-menu-items-three" data-item="3">
    					<li class="m-menu-item-three">
    						<a href="/catalog/bukhgalterskie-shkafy/" class="m-menu-link-three">Бухгалтерские шкафы</a>
    						<a href="/catalog/kartoteki/" class="m-menu-link-three">Картотеки</a>
    						<a href="/catalog/shkafy-dlya-ofisa/" class="m-menu-link-three">Шкафы для офиса</a>
    						<a href="/catalog/ognestoykie-shkafy/" class="m-menu-link-three">Огнестойкие шкафы</a>
    						<a href="/catalog/shkafy-dlya-razdevalok-lokery/" class="m-menu-link-three">Шкафы для раздевалок (локеры)</a>
    						<a href="/catalog/modulnye-shkafy-dlya-razdevalok-new/" class="m-menu-link-three">Модульные шкафы для раздевалок new</a>
    						<a href="/catalog/skameyki-garderobnye-i-podstavki/" class="m-menu-link-three">Скамейки гардеробные и подставки</a>
    						<a href="/catalog/tumby-mobilnye/" class="m-menu-link-three">Тумбы мобильные</a>
    						<a href="/catalog/mnogoyashchichnye-shkafy/" class="m-menu-link-three">Многоящичные шкафы</a>
    						<a href="/catalog/kartoteki-bolshikh-formatov/" class="m-menu-link-three">Картотеки больших форматов</a>
    						<a href="/catalog/individualnye-shkafy-kassira/" class="m-menu-link-three">Индивидуальные шкафы кассира</a>
    						<a href="/catalog/abonentskie-shkafy/" class="m-menu-link-three">Абонентские шкафы</a>
    						<a href="/catalog/shkafy-universalnye/" class="m-menu-link-three">Шкафы универсальные</a>
    					</li>
    				</ul>
    				<ul class="m-menu-items-three" data-item="4">
    					<li class="m-menu-item-three">
    						<a href="/catalog/ms-standart-500-kg-na-sektsiyu/" class="m-menu-link-three">MS Standart (500 кг на секцию)</a>
    						<a href="/catalog/ms-strong-750-kg-na-sektsiyu/" class="m-menu-link-three">MS Strong (750 кг на секцию)</a>
    						<a href="/catalog/ms-hard-1000-kg-na-sektsiyu/" class="m-menu-link-three">MS Hard (1000 кг на секцию)</a>
    						<a href="/catalog/ms-pro-3000-kg-na-sektsiyu/" class="m-menu-link-three">MS Pro (3000 кг на секцию)</a>
    						<a href="/catalog/dopolnitelnye-komplektuyushchie-ms/" class="m-menu-link-three">Дополнительные комплектующие MS</a>
    					</li>
    				</ul>
    				<ul class="m-menu-items-three" data-item="5">
    					<li class="m-menu-item-three">
    						<a href="/catalog/metallicheskie-mobilnye-stellazhi-dlya-arkhiva/" class="m-menu-link-three">Металлические мобильные <br>стеллажи для архива</a>
    						<a href="/catalog/mobilnyy-arkhiv-s-elektronnym-upravleniem/" class="m-menu-link-three">Мобильный архив <br>с электронным управлением</a>
    					</li>
    				</ul>
    				<ul class="m-menu-items-three" data-item="6">
    					<li class="m-menu-item-three">
    						<a href="/catalog/verstaki/" class="m-menu-link-three">Верстаки</a>
    						<a href="/catalog/verstaki-serii-garage/" class="m-menu-link-three">Верстаки серии Garage</a>
    						<a href="/catalog/verstaki-serii-master/" class="m-menu-link-three">Верстаки серии MASTER</a>
    						<a href="/catalog/verstaki-serii-profi-w/" class="m-menu-link-three">Верстаки серии Profi W</a>
    						<a href="/catalog/verstaki-serii-expert-ws/" class="m-menu-link-three">Верстаки серии EXPERT WS</a>
    						<a href="/catalog/aksessuary-na-ekran/" class="m-menu-link-three">Аксессуары на экран</a>
    						<a href="/catalog/cushilnye-shkafy/" class="m-menu-link-three">Cушильные шкафы</a>
    						<a href="/catalog/telezhki-instrumentalnye/" class="m-menu-link-three">Тележки инструментальные</a>
    						<a href="/catalog/shkafy-instrumentalnye-legkie-ts/" class="m-menu-link-three">Шкафы инструментальные легкие ТС</a>
    						<a href="/catalog/shkafy-instrumentalnye-tyazhelye-amh-tc/" class="m-menu-link-three">Шкафы инструментальные тяжелые AMH TC</a>
    						<a href="/catalog/tyazhelye-modulnye-shkafy-serii-hard/" class="m-menu-link-three">Тяжелые модульные шкафы серии HARD</a>
    						<a href="/catalog/cpetsializirovannye-shkafy/" class="m-menu-link-three">Специализированные шкафы</a>
    						<a href="/catalog/tumby/" class="m-menu-link-three">Тумбы</a>
    						<a href="/catalog/stulya-promyshlennye/" class="m-menu-link-three">Стулья промышленные</a>
    					</li>
    				</ul>
    				<ul class="m-menu-items-three" data-item="7">
    					<li class="m-menu-item-three">
    						<a href="/catalog/avtomaticheskie-kamery-khraneniya/" class="m-menu-link-three">Автоматические камеры хранения</a>
    						<a href="/catalog/klyuchnitsy/" class="m-menu-link-three">Ключницы</a>
    					</li>
    				</ul>
    				<ul class="m-menu-items-three" data-item="8">
    					<li class="m-menu-item-three">
    						<a href="/catalog/keshboksy/" class="m-menu-link-three">Кэшбоксы</a>
    						<a href="/catalog/pochtovye-yashchiki/" class="m-menu-link-three">Почтовые ящики</a>
    						<a href="/catalog/klyuchnitsa/" class="m-menu-link-three">Ключницы</a>
    					</li>
    				</ul>
    			</div>
    		</div>

    		<div class="m-menu-phone">
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
    	</nav>
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

<?/*}else{?>
	<?$APPLICATION->IncludeFile('/bitrix/templates/seif/include-template-mobile/header.php');?>
<?}*/?>