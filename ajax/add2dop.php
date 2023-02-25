<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");



// подключение служебной части пролога  
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?> 
  
<?
Bitrix\Main\Loader::includeModule("catalog");

$fields = [
    'PRODUCT_ID' => $_REQUEST['p_id'], // ID товара, обязательно
    'QUANTITY' => $_REQUEST['p_c'], // количество, обязательно
    'PROPS' => [
        ['NAME' => $_REQUEST['name']],
    ],

];
$r = Bitrix\Catalog\Product\Basket::addProduct($fields);
if (!$r->isSuccess()) {
    /*var_dump($r->getErrorMessages());*/
}
use Bitrix\Sale;
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
$basket = \Bitrix\Sale\Basket::loadItemsForFUser(
   \Bitrix\Sale\Fuser::getId(), 
   \Bitrix\Main\Context::getCurrent()->getSite()
);
$basketItems = $basket->getBasketItems();
$basket_count = count($basketItems);
echo str_replace(' ', '', $basket_count);
?>