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
	$id_tov = $ob4['ID'];
	echo '
		<div class="recommend-panel sravn-panel sr-panel">
			<div class="recommend-panel-izbr sravn-'.$ob4['ID'].'" onclick="sravn(\''.$ob4['ID'].'\');">
				<svg width="22" height="20">
			        <use xlink:href="#izbr"></use>
			    </svg>
			</div>
			<div class="cat-panel-sr sr-'.$ob4['ID'].'" onclick="sr(\''.$ob4['ID'].'\');srDel(\''.$ob4['ID'].'\');">
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
				echo '<div class="recommend-panel-btn" onclick="add2(\'1\',\''.$ob4['NAME'].'\',\'\',\''.$ob4['ID'].'\',\'1\',\''.$price3.'\')">В корзину</div>';
			else:
				echo '<div class="recommend-panel-btn btn-zakaz" onclick="fosTovar(\'Под заказ\',\'Под заказ\',\'CLICK1\',\''.trim($ob4['NAME']).'\',\''.$price3.' руб.\');">Под заказ</div>';
			endif;
			echo '<div class="sr-harac-block">';
				$arSelect5 = Array("ID", "NAME", "PROPERTY_CAT_NAL", "PROPERTY_CAT_BREND", "PROPERTY_CAT_OBEM", "PROPERTY_CAT_VES", "PROPERTY_CAT_VISOTA", "PROPERTY_CAT_SHIRINA", "PROPERTY_CAT_GLUBINA", "PROPERTY_CAT_COLOR", "PROPERTY_CAT_KOL_POLOK", "PROPERTY_CAT_TIP_ZAMKA", "PROPERTY_CAT_TIP_POKRITIYA");
				$arFilter5 = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$id_tov);
				$res5 = CIBlockElement::GetList(Array(), $arFilter5, false, Array(), $arSelect5);
				$ob5 = $res5->GetNext();
				$brend = $ob5['PROPERTY_CAT_BREND_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_BREND_VALUE'];
				$obem = $ob5['PROPERTY_CAT_OBEM_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_OBEM_VALUE'];
				$ves = $ob5['PROPERTY_CAT_VES_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_VES_VALUE'];
				$visota = $ob5['PROPERTY_CAT_VISOTA_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_VISOTA_VALUE'];
				$shirina = $ob5['PROPERTY_CAT_SHIRINA_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_SHIRINA_VALUE'];
				$glubina = $ob5['PROPERTY_CAT_GLUBINA_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_GLUBINA_VALUE'];
				$color = $ob5['PROPERTY_CAT_COLOR_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_COLOR_VALUE'];
				$polka = $ob5['PROPERTY_CAT_KOL_POLOK_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_KOL_POLOK_VALUE'];
				$zamok = $ob5['PROPERTY_CAT_TIP_ZAMKA_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_TIP_ZAMKA_VALUE'];
				$pokritie = $ob5['PROPERTY_CAT_TIP_POKRITIYA_VALUE'] == '' ? '-' : $ob5['PROPERTY_CAT_TIP_POKRITIYA_VALUE'];
				/*if($ob5['PROPERTY_CAT_BREND_VALUE'] == ''):
					$brend = '-';
				else:
					$brend = $ob5['PROPERTY_CAT_BREND_VALUE'];
				endif;*/
				echo '<div class="sr-harac sr-item-0">
						<div class="sr-harac-title">Бренд</div>
						<div class="sr-harac-val">'.$brend.'</div>
					</div>
					<div class="sr-harac sr-item-1">
						<div class="sr-harac-title">Объём, л</div>
						<div class="sr-harac-val">'.$obem.'</div>
					</div>
					<div class="sr-harac sr-item-2">
						<div class="sr-harac-title">Вес</div>
						<div class="sr-harac-val">'.$ves.'</div>
					</div>
					<div class="sr-harac sr-item-3">
						<div class="sr-harac-title">Высота, мм</div>
						<div class="sr-harac-val">'.$visota.'</div>
					</div>
					<div class="sr-harac sr-item-4">
						<div class="sr-harac-title">Ширина, мм</div>
						<div class="sr-harac-val">'.$shirina.'</div>
					</div>
					<div class="sr-harac sr-item-5">
						<div class="sr-harac-title">Глубина, мм</div>
						<div class="sr-harac-val">'.$glubina.'</div>
					</div>
					<div class="sr-harac sr-item-6">
						<div class="sr-harac-title">Цвет</div>
						<div class="sr-harac-val">'.$color.'</div>
					</div>
					<div class="sr-harac sr-item-7">
						<div class="sr-harac-title">Количество полок</div>
						<div class="sr-harac-val">'.$polka.'</div>
					</div>
					<div class="sr-harac sr-item-8">
						<div class="sr-harac-title">Тип замка</div>
						<div class="sr-harac-val">'.$zamok.'</div>
					</div>
					<div class="sr-harac sr-item-9">
						<div class="sr-harac-title">Тип покрытия</div>
						<div class="sr-harac-val">'.$pokritie.'</div>
					</div>';
			echo '</div>';
		echo '</div>';
