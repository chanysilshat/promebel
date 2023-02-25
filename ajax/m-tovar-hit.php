<?php
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule('iblock');

$arSelect3 = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CAT_HIT", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1", "PROPERTY_CAT_NAL");
$arFilter3 = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_CAT_HIT"=>4);
$res3 = CIBlockElement::GetList(Array(), $arFilter3, false, Array("nPageSize"=>10), $arSelect3);
while($ob3 = $res3->GetNext()):
	$img2 = CFile::GetPath($ob3["PREVIEW_PICTURE"]);
	$tovar_razdel = CIBlockSection::GetByID($ob3["IBLOCK_SECTION_ID"]);
	$ar_tovar_razdel = $tovar_razdel->GetNext(); // раздел
	$price3 = number_format($ob3['CATALOG_PRICE_1'], 0, '', ' ');
	echo '<div>
			<div class="m-catal-panel">
				<div class="m-catal-panel-izbr sravn-'.$ob3['ID'].'" onclick="sravn(\''.$ob3['ID'].'\');">
					<svg width="22" height="20">
				        <use xlink:href="#izbr"></use>
				    </svg>
				</div>
				<div class="cat-panel-sr m-cat-panel-sr sr-'.$ob3['ID'].'" onclick="sr(\''.$ob3['ID'].'\');">
					<svg width="28" height="26">
				        <use xlink:href="#sravnenie"></use>
				    </svg>
				</div>
				<a href="'.$ob3['DETAIL_PAGE_URL'].'" class="m-catal-panel-info">
					<div class="m-catal-panel-img" style="background: url('.$img2.')no-repeat 50%;background-size: contain;"></div>
					<div class="m-catal-panel-name">'.$ob3['NAME'].'</div>
					<div class="m-catal-panel-section">'.$ar_tovar_razdel['NAME'].'</div>
					<div class="m-catal-panel-price">
						<span class="m-catal-panel-price-text">Стоимость:</span>
						<span class="m-catal-panel-price-val">'.$price3.' руб.</span>
					</div>
				</a>';
				if($ob3['PROPERTY_CAT_NAL_ENUM_ID'] == 1):
					echo '<div class="m-catal-panel-btn" onclick="add2(\'1\',\''.$ob3['NAME'].'\',\'\',\''.$ob3['ID'].'\', this,\''.$price3.'\');">В корзину</div>';
				else:
					echo '<div class="m-catal-panel-btn m-btn-zakaz" onclick="fosTovar(\'Под заказ\',\'Под заказ\',\'CLICK1\',\''.$ob3['NAME'].'\',\''.$price3.' руб.\');">Под заказ</div>';
				endif;
			echo '</div>
		</div>';
endwhile;
?>