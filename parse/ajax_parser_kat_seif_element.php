<?php ob_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();
CModule::IncludeModule("iblock");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");
Loader::includeModule("catalog");
require('danParser/danParser.php');
header("Content-Type: text/html; charset=UTF-8");
/**
 * Парсер PHP
 * Class Parser
 */
class Parser
{
    /**
     * @var array
     */
    private static $arErrorCodes = [
        "CURLE_UNSUPPORTED_PROTOCOL",
        "CURLE_FAILED_INIT",
        "CURLE_URL_MALFORMAT",
        "CURLE_URL_MALFORMAT_USER",
        "CURLE_COULDNT_RESOLVE_PROXY",
        "CURLE_COULDNT_RESOLVE_HOST",
        "CURLE_COULDNT_CONNECT",
        "CURLE_FTP_WEIRD_SERVER_REPLY",
        "CURLE_REMOTE_ACCESS_DENIED",
        "CURLE_FTP_WEIRD_PASS_REPLY",
        "CURLE_FTP_WEIRD_PASV_REPLY",
        "CURLE_FTP_WEIRD_227_FORMAT",
        "CURLE_FTP_CANT_GET_HOST",
        "CURLE_FTP_COULDNT_SET_TYPE",
        "CURLE_PARTIAL_FILE",
        "CURLE_FTP_COULDNT_RETR_FILE",
        "CURLE_QUOTE_ERROR",
        "CURLE_HTTP_RETURNED_ERROR",
        "CURLE_WRITE_ERROR",
        "CURLE_UPLOAD_FAILED",
        "CURLE_READ_ERROR",
        "CURLE_OUT_OF_MEMORY",
        "CURLE_OPERATION_TIMEDOUT",
        "CURLE_FTP_PORT_FAILED",
        "CURLE_FTP_COULDNT_USE_REST",
        "CURLE_RANGE_ERROR",
        "CURLE_HTTP_POST_ERROR",
        "CURLE_SSL_CONNECT_ERROR",
        "CURLE_BAD_DOWNLOAD_RESUME",
        "CURLE_FILE_COULDNT_READ_FILE",
        "CURLE_LDAP_CANNOT_BIND",
        "CURLE_LDAP_SEARCH_FAILED",
        "CURLE_FUNCTION_NOT_FOUND",
        "CURLE_ABORTED_BY_CALLBACK",
        "CURLE_BAD_FUNCTION_ARGUMENT",
        "CURLE_INTERFACE_FAILED",
        "CURLE_TOO_MANY_REDIRECTS",
        "CURLE_UNKNOWN_TELNET_OPTION",
        "CURLE_TELNET_OPTION_SYNTAX",
        "CURLE_PEER_FAILED_VERIFICATION",
        "CURLE_GOT_NOTHING",
        "CURLE_SSL_ENGINE_NOTFOUND",
        "CURLE_SSL_ENGINE_SETFAILED",
        "CURLE_SEND_ERROR",
        "CURLE_RECV_ERROR",
        "CURLE_SSL_CERTPROBLEM",
        "CURLE_SSL_CIPHER",
        "CURLE_SSL_CACERT",
        "CURLE_BAD_CONTENT_ENCODING",
        "CURLE_LDAP_INVALID_URL",
        "CURLE_FILESIZE_EXCEEDED",
        "CURLE_USE_SSL_FAILED",
        "CURLE_SEND_FAIL_REWIND",
        "CURLE_SSL_ENGINE_INITFAILED",
        "CURLE_LOGIN_DENIED",
        "CURLE_TFTP_NOTFOUND",
        "CURLE_TFTP_PERM",
        "CURLE_REMOTE_DISK_FULL",
        "CURLE_TFTP_ILLEGAL",
        "CURLE_TFTP_UNKNOWNID",
        "CURLE_REMOTE_FILE_EXISTS",
        "CURLE_TFTP_NOSUCHUSER",
        "CURLE_CONV_FAILED",
        "CURLE_CONV_REQD",
        "CURLE_SSL_CACERT_BADFILE",
        "CURLE_REMOTE_FILE_NOT_FOUND",
        "CURLE_SSH",
        "CURLE_SSL_SHUTDOWN_FAILED",
        "CURLE_AGAIN",
        "CURLE_SSL_CRL_BADFILE",
        "CURLE_SSL_ISSUER_ERROR",
        "CURLE_FTP_PRET_FAILED",
        "CURLE_FTP_PRET_FAILED",
        "CURLE_RTSP_CSEQ_ERROR",
        "CURLE_RTSP_SESSION_ERROR",
        "CURLE_FTP_BAD_FILE_LIST",
        "CURLE_CHUNK_FAILED"
    ];