endwhile;

/*$mass_str = $_POST['mass'];

$mass = explode(",", $mass_str);

$sortArr = array();
$resultArrayIzbr = $resultArray;

// Формируем новый массив с нужными артикулами
$mass_new = array();
$k = 0;
$i = 0;
foreach ($resultArrayIzbr as $key => $value) {
	foreach ($value as $key1 => $predl) {
		$art = substr($predl['CML2_ARTICLE'], 0, strripos($predl['CML2_ARTICLE'], '-'));
		foreach ($mass as $key2 => $value1) {
			if($art == $value1){
				$k = 1;
			}
		}
	}
	if($k == 1){
		$mass_new[] = $value;
		$k = 0;
	}
}*/

/*foreach ($mass_new as $key5 => $value5) {

	/*echo $value5[0]['NAIMENOVANIE_NA_RUSSKOM_YAZYKE_'];*/
	/*echo '<pre>';
	print_r($value5);
	echo '</pre>';*/

		/*$art_link =  explode('-',$predl['CML2_ARTICLE'])[0];
		echo '<div class="compare-block">
			<a href="/catalog/'.$art_link.'/" class="compare-panel compare-panel-yes">
				<div class="compare-panel-name">'.$value5[0]['NAIMENOVANIE_NA_RUSSKOM_YAZYKE_'].', '.$art.'</div>';
				if($value5[0]['SODERZHANIE_OSNOVNOGO_VESHCHESTVA_']):
					// echo '<div class="compare-panel-property">Концентрат: <span>'.$value5[0]['SODERZHANIE_OSNOVNOGO_VESHCHESTVA_'].'</span></div>';
				else :
					// echo '<div class="compare-panel-property">Концентрат: <span>-</span></div>';
				endif;
				echo '
				<div class="compare-panel-dop">
					<div class="compare-panel-delete" onclick="event.preventDefault();compareDelete(\''.$art_link.'\');">
						<svg width="26" height="30">
                            <use xlink:href="#compare-delete"></use>
                        </svg>
					</div>
					<div class="compare-btn-basket basket-'.$value5[0]['ID'].'" onclick="event.preventDefault();basket(\''.$value5[0]['ID'].'\');">В корзину</div>
				</div>
			</a>';
	   echo'<div class="compare-info-block">
	   			<div class="compare-info-item item-0">
	   				<div class="compare-info-title">Формула: </div>';
	   				if(!empty($value5[0]['FORMULA_'])){
	   					echo '<div class="compare-info-text">'.$value5[0]['FORMULA_'].'</div>';
	   				} else {
	   					echo '<div class="compare-info-text">-</div>';
	   				}
	   			echo '</div>
				<div class="compare-info-item item-1">
					<div class="compare-info-title">Содержание основного вещества</div>';
					if(!empty($value5[0]['SODERZHANIE_OSNOVNOGO_VESHCHESTVA_'])){
						echo '<div class="compare-info-text">'.$value5[0]['SODERZHANIE_OSNOVNOGO_VESHCHESTVA_'].'</div>';
					} else {
						echo '<div class="compare-info-text">-</div>';
					}
				echo '</div>
				<div class="compare-info-item item-2">
					<div class="compare-info-title">Соответствие квалификации</div>';
					if(!empty($value5[0]['SOOTVETSTVIE_KVALIFIKATSII_'])){
						echo '<div class="compare-info-text">'.$value5[0]['SOOTVETSTVIE_KVALIFIKATSII_'].'</div>';
					} else {
						echo '<div class="compare-info-text">-</div>';
					}
				echo '</div>
				<div class="compare-info-item item-3">
					<div class="compare-info-title">Соответствие ГОСТ/ТУ</div>';
					if(!empty($value5[0]['SOOTVETSTVIE_GOST_TU_'])){
						echo '<div class="compare-info-text">'.$value5[0]['SOOTVETSTVIE_GOST_TU_'].'</div>';
					} else {
						echo '<div class="compare-info-text">-</div>';
					}
				echo '</div>
				<div class="compare-info-item item-4">
					<div class="compare-info-title">CAS: </div>';
					if(!empty($value5[0]['CAS_'])){
						echo '<div class="compare-info-text">'.$value5[0]['CAS_'].'</div>';
					} else {
						echo '<div class="compare-info-text">-</div>';
					}
				echo '</div>
				<div class="compare-info-item item-5">
					<div class="compare-info-title">EINECS (EC Number)</div>';
					if(!empty($value5[0]['EINECS_EC_NUMBER'])){
						echo '<div class="compare-info-text">'.$value5[0]['EINECS_EC_NUMBER'].'</div>';
					} else {
						echo '<div class="compare-info-text">-</div>';
					}
				echo '</div>
				<div class="compare-info-item item-6">
					<div class="compare-info-title">Агрегатное состояние/Внешний вид</div>';
					if(!empty($value5[0]['AGREGATNOE_SOSTOYANIE_VNESHNIY_VID_'])){
						echo '<div class="compare-info-text">'.$value5[0]['AGREGATNOE_SOSTOYANIE_VNESHNIY_VID_'].'</div>';
					} else {
						echo '<div class="compare-info-text">-</div>';
					}
				echo '</div>
				<div class="compare-info-item item-7">
					<div class="compare-info-title">Технические характеристики</div>';
					if(!empty($value5[0]['TEKHNICHESKIE_KHARAKTERISTIKI_'])){
						echo '<div class="compare-info-text">'.$value5[0]['TEKHNICHESKIE_KHARAKTERISTIKI_'].'</div>';
					} else {
						echo '<div class="compare-info-text">-</div>';
					}
				echo '</div>
			</div>
    	</div>';
    $i++;
}*/
/*while ($i <= 3) {
	echo '<div class="compare-block">
			<div class="compare-panel"></div>
			<div class="compare-info-block">
				<div class="compare-info-item item-0">
					<div class="compare-info-title">Содержание основного вещества</div>
					<div class="compare-info-text">-</div>
				</div>
				<div class="compare-info-item item-1">
					<div class="compare-info-title">Соответствие квалификации</div>
					<div class="compare-info-text">-</div>
				</div>
				<div class="compare-info-item item-2">
					<div class="compare-info-title">Соответствие ГОСТ/ТУ</div>
					<div class="compare-info-text">-</div>
				</div>
				<div class="compare-info-item item-3">
					<div class="compare-info-title">Агрегатное состояние/Внешний вид</div>
					<div class="compare-info-text">-</div>
				</div>
				<div class="compare-info-item item-4">
					<div class="compare-info-title">Технические характеристики</div>
					<div class="compare-info-text">-</div>
				</div>
				<div class="compare-info-item item-5">
					<div class="compare-info-title">CAS: </div>
					<div class="compare-info-text">-</div>
				</div>
				<div class="compare-info-item item-6">
					<div class="compare-info-title">EINECS (EC Number)</div>
					<div class="compare-info-text">-</div>
				</div>
			</div>
		</div>';
	$i++;
	}*/	
?>