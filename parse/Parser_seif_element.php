<?php ob_start();
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();
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


$count1=0;
$text='';

function pars($id_sect,$ss_sect){
    $url_parce='https://seif-ufa.ru'.$ss_sect;
	echo '<p>'.$url_parce.'</p>';
    $html = Parser::getPage([
        "url" => $url_parce
    ]);
    if(!empty($html["data"])){
        $content = $html["data"]["content"];
		$pq=phpQuery::newDocumentHTML($content,'');
        
		//$detail_text=$pq->find('#workarea table td')->html();//777

		

		
		$products = pq("a.Category__Item--All.-image");


        foreach($products as $key => $product){
            
            echo '<p>tut</p>';
            $product = pq($product);
            //$name=trim($product->text());
            $name=$product->find('.Category__Span--All')->text();
            $src=$product->find('.Category__Image--All')->attr("src");
            $url=$product->attr("href");
            echo '<p>1='.$name.'</p>';
             echo '<p>2='.$src.'</p>';
              echo '<p>3='.$url.'</p>';
/*
создание раздела

*/

/*$bs2 = new CIBlockSection;
$arFields2 = Array(
"ACTIVE" => 'Y',
    "IBLOCK_ID" => 2,
    "IBLOCK_SECTION_ID" => 1,
    "NAME" => trim($name),
    /*"DESCRIPTION" => $id_user,*/
    /*"UF_STATUS" => 4,*/
/*);
$ID = $bs2->Add($arFields2);

echo '<p>4='.$ID.'</p>';*/

/*$params = Array(
   "max_len" => "100", // обрезает символьный код до 100 символов
   "change_case" => "L", // буквы преобразуются к нижнему регистру
   "replace_space" => "-", // меняем пробелы на нижнее подчеркивание
   "replace_other" => "-", // меняем левые символы на нижнее подчеркивание
   "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
   "use_google" => "false", // отключаем использование google
);
$code=CUtil::translit($name, "ru", $params);*/

$url2 = explode('/', $url);
$picture=CFile::MakeFileArray('https://seif-ufa.ru'.$src);
$bs = new CIBlockSection;
$arFields = Array(
  "ACTIVE" => 'Y',
  "IBLOCK_SECTION_ID" => 74,
  "IBLOCK_ID" => 2,
  "CODE"               => $url2['2'],
  "NAME" => $name,
  "SORT" => '',
  "PICTURE" => $picture,
  "DESCRIPTION" => '',
  "DESCRIPTION_TYPE" => ''
  );


  $ID = $bs->Add($arFields);
  $res = ($ID>0);

echo '<p>ID='.$ID.'</p>';
if(!$res)
echo $bs->LAST_ERROR;

                    $tmp[] = [
                       // "href" => trim($product->attr("href")),
                       //"img" => trim($product->find("img")->attr("src")),
                       "name" => trim($name),
                       "src" => $src,
                       "href" => $url,
                       "id_razd_bitrix" => $ID,
                        //"text" => trim($product->html()),
                    ];       




            }

foreach($tmp as $value){
$count1++;
$aa.=$count1.';'.$value[name].';'.$value[href].';'.$value[src].';'.$value[id_razd_bitrix].';'."\n";

}
/*			
        $tmp = [];

		// echo '<pre>';
		// Print_r($products);
		// echo '<pre>';

        foreach($products as $key => $product){
			
			echo '<p>tut</p>';
            $product = pq($product);
                    $tmp[] = [
                        "href" => trim($product->attr("href")),
                       //"img" => trim($product->find("img")->attr("src")),
                       "name" => trim($product->text()),
                        //"text" => trim($product->html()),
                    ];            
            }
		
			
        phpQuery::unloadDocuments();
    }

    
$count = 'counter.txt';
$count1=intval(file_get_contents($count));
foreach($tmp as $value){
$count1++;
$aa.=$count1.';'.$value[name].';'.$value[href]."\n";



	



$params = Array(
   "max_len" => "70", // обрезает символьный код до 100 символов
   "change_case" => "L", // буквы преобразуются к нижнему регистру
   "replace_space" => "-", // меняем пробелы на нижнее подчеркивание
   "replace_other" => "-", // меняем левые символы на нижнее подчеркивание
   "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
   "use_google" => "false", // отключаем использование google
);
$code=CUtil::translit($value[name], "ru", $params);
//собираем массив полей


/*
$arFields = Array(
    "IBLOCK_ID"          => 16,
    "IBLOCK_SECTION_ID"  => 27,
    "NAME"               => $value[name],
    "CODE"               => $code,
    "ACTIVE"             => "N",
    "PRVIEW_TEXT_TYPE"   => "html",
    "PRVIEW_TEXT"        => "",
    "DETAIL_TEXT_TYPE"   => "html",
    "DETAIL_TEXT"        => $value[text],
    "DETAIL_PICTURE"     => "",
    "PREVIEW_PICTURE"     => "",
    "PROPERTY_VALUES"    => Array(            // массив со свойствами инфоблока
        "ISTOK"  =>  'textarchive.ru',
    ),
);
$obElement = new CIBlockElement();
*/
//добавляем элемент, а ели не получается, то выводим ошибку
// $ID = $obElement->Add($arFields);
// if( $ID < 1 ) { echo $obElement->LAST_ERROR; }
// echo $_POST[url];


}

$file = 'seif56.txt';
// Открываем файл для получения существующего содержимого
$current = file_get_contents($file);
// Добавляем нового человека в файл
$current .= $aa;
// Пишем содержимое обратно в файл
file_put_contents($file, $current);
file_put_contents($count, $count1); 


}  
/*
for ($i=1; $i <= 16; $i++) { 
    pars('','/seyfy/seyfy-yevropeyskoy-sertifikatsii/?page='.$i);
}
*/
	pars('','/seyfy/seyfy/dopolnitelnye-aksessuary-dlya-seyfov/');




?>



