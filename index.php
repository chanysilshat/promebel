<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?>
<? if ($type_client != 1) {?>

<?global $USER?>
<?
	if ($USER->isAdmin()){
		//echo "<pre>"; print_r($sectionLinc[0]['CHILD']); echo "</pre>";
	}
?>
<div class="block-main">
	<div class="title">Каталог</div>
	<div class="cat-main-block">
		<?foreach($sectionLinc[0]['CHILD'] as $key => $value):
			$img = CFile::GetPath($value["PICTURE"]);?>
			<div class="cat-main-panel">
				<?/*if (count($value["CHILD"]) == 0):?>
					<a class="empty_cat-main-panel" href="<?=$value["SECTION_PAGE_URL"]?>">
				<?endif*/?>

					<a class="empty_cat-main-panel" href="<?=$value["SECTION_PAGE_URL"]?>">
		
				<div class="cat-main-img" style="background: url(<?=$img?>)no-repeat 50%;background-size:contain;"></div>
				<div class="cat-main-text"><?=$value['NAME']?></div>
				<?if (count($value["CHILD"]) > 0):?>
				<div class="cat-main-hover-block">
					<div class="cat-main-hover-title"><?=$value['NAME']?></div>
					
						<ul class="cat-main-hover-list">
							<?foreach ($value["CHILD"] as $child):?>
								<li><a href="<?=$child['SECTION_PAGE_URL']?>" class="cat-main-hover-item"><?=$child['NAME']?></a></li>

							<?endforeach?>
						</ul>
				</div>
				<?endif?>
				<?/*if (count($value["CHILD"]) == 0):?></a><?endif*/?>
				</a>
				<?/*<a href="<?=$value['SECTION_PAGE_URL']?>" class="cat-main-link"></a>*/?>
			</div>
		<?endforeach;?>
		<a href="/catalog/" class="cat-main-panel cat-main-panel-last">
			<div class="cat-main-panel-link">В каталог</div>
		</a>
	</div>
</div>
<?global $USER?>
<?
					$arSelect3 = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CAT_NEW", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1", "PROPERTY_CAT_NAL", "PROPERTY_GALLERY");
					$arFilter3 = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_CAT_NEW"=>3);
					$res3 = CIBlockElement::GetList(Array(), $arFilter3, false, Array("nPageSize"=>10), $arSelect3);
					while($ob3 = $res3->GetNext()):
						if ($USER->isAdmin()){
							//echo "<pre>"; print_r($ob3); echo "</pre>";
						}
						if (!empty($ob3["PREVIEW_PICTURE"])){
							$img2[$ob3["ID"]][$ob3["PREVIEW_PICTURE"]] = CFile::GetPath($ob3["PREVIEW_PICTURE"]);
						}
						if (!empty($ob3["PROPERTY_GALLERY_VALUE"])){
							$img2[$ob3["ID"]][$ob3["PROPERTY_GALLERY_VALUE"]] = CFile::GetPath($ob3["PROPERTY_GALLERY_VALUE"]);
						}
						$tovar_razdel = CIBlockSection::GetByID($ob3["IBLOCK_SECTION_ID"]);
						$ar_tovar_razdel[$ob3["ID"]] = $tovar_razdel->GetNext(); // раздел
						$price3 = number_format($ob3['CATALOG_PRICE_1'], 0, '', ' ');
						$newElements[$ob3["ID"]] = $ob3;
						?>
					<?endwhile;?>
    <div class="advantages block-main">
        <!--<div class="advantages-title">Наши преимущества</div>-->
        <div class="advantages-block">
            <div class="advantages-panel">
                <svg width="70" height="70">
                    <use xlink:href="#advantages-1"></use>
                </svg>
                <div class="advantages-text">
                    Широта <br>ассортимента
                    <br>
                    <span>
				В том случае, если другая продукция
				</span>
                </div>
            </div>
            <div class="advantages-panel">
                <svg width="70" height="70">
                    <use xlink:href="#advantages-2"></use>
                </svg>
                <div class="advantages-text">Быстрые <br>сроки замера
                    <span>
					В том случае, если другая продукция
				</span>
                </div>
            </div>
            <div class="advantages-panel">
                <svg width="55" height="70">
                    <use xlink:href="#advantages-3"></use>
                </svg>
                <div class="advantages-text">100% гарантия <br>на наши товары
                    <span>
					В том случае, если другая продукция
				</span>
                </div>
            </div>
        </div>
    </div>
