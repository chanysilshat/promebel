<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$el = new CIBlockElement;
$iblock_id = 7;
$section_id = false;
$fio = $_POST['name'];
$text = $_POST['text'];



/*$PROP['TIKET_TEMA'] = $tema_name;
$PROP['TIKET_DATE'] = date("d.m.Y H:i:s");
$PROP['TIKET_ID_USER'] = $id_user;
$PROP['TIKET_STATUS'] = '27';
$PROP['TIKET_FILE'] = $file;
$PROP['TIKET_USER'] = '29';*/

$fields = array(
    /*"DATE_ACTIVE_FROM" => date("H:i d-m-y")date("d.m.Y H:i:s"),*/ //Передаем дата создания
    "CREATED_BY" => $GLOBALS['USER']->GetID(),    //Передаем ID пользователя кто добавляет
    "IBLOCK_SECTION" => $section_2, //ID разделов
    "IBLOCK_ID" => $iblock_id, //ID информационного блока
    //"NAME" => strip_tags($_REQUEST['name']),
    "NAME" => $_POST['name'],
    "ACTIVE" => "N", //поумолчанию делаем активным или ставим N для отключении поумолчанию
    "PREVIEW_TEXT" => $_POST['text'], //Анонс
    //"PREVIEW_PICTURE" => $_FILES['image'], //изображение для анонса
    //"DETAIL_TEXT"    => strip_tags($_REQUEST['description_detail'],
    //"DETAIL_PICTURE" => $_FILES['image_detail'] //изображение для детальной страницы
);
if ($ID = $el->Add($fields)) {
    echo '<div class="card-rev-form-mess">Спасибо! Отзыв отправлен на модерацию.</div>';
} else {
    echo '<div class="card-rev-form-mess">Возникал ошибка.</div>';
}
?>