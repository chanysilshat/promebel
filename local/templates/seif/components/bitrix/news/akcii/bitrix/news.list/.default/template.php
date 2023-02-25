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
<div class="smi">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="smi-item smi-item-akcii" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arItem['PREVIEW_PICTURE']['SRC']):?>
			<div class="smi-item-img" style="background: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)no-repeat 50%;background-size:cover;"></div>
		<?endif;?>
		<div class="smi-item-info">
			<div class="smi-item-title"><?=$arItem['NAME']?></div>
			<div class="smi-item-preview"><?=$arItem['PREVIEW_TEXT']?></div>
			<?if($arItem["DISPLAY_ACTIVE_FROM"]):
				$stmp = MakeTimeStamp($arItem["DISPLAY_ACTIVE_FROM"], "DD.MM.YYYY");?>
				<div class="smi-item-data"><?=date('d/m/Y',$stmp)?></div> 
			<?endif;?>
			<?/*?><div class="smi-link">Читать далее</div> <?*/?>
		</div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