<div class="recommend">
	<!--<div class="recommend-line-1"></div>
	<div class="recommend-line-2"></div>-->
	<div class="block-main">
		<!--<div class="title-white">Рекомендуем</div>-->
		<div class="recommend-block">
			<div class="recommend-tabs" data-item="0">
				<div class="recommend-tab active">
					<span>Новинки</span>
				</div>
				<div class="recommend-tab">
					<span>Хиты продаж</span>
				</div>
			</div>
			<div class="recommend-main">
				<div class="recommend-sl">
						<?foreach ($newElements as $key => $ob3):?>
							<div>
								<div class="recommend-panel">
									<div class="recommend-panel-izbr sravn-<?=$ob3['ID']?>" onclick="sravn('<?=$ob3['ID']?>');">
										<svg width="22" height="20">
											<use xlink:href="#izbr"></use>
										</svg>
									</div>
									<div class="cat-panel-sr sr-<?=$ob3['ID']?>" onclick="sr('<?=$ob3['ID']?>');">
										<svg width="28" height="26">
											<use xlink:href="#sravnenie"></use>
										</svg>
									</div>
									<div class="recommend-panel-info">
										<!--<div class="recommend-panel-img" style="background: url(<?=$img2?>)no-repeat 50%;background-size: contain;"></div>-->
										<div class="recommend-panel-slider">
											<?if (!empty($img2[$key])):?>
												<?foreach ($img2[$key] as $img):?>
													<div><div class="recommend-panel-img" style="background: url(<?=$img?>)no-repeat 50%;background-size: contain;"></div></div>
												<?endforeach?>
											<?else:?>
												<div><div class="recommend-panel-img" style="background: url(/include/img/empty.png) no-repeat 50%;background-size: contain;"></div></div>
											<?endif?>
										</div>
										<a href='<?=$ob3['DETAIL_PAGE_URL']?>' class="recommend-panel-link">
											<div class="recommend-panel-section"><?=$ar_tovar_razdel[$key]['NAME']?></div>
											<div class="recommend-panel-name"><?=$ob3['NAME']?></div>
										</a>
									</div>
									<?if($ob3['PROPERTY_CAT_NAL_ENUM_ID'] == 1):?>
									<div class='recommend-panel-btn-wrap'>
										<div class="recommend-panel-price">
											<!--<span class="recommend-panel-price-text">Стоимость:</span>-->
											<span class="recommend-panel-price-val"><?=number_format($ob3['CATALOG_PRICE_1'], 0, '', ' ')?> руб.</span>
										</div>
										<div class='recommend-panel-counter'>
											<div class='recommend-panel-plus'><svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M9.08008 4.57434V14.6577" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.03906 9.61603H14.1224" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
											<div class='recommend-panel-count'>1</div>
											<div class='recommend-panel-minus'><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none"><path d="M4.49414 9.61603H14.5775" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
										</div>
										<div class="recommend-panel-btn" data-count="1" onclick="add2(1,'<?=$ob3['NAME']?>','','<?=$ob3['ID']?>', this,'<?=number_format($ob3['CATALOG_PRICE_1'], 0, '', ' ')?>');"></div>
									</div>
									<?else:?>
									<div class='recommend-panel-btn-wrap'>
										<div class="recommend-panel-btn btn-zakaz" onclick="fosTovar('Под заказ','Под заказ','CLICK1','<?=$ob3['NAME']?>','<?=number_format($ob3['CATALOG_PRICE_1'], 0, '', ' ')?> руб.');">Под заказ</div>
									</div>
									<?endif;?>
								</div>
							</div>
						<?endforeach?>
			
				</div>
				<div class="recommend-sl-hit"></div>
			</div>
			<div class="recommend-link">
				<a href="/catalog/" class="recommend-link-btn btn">Смотреть все</a>
			</div>
		</div>
	</div>
