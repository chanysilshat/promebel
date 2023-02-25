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
	?>

	<div class="otzivi-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="otzivi-item-title"><?=$arItem['NAME']?></div>
		<div class="otzivi-item-preview"><?=$arItem['PREVIEW_TEXT']?></div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;*/?>
<?
	//echo "<pre>"; print_r($arResult["ITEMS"]); echo "</pre>";
?>
<?foreach ($arResult["ITEMS"] as $arItem):?>
	<?
		$rating = $arItem["PROPERTIES"]["RATING"]["VALUE"]
	?>
	<div class="review">
		<div class="review-head">
			<span>
				<?=$arItem["NAME"]?>
			</span>
			<div class="review-rating-area">
				<?for ($i = 1; $i <= 5; $i++):?>
				
					<label class="<?if ($i <= $rating):?>active<?endif?>"></label>
			
				<?endfor?>
			</div>
		</div>
		<div class="comment">
			<span>
				Комментарий:
			</span>
			<div class="like-comment">
				<?=$arItem["PROPERTIES"]["LIKE"]["VALUE"]["TEXT"]?>
			</div>
			<?if (!empty($arItem["PROPERTIES"]["DISLIKE"]["VALUE"]["TEXT"])):?>
				<span>
					Недостатки:
				</span>
				<div class="dislike-comment">
					<?=$arItem["PROPERTIES"]["DISLIKE"]["VALUE"]["TEXT"]?>
				</div>
			<?endif?>
		</div>
	</div>
<?endforeach?>
<?
	//echo "<pre>"; print_r($arResult["ITEMS"]); echo "</pre>";
?>