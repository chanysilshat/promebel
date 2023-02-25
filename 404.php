<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Ошибка");?>
<div class="inline-block fon-404">
	<div class="puh-block-width">
		<div class="puh-flex-block fon-404-block">
			<div class="fon-4041">
				<div class="puh-zag-container">Страница не найдена</div>
				К сожалению, такой страницы не существует. <br>Вероятно, она была удалена, либо её здесь никогда не было.<br>
				Попробуйте вернуться <a onclick="javascript:history.back(); return false;">назад</a> или перейти на <a href="/">главную страницу</a>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>