<?php
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule('iblock');
/*
$arSelect4 = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CAT_HIT", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1", "PROPERTY_CAT_NAL");
$arFilter4 = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_CAT_HIT"=>4);
$res4 = CIBlockElement::GetList(Array(), $arFilter4, false, Array("nPageSize"=>10), $arSelect4);
while($ob4 = $res4->GetNext()):
	$img2 = CFile::GetPath($ob4["PREVIEW_PICTURE"]);
	$tovar_razdel = CIBlockSection::GetByID($ob4["IBLOCK_SECTION_ID"]);
	$ar_tovar_razdel = $tovar_razdel->GetNext(); // раздел
	$price3 = number_format($ob4['CATALOG_PRICE_1'], 0, '', ' ');
	echo '<div>
		<div class="recommend-panel">
			<div class="recommend-panel-izbr sravn-'.$ob4['ID'].'" onclick="sravn(\''.$ob4['ID'].'\');">
				<svg width="22" height="20">
			        <use xlink:href="#izbr"></use>
			    </svg>
			</div>
			<div class="cat-panel-sr sr-'.$ob4['ID'].'" onclick="sr(\''.$ob4['ID'].'\');">
				<svg width="28" height="26">
			        <use xlink:href="#sravnenie"></use>
			    </svg>
			</div>
			<div class="recommend-panel-info">
				<!--<div class="recommend-panel-img" style="background: url('.$img2.')no-repeat 50%;background-size: contain;"></div>-->
				<div class="recommend-panel-slider-hit">
				  <div><div class="recommend-panel-img" style="background: url('.$img2.')no-repeat 50%;background-size: contain;"></div></div>
					<div><div class="recommend-panel-img" style="background: url('.$img2.')no-repeat 50%;background-size: contain;"></div></div>
					<div><div class="recommend-panel-img" style="background: url('.$img2.')no-repeat 50%;background-size: contain;"></div></div>
				</div>
				<a href="'.$ob4['DETAIL_PAGE_URL'].'" class="recommend-panel-link">
					<div class="recommend-panel-section">'.$ar_tovar_razdel['NAME'].'</div>
					<div class="recommend-panel-name">'.$ob4['NAME'].'</div>
				</a>
			</div>';
			if($ob4['PROPERTY_CAT_NAL_ENUM_ID'] == 1):
				echo '
				<div class="recommend-panel-btn-wrap">
					<div class="recommend-panel-price">
						<!--<span class="recommend-panel-price-text">Стоимость:</span>-->
						<span class="recommend-panel-price-val">'.$price3.' руб.</span>
					</div>
					<div class="recommend-panel-counter">
						<div class="recommend-panel-plus"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M9.08008 4.57434V14.6577" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.03906 9.61603H14.1224" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
						<div class="recommend-panel-count">1</div>
						<div class="recommend-panel-minus"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none"><path d="M4.49414 9.61603H14.5775" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
					</div>
					<div class="recommend-panel-btn" onclick="add2(\'1\',\''.$ob4['NAME'].'\',\'\',\''.$ob4['ID'].'\',\'1\',\''.$price3.'\')"></div>
				</div>
				';
			else:
				echo '<div class="recommend-panel-btn btn-zakaz" onclick="fosTovar(\'Под заказ\',\'Под заказ\',\'CLICK1\',\''.trim($ob4['NAME']).'\',\''.$price3.' руб.\');">Под заказ</div>';
			endif;
		echo '</div>
	</div>';
endwhile;*/?>
<?
$img2 = [];
global $USER;
	$arSelect3 = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CAT_HIT", "IBLOCK_SECTION_ID", "CATALOG_GROUP_1", "PROPERTY_CAT_NAL", "PROPERTY_GALLERY");
	$arFilter3 = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_CAT_HIT"=>4);
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
					<div class="recommend-panel-slider-hit">
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