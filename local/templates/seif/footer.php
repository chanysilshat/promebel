<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<? //if ($type_client != 1) {?>

		<?if($APPLICATION->GetCurPage() != '/'):?>
			<?if((CSite::InDir('/catalog/')) && ($pieces[3]!="")):?>
			<?elseif((CSite::InDir('/catalog/')) && ($pieces[3]=="")):?>
				</div>
			<?else:?>
					</div>
				</div>
			<?endif;?>
		<?endif;?>
		<div class="consultation">

			<div class="block-main consultation-main">
				<div class="consultation-block">
					<div>
						<div class="consultation-info">
							<div class="title consultation-title">Бесплатная консультация</div>
							<div class="consultation-preview">Заполните поля и мы Вам перезвоним в течение 5 минут</div>
							<div class="consultation-form">
								<label>Ваше имя</label>
								<input type="text" class="consultation-form-input" id="cons-name" placeholder="Введите имя">
							</div>
							<div class="consultation-form">
								<label>Ваш номер телефона</label>
								<input type="text" class="consultation-form-input" id="cons-phone" placeholder="+ 7 (800) 555 - 35 -35">
							</div>
							<div class="consultation-bottom">
								<div class="consultation-polit">
									Нажимая на кнопку, Вы соглашаетесь на обработку <a href="/politika-konfidentsialnosti/" target="_blank">персональных данных.</a>
								</div>
								<div class="btn consultation-btn" onclick="fos('Бесплатная консультация','FIXEDFOS');">Отправить</div>
							</div>
							<input type="hidden" id="cons-page" value="<?=$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>">
						</div>
					</div>
					<!--<div class="consultation-img"></div>-->
				</div>
		
			</div>
			<div class="background-slider">
				<img src="/upload/s-back.png">
				<img class="img-slider" src="/upload/phone.png">

			</div>
			<div class="background-slider-color">
			</div>
		</div>
	</div>
	<footer>
		<div class="footer-1">
			<div class='block-main'>
				<div class="footer-info">
					<?if($APPLICATION->GetCurPage() == '/'):?>
						<div class="footer-logo">
							<svg width="160" height="55">
								<use xlink:href="#logo"></use>
							</svg>
							<!--<div class="footer-logo-text">
								Интернет-магазин<br> сейфов и<br> металлической мебели
							</div>-->
						</div>
					<?else:?>
						<a href="/" class="footer-logo">
							<svg width="244" height="80">
								<use xlink:href="#logo"></use>
							</svg>
							<!--<div class="footer-logo-text">
								Интернет-магазин<br> сейфов и<br> металлической мебели
							</div>-->
						</a>
					<?endif;?>
					<a href="/kontakty/" class="footer-address">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/bitrix/templates/seif/include/file/address.php"
							)
						);?>
					</a>
					<div class="footer-mail">
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
					<div class="footer-phone">
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
				</div>
				<nav class="footer-menu">
					<ul>
						<li>
							<a href="/o-kompanii/" class="footer-menu-gl">О компании</a>
							<a href="/proizvoditeli/" class="footer-menu-link">Производители</a>
							<a href="/otzyvy/" class="footer-menu-link">Отзывы</a>
							<a href="/novosti/" class="footer-menu-link">Новости</a>
							<a href="/prays-list/" class="footer-menu-link">Прайс-лист</a>
							<a href="/sertifikaty/" class="footer-menu-link">Документы</a>
							<?/*?><a href="/stati/" class="footer-menu-link">Статьи</a><?*/?>
						</li>
					</ul>
					<ul>
						<li>
							<a href="/catalog/" class="footer-menu-gl">Каталог</a>
							<a href="/catalog/seyfy/" class="footer-menu-link">Сейфы</a>
							<a href="/catalog/meditsinskaya-mebel-i-oborudovanie/" class="footer-menu-link">Медицинская мебель и оборудование</a>
							<a href="/catalog/metallicheskie-mebel/" class="footer-menu-link">Металлическая мебель</a>
							
							<a href="/catalog/metallicheskie-stellazhi/" class="footer-menu-link">Металлические стеллажи</a>
							<!--<a href="/catalog/mobilnyy-arkhiv/" class="footer-menu-link">Мобильный архив</a>-->
							<a href="/catalog/proizvodstvennaya-mebel/" class="footer-menu-link">Производственная мебель</a>
							<a href="/catalog/avtomaticheskie-sistemy-khraneniya-/" class="footer-menu-link">Автоматические системы хранения</a>
							<a href="/catalog/drugaya-produktsiya/" class="footer-menu-link">Другая продукция</a>
							<a href="/catalog/stellazhi-dlya-sklada-metallicheskie-palletnye/" class="footer-menu-link">
								Стеллажи для склада металлические паллетные
							</a>
						</li>
					</ul>
					<ul>
						<li>
							<a href="/servis/" class="footer-menu-gl">Сервис</a>
							<a href="/servis/izgotovlenie-pod-zakaz/" class="footer-menu-link">Изготовление под заказ</a>
							<a href="/servis/remont-i-vskrytie/" class="footer-menu-link">Ремонт и вскрытие</a>
							<a href="/servis/garantiynoe-obsluzhivanie/" class="footer-menu-link">Гарантийное обслуживание</a>
						</li>
					</ul>
					<ul>
						<li>
							<div class="footer-menu-gl">Информация</div>
							<a href="/kak-kupit/" class="footer-menu-link">Как купить</a>
							<a href="/dostavka/" class="footer-menu-link">Доставка и оплата</a>
							<a href="/aktsii/" class="footer-menu-link">Акции</a>
							<a href="/kontakty/" class="footer-menu-link">Контакты</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		
	</footer>
