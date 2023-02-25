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

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div>
		<div class="slider-img" style1="background: url(/upload/sbg.png); background-repeat: no-repeat;     background-size: auto 100%;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
			<img src="/upload/s-back.png">
			<img class="img-slider" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">

		</div>
		<div class="background-slider-color">
		</div>
	</div>
<?endforeach;?>

<?/*foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div>
		<div class="slider-img" style="background: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)no-repeat 50%;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
<?endforeach;*/?>