</div>
<?
	$res = CIBlockElement::GetList([], ["IBLOCK_ID" => 10, "ACTIVE" => "Y"], false, false, ["ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "PROPERTY_HREF"]);
	while ($result = $res->Fetch()){
		$working[$result["ID"]] = $result;
	}

?>
<div class="working">
	<div class="block-main">
		<div class="working-tabs">
			<div class="tabs-items">
				<div class="tabs-item-wrapper">
					<div class="tabs-item active" id="tab-1">
						<div class="working-tab-slider">
							<?foreach ($working as $work):?>
								<div>
									<div class="working-tab-item">
										<div class="working-tab-item-description">
											<div class='working-tab-item-title'><?=$work["NAME"]?></div>
											<?=$work["PREVIEW_TEXT"]?>
											<?if (!empty($work["PROPERTY_HREF_VALUE"])):?>
												<a href='<?=$work["PROPERTY_HREF_VALUE"]?>' class="working-tab-item-link">ПОДРОБНЕЕ</a>
											<?endif?>
										</div>
										<div class="working-tab-item-image" style="background-image: url('<?=CFile::GetPath($work["PREVIEW_PICTURE"])?>');"></div>
									</div>
								</div>
							<?endforeach?>
					
						</div>
					</div>
				</div>

			</div>
			<ul class="tabs-nav">
				<?foreach ($working as $work):?>
					<li><a href="" class='active'><?=$work["NAME"]?></a></li>
				<?endforeach?>

			</ul>	
		</div> 
	</div> 
</div>
<!-- <div class="block-main company-main">
	<div class="title company-main-title">О компании</div>
	<div class="company-main-block">
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
	<div class="company-main-link">
		<a href="/o-kompanii/" class="company-main-link-btn btn">Читать далее</a>
	</div>
</div>-->
<?}else{?>
<div class="m-slider-main">
	<div class="m-slider">
		<?$APPLICATION->IncludeComponent("bitrix:news.list", "slider-mobile", Array(
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
					1 => "",
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
					0 => "SL_MOB",
					1 => "",
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
	<div class="m-slider-btn">
		<div class="m-slider-btn-text">к преимуществам</div>
		<svg width="46" height="49">
	        <use xlink:href="#m-slider-preim"></use>
	    </svg>
	</div>
</div>
<div class="m-title" id="m-previews">
	<div class="m-title-text">Наши преимущества</div>
</div>
<div class="m-reviews">
	<div class="m-reviews-tabs">
		<div class="m-reviews-tab m-reviews-tab-1"></div>
		<div class="m-reviews-tab m-reviews-tab-2 active"></div>
		<div class="m-reviews-tab m-reviews-tab-3"></div>
	</div>
	<div class="m-reviews-block m-reviews-block-1">
		<div class="m-reviews-block-title">Широта ассортимента</div>
		<div class="m-reviews-block-text">
			Задача организации, в особенности же постоянное...
		</div>
	</div>
	<div class="m-reviews-block m-reviews-block-1 block-active">
		<div class="m-reviews-block-title">Срок замера</div>
		<div class="m-reviews-block-text">
			Задача организации, в особенности же постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет выполнять важные задания...
		</div>
	</div>
	<div class="m-reviews-block m-reviews-block-1">
		<div class="m-reviews-block-title">Гарантия</div>
		<div class="m-reviews-block-text">
			Задача организации, в особенности же постоянное информационно-пропагандистское...
		</div>
	</div>
</div>
<div class="m-title m-title-blue">
	<div class="m-title-text">Каталог</div>
</div>
<a href="/catalog/seyfy/" class="m-cat">
	<div class="m-cat-img" style="background: url(/bitrix/templates/seif/images/m-seyf.jpg)no-repeat 50%;background-size: contain;"></div>
	<div class="m-cat-text">Сейфы для дома и офиса</div>
</a>
<a href="/catalog/meditsinskaya-mebel-i-oborudovanie/" class="m-cat">
	<div class="m-cat-img" style="background: url(/bitrix/templates/seif/images/m-mebel.jpg)no-repeat 50%;background-size: contain;"></div>
	<div class="m-cat-text">Металлическая мебель</div>
</a>
<a href="/catalog/meditsinskaya-mebel-i-oborudovanie/" class="m-cat">
	<div class="m-cat-img" style="background: url(/bitrix/templates/seif/images/m-oborud.jpg)no-repeat 50%;background-size: contain;"></div>
	<div class="m-cat-text">Медицинская мебель и оборудование</div>
</a>
<div class="m-cat-btn">
	<a href="/catalog/" class="m-cat-link">В каталог</a>
</div>
<div class="m-title">
	<div class="m-title-text">Рекомендуем</div>
</div>
<div class="m-catal-tabs" data-item="0">
	<div class="m-catal-tab active">Новинки</div>
	<div class="m-catal-tab">Хиты продаж</div>
</div>
<div class="m-catal-block m-catal-block-active">
	<div class="m-catal-sl">
		<?
			CModule::IncludeModule('iblock');
			$arSelect3 = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CAT_NEW", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1", "PROPERTY_CAT_NAL");
			$arFilter3 = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_CAT_NEW"=>3);
			$res3 = CIBlockElement::GetList(Array(), $arFilter3, false, Array("nPageSize"=>10), $arSelect3);
			while($ob3 = $res3->GetNext()):
				$img2 = CFile::GetPath($ob3["PREVIEW_PICTURE"]);
				$tovar_razdel = CIBlockSection::GetByID($ob3["IBLOCK_SECTION_ID"]);
				$ar_tovar_razdel = $tovar_razdel->GetNext(); // раздел
				$price3 = number_format($ob3['CATALOG_PRICE_1'], 0, '', ' ');?>
				<div>
					<div class="m-catal-panel">
						<div class="m-catal-panel-izbr sravn-<?=$ob3['ID']?>" onclick="sravn('<?=$ob3['ID']?>');">
							<svg width="22" height="20">
						        <use xlink:href="#izbr"></use>
						    </svg>
						</div>
						<div class="cat-panel-sr m-cat-panel-sr sr-<?=$ob3['ID']?>" onclick="sr('<?=$ob3['ID']?>');">
							<svg width="28" height="26">
						        <use xlink:href="#sravnenie"></use>
						    </svg>
						</div>
						<a href="<?=$ob3['DETAIL_PAGE_URL']?>" class="m-catal-panel-info">
							<div class="m-catal-panel-img" style="background: url(<?=$img2?>)no-repeat 50%;background-size: contain;"></div>
							<div class="m-catal-panel-name"><?=$ob3['NAME']?></div>
							<div class="m-catal-panel-section"><?=$ar_tovar_razdel['NAME']?></div>
							<div class="m-catal-panel-price">
								<span class="m-catal-panel-price-text">Стоимость:</span>
								<span class="m-catal-panel-price-val"><?=$price3?> руб.</span>
							</div>
						</a>
						<?if($ob3['PROPERTY_CAT_NAL_ENUM_ID'] == 1):?>
							<div class="m-catal-panel-btn" data-count="1" onclick="add2(1,'<?=$ob3['NAME']?>','','<?=$ob3['ID']?>', this,'<?=$price3?>');">В корзину</div>
						<?else:?>
							<div class="m-catal-panel-btn m-btn-zakaz" onclick="fosTovar('Под заказ','Под заказ','CLICK1','<?=$ob3['NAME']?>','<?=$price3?> руб.');">Под заказ</div>
						<?endif;?>
					</div>
				</div>
			<?endwhile;?>
	</div>
</div>
<div class="m-catal-block">
	<div class="m-catal-sl-2"></div>
</div>
<a href="/catalog/" class="m-btn">смотреть все</a>
<div class="m-company">
	<div class="m-title m-title-blue-white">
		<div class="m-title-text">О компании</div>
	</div>
	<div class="m-company-item m-company-item-first">
		<div class="m-company-item-icon-1"></div>
		<div class="m-company-item-text">Изготовление под заказ</div>
	</div>
	<div class="m-company-item">
		<div class="m-company-item-icon-2"></div>
		<div class="m-company-item-text">Ремонт и вскрытие</div>
	</div>
	<div class="m-company-item">
		<div class="m-company-item-icon-3"></div>
		<div class="m-company-item-text">Гарантийное обслуживание</div>
	</div>
	<a href="/o-kompanii/" class="m-company-link">
		<span>Читать далее</span>
	</a>
</div>
<div class="m-title">
	<div class="m-title-text">Бесплатная консультация</div>
</div>
<div class="m-consult-preview">отправьте заявку и мы Вам перезвоним в течение 5 минут</div>
<div class="m-btn" onclick="fosPopup('Бесплатная консультация','Отправить заявку','KONSULT');">Отправить заявку</div>
<?}?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>