<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
    <div class="inquiry-count">
        <span class="inquiry-border">
            Найдено <?=$arResult["COUNT_ELEMENT"]?> результатов
        </span>
    </div>
    <div class="search">
        <?foreach ($arResult["ITEMS"] as $items):?>
            <div>
                <div class="recommend-panel">
                    <div class="recommend-panel-izbr sravn-<?=$items['ID']?>" onclick="sravn('<?=$items['ID']?>');">
                        <svg width="22" height="20">
                            <use xlink:href="#izbr"></use>
                        </svg>
                    </div>
                    <div class="cat-panel-sr sr-<?=$items['ID']?>" onclick="sr('<?=$items['ID']?>');">
                        <svg width="28" height="26">
                            <use xlink:href="#sravnenie"></use>
                        </svg>
                    </div>
                    <div class="recommend-panel-info">
                        <!--<div class="recommend-panel-img" style="background: url(<?=$img2?>)no-repeat 50%;background-size: contain;"></div>-->
                        <div class="recommend-panel-slider">
                            <?foreach ($items["PICTURE"] as $PICTURE):?>
                                <div class="recommend-panel-img" style="background: url(<?=$PICTURE?>)no-repeat 50%;background-size: contain;"></div>
                            <?endforeach?>
                        </div>
                        <a href="/catalog/bukhgalterskie-shkafy/aiko-sl-1503t/" class="recommend-panel-link" tabindex="0">
                            <div class="recommend-panel-section">
                                Бухгалтерские шкафы
                            </div>
                            <div class="recommend-panel-name"><?=$items["NAME"]?></div>
                        </a>
                    </div>
                    <div class="recommend-panel-btn-wrap">
                        <div class="recommend-panel-price">
                            <!--<span class="recommend-panel-price-text">Стоимость:</span>-->
                            <span class="recommend-panel-price-val"><?=$items["PRICE"]["PRICE"]?> руб.</span>
                        </div>
                        <div class="recommend-panel-counter">
                            <div class="recommend-panel-plus"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M9.08008 4.57434V14.6577" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4.03906 9.61603H14.1224" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>
                            <div class="recommend-panel-count">1</div>
                            <div class="recommend-panel-minus"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none"><path d="M4.49414 9.61603H14.5775" stroke="#3C6FBC" stroke-width="1.08036" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>
                        </div>
                        <div class="recommend-panel-btn" data-count="1" onclick="add2(1,'<?=$items['NAME']?>','','<?=$items['ID']?>', this,'<?=$items['PRICE']['PRICE']?>');"></div>
                    </div>
                </div>
            </div>
        <?endforeach?>
    </div>