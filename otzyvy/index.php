<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");
?>
<div class="catalog">
	<div class="catalog-menu mobile">
		<div class="catalog-menu-mobile-title">Меню</div>
		<ul class="catalog-menu-mobile-menu">
			<li>
				<div class="catalog-menu-mobile-link">О компании</div>
				<ul>
					<li><a href="/proizvoditeli/">Производители</a></li>
					<li class="catalog-menu-mobile-link"><a href="/otzyvy/">Отзывы</a></li>
					<li><a href="/novosti/">Новости</a></li>
					<li><a href="/prays-list/">Прайс-лист</a></li>
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
			<li class="active">
				<a href="/otzyvy/" class="catalog-menu-link-one">Отзывы</a>
			</li>
			<li>
				<a href="/novosti/" class="catalog-menu-link-one">Новости</a>
			</li>
			<li>
				<a href="/prays-list/" class="catalog-menu-link-one">Прайс-лист</a>
			</li>
			<li>
				<a href="/sertifikaty/" class="catalog-menu-link-one">Документы</a>
			</li>
		</ul>
	</div>
	<div class="content">
		<div class="review-form-block">
			<div class="review-btn js__review--btn">Написать отзыв</div>
			<form class="review-form">
				<div class="form-item">
					<input type="text" name="name" placeholder="Имя">
				</div>
				<div class="form-item rating-item">
					<span class="rating-value">
						Рейтинг
					</span>
					<div class="rating-area">
				
						
							<input type="radio" id="star-1" name="rating" value="5">
							<label for="star-1" title="Оценка «1»"></label>
							<input type="radio" id="star-2" name="rating" value="4">
							<label for="star-2" title="Оценка «2»"></label>
							<input type="radio" id="star-3" name="rating" value="3">
							<label for="star-3" title="Оценка «3»"></label>
							<input type="radio" id="star-4" name="rating" value="2">
							<label for="star-4" title="Оценка «4»"></label>
							<input type="radio" id="star-5" name="rating" value="1">
							<label for="star-5" title="Оценка «5»"></label>
						
					</div>
				</div>
				<div class="form-item">
					<textarea name="LIKE" placeholder="Плюсы"></textarea>
				</div>
				<div class="form-item">
					<textarea name="DISLIKE" placeholder="Недостатки"></textarea>
				</div>
				<input class="review-btn js__review--submit" type="submit" value="Отправить">
			</form>
		</div>
		<!--<div class="card-rev-form">
			<input type="text" id="otzivi-rev-fio" placeholder="Введите ФИО">
			<textarea id="otzivi-rev-text" placeholder="Введите текст"></textarea>
			<div class="btn otzivi-rev-form-btn" onclick="otziviSend();">Отправить</div>
		</div>
		<div class="card-rev-btn otzivi-btn">Написать отзыв</div>-->
		<div class="review-result">
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list", 
				"otzivi", 
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "Y",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"PROPERTY_CODE" => [
						0 => "LIKE",
					],
					"FILE_404" => "",
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "7",
					"IBLOCK_TYPE" => "content",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "N",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "20",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "for-seif",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "Y",
					"SET_TITLE" => "N",
					"SHOW_404" => "Y",
					"SORT_BY1" => "TIMESTAMP_X",
					"SORT_BY2" => "SORT",
					"SORT_ORDER1" => "DESC",
					"SORT_ORDER2" => "ASC",
					"STRICT_SECTION_CHECK" => "N",
					"COMPONENT_TEMPLATE" => "otzivi"
				),
				false
			);?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>