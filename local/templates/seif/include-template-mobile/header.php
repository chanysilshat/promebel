<header class="m-header">
	<div class="m-header-burger" data-item="0">
		<svg width="23" height="17">
	        <use xlink:href="#m-burger"></use>
	    </svg>
	</div>
	<?if($APPLICATION->GetCurPage() == '/'):?>
		<svg width="99" height="32" class="m-header-logo">
	        <use xlink:href="#logo-mobile"></use>
	    </svg>
	<?else:?>
		<a href="/">
			<svg width="99" height="32" class="m-header-logo">
		        <use xlink:href="#logo-mobile"></use>
		    </svg>
		</a>
	<?endif;?>
	<div class="m-header-phone">
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
</header>
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
	<?if($APPLICATION->GetCurPage() != '/'):?>
		<div class="container">
			<div class="container-title"><?=$APPLICATION->ShowTitle(false)?></div>
	<?endif;?>