    /**
     * @param array $arParams
     * @return array|bool
     */
    public static function getPage($arParams = [])
    {
        if ($arParams) {
            if (!empty($arParams["url"])) {
                $sUrl = $arParams["url"];
                $sUserAgent = !empty($arParams["useragent"]) ? $arParams["useragent"] : "Mozilla/5.0 (Windows NT 6.3; W…) Gecko/20100101 Firefox/57.0";
                $iTimeout = !empty($arParams["timeout"]) ? $arParams["timeout"] : 5;
                $iConnectTimeout = !empty($arParams["connecttimeout"]) ? $arParams["connecttimeout"] : 5;
                $bHead = !empty($arParams["head"]) ? $arParams["head"] : false;
                $sCookieFile = !empty($arParams["cookie"]["file"]) ? $arParams["cookie"]["file"] : false;
                $bCookieSession = !empty($arParams["cookie"]["session"]) ? $arParams["cookie"]["session"] : false;
                $sProxyIp = !empty($arParams["proxy"]["ip"]) ? $arParams["proxy"]["ip"] : false;
                $iProxyPort = !empty($arParams["proxy"]["port"]) ? $arParams["proxy"]["port"] : false;
                $sProxyType = !empty($arParams["proxy"]["type"]) ? $arParams["proxy"]["type"] : false;
                $arHeaders = !empty($arParams["headers"]) ? $arParams["headers"] : false;
                $sPost = !empty($arParams["post"]) ? $arParams["post"] : false;

                if ($sCookieFile) {
                    file_put_contents(__DIR__ . "/" . $sCookieFile, "");
                }

                $rCh = curl_init();
                curl_setopt($rCh, CURLOPT_URL, $sUrl);
                curl_setopt($rCh, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($rCh, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($rCh, CURLOPT_USERAGENT, $sUserAgent);
                curl_setopt($rCh, CURLOPT_TIMEOUT, $iTimeout);
                curl_setopt($rCh, CURLOPT_CONNECTTIMEOUT, $iConnectTimeout);

                if ($bHead) {
                    curl_setopt($rCh, CURLOPT_HEADER, true);
                    curl_setopt($rCh, CURLOPT_NOBODY, true);
                }

                if (strpos($sUrl, "https") !== false) {
                    curl_setopt($rCh, CURLOPT_SSL_VERIFYHOST, true);
                    curl_setopt($rCh, CURLOPT_SSL_VERIFYPEER, true);
                }

                if ($sCookieFile) {
                    curl_setopt($rCh, CURLOPT_COOKIEJAR, __DIR__ . "/" . $sCookieFile);
                    curl_setopt($rCh, CURLOPT_COOKIEFILE, __DIR__ . "/" . $sCookieFile);

                    if ($bCookieSession) {
                        curl_setopt($rCh, CURLOPT_COOKIESESSION, true);
                    }
                }

                if ($sProxyIp && $iProxyPort && $sProxyType) {
                    curl_setopt($rCh, CURLOPT_PROXY, $sProxyIp . ":" . $iProxyPort);
                    curl_setopt($rCh, CURLOPT_PROXYTYPE, $sProxyType);
                }

                if ($arHeaders) {
                    curl_setopt($rCh, CURLOPT_HTTPHEADER, $arHeaders);
                }

                if ($sPost) {
                    curl_setopt($rCh, CURLOPT_POSTFIELDS, $sPost);
                }

                curl_setopt($rCh, CURLINFO_HEADER_OUT, true);

                $sContent = curl_exec($rCh);
                $arInfo = curl_getinfo($rCh);

                $arError = false;

                if ($sContent === false) {
                    $arData = false;

                    $arError["message"] = curl_error($rCh);
                    $arError["code"] = self::$arErrorCodes[curl_errno($rCh)];
                } else {
                    $arData["content"] = $sContent;
                    $arData["info"] = $arInfo;
                }

                curl_close($rCh);

                return [
                    "data" => $arData,
                    "error" => $arError
                ];
            }
        }

        return false;
    }
}


?>
<?




echo '<p>='.$_POST[url].'</p>';

$html = Parser::getPage([
    "url" => "https://seif-ufa.ru".$_POST['url']
]);




if(!empty($html["data"])){
    
    $content = $html["data"]["content"];
    $pq=phpQuery::newDocumentHTML($content);  

   
        echo '<p>name='.$_POST['name'].'</p>';
        echo '<p>url='.$_POST['url'].'</p>';
        echo '<p>parent='.$_POST['parent'].'</p>';

     $name = pq("h1.Single__Title--Main");
     $name_el=$name->text();
     echo '<p>name_el='.$name_el.'</p>';

     $price = pq("span.price");
     $price_el=$price->attr("data-price");
     $price_el=$price_el+1-1;
    echo '<p>price_el='.$price_el.'</p>';

    $anons = pq(".Single__Description--Text");
     $anons_el=$anons->html();
    echo '<p>anons_el='.$anons_el.'</p>';

    $sv_brend = pq(".Single__Value--Attrs.brend");
     $sv_brend_el=$sv_brend->html(); //свойство бренд
    echo '<p>sv_brend_el='.$sv_brend_el.'</p>'; 

    $sv_gabarit = pq(".Single__Value--Attrs.razmery_vneshnie_mm_vkhshkhg");
     $sv_gabarit_el=$sv_gabarit->html(); //свойство габариты
    echo '<p>sv_gabarit_el='.$sv_gabarit_el.'</p>'; 

    $sv_obyom_l = pq(".Single__Value--Attrs.obyom_l");
     $sv_obyom_l_el=$sv_obyom_l->html(); //свойство  объем
    echo '<p>sv_obyom_l_el='.$sv_obyom_l_el.'</p>'; 

    $sv_weight = pq(".Single__Value--Attrs.weight");
     $sv_weight_el=$sv_weight->html(); //свойство  вес
    echo '<p>sv_weight_el='.$sv_weight_el.'</p>'; 

    $sv_vysota_mm = pq(".Single__Value--Attrs.vysota_mm");
     $sv_vysota_mm_el=$sv_vysota_mm->html(); //свойство  высота
    echo '<p>sv_vysota_mm_el='.$sv_vysota_mm_el.'</p>'; 

    $sv_shirina_mm = pq(".Single__Value--Attrs.shirina_mm");
     $sv_shirina_mm_el=$sv_shirina_mm->html(); //свойство  ширина
    echo '<p>sv_vysota_mm_el='.$sv_shirina_mm_el.'</p>'; 

    $sv_glubina_mm = pq(".Single__Value--Attrs.glubina_mm");
     $sv_glubina_mm_el=$sv_glubina_mm->html(); //свойство  Глубина
    echo '<p>sv_vysota_mm_el='.$sv_glubina_mm_el.'</p>'; 

    $sv_tsvet = pq(".Single__Value--Attrs.tsvet");
     $sv_tsvet_el=$sv_tsvet->html(); //свойство  Цвет
    echo '<p>sv_vysota_mm_el='.$sv_tsvet_el.'</p>'; 

    $sv_razmery_vnutrennie_mm_vkhshkhg = pq(".Single__Value--Attrs.razmery_vnutrennie_mm_vkhshkhg");
     $sv_razmery_vnutrennie_mm_vkhshkhg_el=$sv_razmery_vnutrennie_mm_vkhshkhg->html(); //свойство  Размеры внутренние (ВхШхГ)
    echo '<p>sv_razmery_vnutrennie_mm_vkhshkhg_el='.$sv_razmery_vnutrennie_mm_vkhshkhg_el.'</p>'; 

    $sv_klass_vzlomostoykosti = pq(".Single__Value--Attrs.klass_vzlomostoykosti");
     $sv_klass_vzlomostoykosti_el=$sv_klass_vzlomostoykosti->html(); //свойство  Класс взломостойкости
    echo '<p>sv_klass_vzlomostoykosti_el='.$sv_klass_vzlomostoykosti_el.'</p>'; 

    $sv_kolichestvo_polok = pq(".Single__Value--Attrs.kolichestvo_polok");
     $sv_kolichestvo_polok_el=$sv_kolichestvo_polok->html(); //свойство  Количество полок
    echo '<p>sv_kolichestvo_polok_el='.$sv_kolichestvo_polok_el.'</p>'; 

    $sv_tip_zamka = pq(".Single__Value--Attrs.tip_zamka");
     $sv_tip_zamka_el=$sv_tip_zamka->html(); //свойство  Тип замка
    echo '<p>sv_tip_zamka_el='.$sv_tip_zamka_el.'</p>'; 

    $sv_tip_pokrytiya = pq(".Single__Value--Attrs.tip_pokrytiya ");
     $sv_tip_pokrytiya_el=$sv_tip_pokrytiya->html(); //свойство  Тип покрытия
    echo '<p>sv_tip_pokrytiya_el='.$sv_tip_pokrytiya_el.'</p>'; 

    $sv_garantiya = pq(".Single__Value--Attrs.garantiya");
     $sv_garantiya_el=$sv_garantiya->html(); //свойство  Гарантия
    echo '<p>sv_garantiya_el='.$sv_garantiya_el.'</p>'; 

    $sv_proizvoditel = pq(".Single__Value--Attrs.proizvoditel");
     $sv_proizvoditel_el=$sv_proizvoditel->html(); //свойство  Производитель
    echo '<p>sv_proizvoditel_el='.$sv_proizvoditel_el.'</p>'; 

    $img_prods = pq(".js-product-main-image");
    $img_href=$img_prods->attr("src");
    echo '<p>img_href='.$img_href.'</p>';

    echo '<pre>';
    print_r($img_href);
    echo '</pre>';
    /*foreach($img_prods as $key => $img_prod){
       $img_href=$img_prod->attr("href");
       echo '<p>img_href='.$img_href.'</p>';
 
    }*/
    $ur = substr($_POST[url], 0, -1);
    $ur1 = explode('/', $ur);
    $code = end($ur1);

    //print_r(end($ur1));


$picture=CFile::MakeFileArray('https://seif-ufa.ru'.$img_href);
$picture_min=CFile::MakeFileArray('https://seif-ufa.ru'.$_POST[picture]);
/*$params = Array(
   "max_len" => "100", // обрезает символьный код до 100 символов
   "change_case" => "L", // буквы преобразуются к нижнему регистру
   "replace_space" => "-", // меняем пробелы на нижнее подчеркивание
   "replace_other" => "-", // меняем левые символы на нижнее подчеркивание
   "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
   "use_google" => "false", // отключаем использование google
);*/
/*$code=CUtil::translit($_POST[name], "ru", $params);*/
//собираем массив полей



$arFields = Array(
    "IBLOCK_ID"          => 2,
    "IBLOCK_SECTION_ID"  => $_POST['parent'],
    "NAME"               => $_POST[name],
    "CODE"               => $code,
    "ACTIVE"             => "Y",
    "PRVIEW_TEXT_TYPE"   => "html",
    "PRVIEW_TEXT"        => "",
    "DETAIL_TEXT_TYPE"   => "html",
    "DETAIL_TEXT"        => $anons_el,
    "DETAIL_PICTURE"     => $picture,
    "PREVIEW_PICTURE"     => $picture_min,
    "PROPERTY_VALUES"    => Array(            // массив со свойствами инфоблока
        "CAT_BREND"  => trim($sv_brend_el),
        "CAT_GABARITI"  => trim($sv_gabarit_el),
        "CAT_OBEM"  => trim($sv_obyom_l_el),
        "CAT_VES"  => trim($sv_weight_el),
        "CAT_VISOTA"  => trim($sv_vysota_mm_el),
        "CAT_SHIRINA"  => trim($sv_shirina_mm_el),
        "CAT_GLUBINA"  => trim($sv_glubina_mm_el),
        "CAT_RAZMER_VNUTR"  => trim($sv_razmery_vnutrennie_mm_vkhshkhg_el),
        "CAT_KLASS_VZLOM"  => trim($sv_klass_vzlomostoykosti_el),
        "CAT_KOL_POLOK"  => trim($sv_kolichestvo_polok_el),
        "CAT_TIP_ZAMKA"  => trim($sv_tip_zamka_el),
        "CAT_TIP_POKRITIYA"  => trim($sv_tip_pokrytiya_el),
        "CAT_GARANTIYA"  => trim($sv_garantiya_el),
        "CAT_PROIZV"  => trim($sv_proizvoditel_el),
        "CAT_COLOR" => trim($sv_tsvet_el),
        "CAT_NAL" => 1,
    ),
);
$obElement = new CIBlockElement();

  //добавляем элемент, а ели не получается, то выводим ошибку
    $ID = $obElement->Add($arFields);
    if( $ID < 1 ) { echo $obElement->LAST_ERROR; }
    $productID = CCatalogProduct::add(array("ID" => $ID));
     // Установление цены для товара
     $arFields = Array(
         "PRODUCT_ID" => $ID,
         "CATALOG_GROUP_ID" => 1,
         "PRICE" => $price_el,
         "CURRENCY" => "RUB",
     );
      
     if(CPrice::Add($arFields))
         echo "Добавил цену ".$price_el." рублей на товар с ID: ".$ID.'<br>';
     else
         echo 'Ошибка добавления цены '.$price_el.'<br>';

//добавляем элемент, а ели не получается, то выводим ошибку
//$ID = $obElement->Add($arFields);
//if( $ID < 1 ) { echo $obElement->LAST_ERROR; }

}

?>






