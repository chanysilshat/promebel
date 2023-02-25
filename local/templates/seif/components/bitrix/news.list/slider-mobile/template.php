<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?/*foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$img = CFile::GetPath($arItem["PROPERTIES"]["SL_MOB"]["VALUE"]);
	?>
	<?if($img):?>
		<!--<div>
			<img src="<?=$img?>" alt="<?=$arItem['NAME']?>" class="m-slider-img" width="320" height="568">
		</div>-->

		<div class="mob-slider">
			<div class="slider-img" style="background: url(<?=$img?>)no-repeat 50%;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class='slider-content'>
					<div class='slider-title'><?=$arItem["~NAME"]?></div>
					<?if (!empty($arItem["PROPERTIES"]["PREVIEW"]["VALUE"])):?>
						<div class='slider-subtitle'><?=$arItem["PROPERTIES"]["PREVIEW"]["VALUE"]?></div>
					<?endif?>
					<?if (!empty($arItem["PROPERTIES"]["HREF"]["VALUE"])):?>
						<a href='<?=$arItem["PROPERTIES"]["HREF"]["VALUE"]?>' class='slider-link'>ПОДРОБНЕЕ</a>
					<?endif?>
				</div>
			</div>
		</div>
	<?endif;?>
<?endforeach;*/?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$img = CFile::GetPath($arItem["PROPERTIES"]["SL_MOB"]["VALUE"]);
	?>
	<?if($img):?>
		<!--<div>
			<img src="<?=$img?>" alt="<?=$arItem['NAME']?>" class="m-slider-img" width="320" height="568">
		</div>-->

		<div class="mob-slider">
			<div class="slider-img" style="background: url(/upload/sbg.png)no-repeat 50%;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class='slider-content'>
					<div class='slider-title'><?=$arItem["~NAME"]?></div>
					<?if (!empty($arItem["PROPERTIES"]["PREVIEW"]["VALUE"])):?>
						<div class='slider-subtitle'><?=$arItem["PROPERTIES"]["PREVIEW"]["VALUE"]?></div>
					<?endif?>
					<?if (!empty($arItem["PROPERTIES"]["HREF"]["VALUE"])):?>
						<a href='<?=$arItem["PROPERTIES"]["HREF"]["VALUE"]?>' class='slider-link'>ПОДРОБНЕЕ</a>
					<?endif?>
				</div>
			</div>
			<div class="background-slider">
				
				<img class="img-slider" src="/upload/iblock/095/qcisz6enl9rlabnnumzd1p6329c90jsd.png">

			</div>
		</div>
	<?endif;?>
<?endforeach;?>