<?/*}else{?>
	<?$APPLICATION->IncludeFile('/bitrix/templates/seif/include-template-mobile/footer.php');?>
<?}*/?>
<?
    use Bitrix\Sale;
    CModule::IncludeModule("iblock");
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
    $basket = \Bitrix\Sale\Basket::loadItemsForFUser(
	   \Bitrix\Sale\Fuser::getId(), 
	   \Bitrix\Main\Context::getCurrent()->getSite()
	);
    $basketItems = $basket->getBasketItems();
    $basket_count = count($basketItems);
?>
<div class="fixed">
	<a href="/cart/" class="fixed-basket">
		<svg width="24" height="20">
	        <use xlink:href="#basket"></use>
	    </svg>
	    <?/*if($basket_count > 0):*/?>
	    	<span class="fixed-basket-val">+<?=$basket_count?></span>
	    <?/*endif;*/?>
	</a>
	<a href="/izbrannoe/" class="fixed-izbr">
		<svg width="22" height="20">
	        <use xlink:href="#izbr"></use>
	    </svg>
	    <span class="fixed-izbr-val">+0</span>
	</a>
	<a href="/sravnenie/" class="fixed-sravn">
		<svg width="22" height="20">
	        <use xlink:href="#sravnenie"></use>
	    </svg>
	    <span class="fixed-sravn-val">+0</span>
	</a>
	<a href="/search/" class="fixed-search">
		<svg width="20" height="20">
	        <use xlink:href="#search"></use>
	    </svg>
	</a>
</div>
<div class="scroll-top">
	<svg width="24" height="29">
        <use xlink:href="#scroll-top"></use>
    </svg>
</div>
<div class="popup-basket">
	<div class="popup-main">
		<div class="popup-basket-close">x</div>
		<div class="popup-basket-text">Товар добавлен в корзину</div>
		<div class="popup-basket-btn">
			<div class="btn popup-basket-btn-val popup-basket-js">Продолжить покупки</div>
			<a href="/cart/" class="btn popup-basket-btn-val">Перейти в корзину</a>
		</div>
	</div>
</div>
<div class="popup-form">
	<div class="popup-form-main">
		<div class="popup-form-close">x</div>
		<div class="popup-form-block">
			<div class="popup-form-title">Нашли дешевле?</div>
			<input class="popup-form-input" id="form-name" placeholder="Ваше имя*">
			<input class="popup-form-input" id="form-phone" placeholder="Ваш номер телефона*">
			<textarea class="popup-form-textarea" id="form-text" placeholder="Текст сообщения"></textarea>
			<div class="popup-form-polit">
				Нажимая на кнопку, Вы соглашаетесь на обработку <a href="/politika-konfidentsialnosti/" target="_blank">персональных данных.</a>
			</div>
			<input type="hidden" id="form-metrika">
			<input type="hidden" id="form-page" value="<?=$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>">
			<input type="hidden" id="form-tema">
			<div class="btn popup-form-btn" onclick="fosPopupSend();">Отправить</div>
		</div>
	</div>
</div>
<div class="popup-tovar">
	<div class="popup-tovar-main">
		<div class="popup-tovar-close">x</div>
		<div class="popup-tovar-block">
			<div class="popup-tovar-title">Купить в 1 клик</div>
			<input class="popup-tovar-input" id="form-tovar-name" placeholder="Ваше имя*">
			<input class="popup-tovar-input" id="form-tovar-phone" placeholder="Ваш номер телефона*">
			<textarea class="popup-tovar-textarea" id="form-tovar-text" placeholder="Текст сообщения"></textarea>
			<div class="popup-tovar-polit">
				Нажимая на кнопку, Вы соглашаетесь на обработку <a href="/politika-konfidentsialnosti/" target="_blank">персональных данных.</a>
			</div>
			<input type="hidden" id="form-tovar-metrika">
			<input type="hidden" id="form-tovar-page" value="<?=$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>">
			<input type="hidden" id="form-tovar-tema">
			<input type="hidden" id="form-tovar-val">
			<input type="hidden" id="form-tovar-price">
			<input type="hidden" id="form-tovar-count">
			<div class="btn popup-tovar-btn" onclick="fosTovarSend();">Отправить</div>
		</div>
	</div>
</div>
<!-- Микроразметка schema.org -->
<div itemscope itemtype="http://schema.org/Organization" class="none"><span itemprop="name"></span>
  Телефон:<span itemprop="telephone"></span>,
  Электронная почта: <span itemprop="email"></span>
</div>
<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/svg.php');?>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="<?=SITE_TEMPLATE_PATH.'/js/lightbox-plus-jquery.min.js'?>"></script>
<script src="<?=SITE_TEMPLATE_PATH.'/js/slick.min.js'?>"></script>
<script src="<?=SITE_TEMPLATE_PATH.'/js/jquery.maskedinput.min.js'?>"></script>
<script src="<?=SITE_TEMPLATE_PATH.'/js/main.js?v=8.11'?>"></script>
<script src="<?=SITE_TEMPLATE_PATH.'/js/dd-script.js'?>"></script>
<? /*if ($type_client == 1) {?>
	<script src="<?=SITE_TEMPLATE_PATH.'/js/main-mobile.js?v=2'?>"></script>
<?}*/?>
</body>
</html>