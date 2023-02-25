<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$mass_str = $_POST['mass'];

$mass = explode(",", $mass_str);

CModule::IncludeModule('iblock');
$arSelect4 = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CAT_HIT", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1", "PROPERTY_CAT_NAL");
$arFilter4 = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$mass);
$res4 = CIBlockElement::GetList(Array(), $arFilter4, false, Array(), $arSelect4);
while($ob4 = $res4->GetNext()):
	$img2 = CFile::GetPath($ob4["PREVIEW_PICTURE"]);
	$tovar_razdel = CIBlockSection::GetByID($ob4["IBLOCK_SECTION_ID"]);
	$ar_tovar_razdel = $tovar_razdel->GetNext(); // раздел
	$price3 = number_format($ob4['CATALOG_PRICE_1'], 0, '', ' ');
	echo '
		<div class="cat-panel recommend-panel sravn-panel izbr-panel">
			<div class="recommend-panel-izbr sravn-'.$ob4['ID'].'" onclick="sravn(\''.$ob4['ID'].'\');sravnDel(\''.$ob4['ID'].'\');">
				<svg width="22" height="20">
			        <use xlink:href="#izbr"></use>
			    </svg>
			</div>
			<div class="cat-panel-sr sr-'.$ob4['ID'].'" onclick="sr(\''.$ob4['ID'].'\');">
				<svg width="28" height="26">
			        <use xlink:href="#sravnenie"></use>
			    </svg>
			</div>
			<a href="'.$ob4['DETAIL_PAGE_URL'].'" class="recommend-panel-info">
				<div class="recommend-panel-img" style="background: url('.$img2.')no-repeat 50%;background-size: contain;"></div>
				<div class="recommend-panel-name">'.$ob4['NAME'].'</div>
				<div class="recommend-panel-section">'.$ar_tovar_razdel['NAME'].'</div>
				<div class="recommend-panel-price">
					<span class="recommend-panel-price-text">Стоимость:</span>
					<span class="recommend-panel-price-val">'.$price3.' руб.</span>
				</div>
			</a>';
			if($ob4['PROPERTY_CAT_NAL_ENUM_ID'] == 1):
				echo '<div class="recommend-panel-btn" onclick="add2(\'1\',\''.$ob4['NAME'].'\',\'\',\''.$ob4['ID'].'\',this,\''.$price3.'\')">В корзину</div>';
			else:
				echo '<div class="recommend-panel-btn btn-zakaz" onclick="fosTovar(\'Под заказ\',\'Под заказ\',\'CLICK1\',\''.$ob4['NAME'].'\',\''.$price3.' руб.\');">Под заказ</div>';
			endif;
		echo '</div>';
endwhile;?>