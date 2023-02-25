<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

    $arOrder2 = Array("ID"=>"DESC");
    $arSelect2 = Array("ID", "NAME", "PROPERTY_OTZIVI_FIO", "PROPERTY_OTZIVI_ID_TOVAR", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_OTZIVI_DATE");
    $arFilter2 = Array("IBLOCK_ID"=>3, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_OTZIVI_ID_TOVAR"=>$_REQUEST['id_tovar']);
    $res2 = CIBlockElement::GetList($arOrder2, $arFilter2, false, Array(), $arSelect2);
    while($ob2 = $res2->GetNext()):?>
        <div class="card-rev-item">
            <div class="card-rev-my">
                <div class="card-rev-item-name">
                    <span class="card-rev-item-name-text">
                        <?=$ob2['PROPERTY_OTZIVI_FIO_VALUE']?>
                    </span>
                    <span class="card-rev-item-name-date">
                        <?=$ob2['PROPERTY_OTZIVI_DATE_VALUE']?>
                    </span>
                </div>
                <div class="card-rev-item-text"><?=$ob2['PREVIEW_TEXT']?></div>
            </div>
            <?if($ob2['DETAIL_TEXT']):?>
                <div class="card-rev-otvet">
                    <div class="card-rev-item-name">
                        <span class="card-rev-item-name-text">Менеджер</span>
                    </div>
                    <div class="card-rev-item-text"><?=$ob2['DETAIL_TEXT']?></div>
            </div>
            <?endif;?>
        </div>
    <?endwhile;?>