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
$html = Parser::getPage([
    "url" => 'https://baxi.ru/production/'
]);
if(!empty($html["data"])){
    $content = $html["data"]["content"];
    phpQuery::newDocumentHTML($content,'UTF8');
    $products = pq(".products-list");
    $tmp = [];

    foreach($products as $key => $product){

        $product = pq($product);

        $tmp[] = [
            "href" => trim($product->find("a.products-list-head")->attr("href")),
            "img" => trim($product->find("img")->attr("src")),
            "name" => trim($product->find("a.products-list-head")->text()),
        ];


    }

    phpQuery::unloadDocuments();


}
$count1=0;
$text='';
/*
foreach($tmp as $value){	
	$count1++;
	$url=$value[img];
	$url_mass=explode("/", $url);
	$file_name=end($url_mass);
	$text.=$count1.';'.$value[href].';'.$file_name.';'.$value[name]."\n";
	$picture=CFile::MakeFileArray('https://baxi.ru'.$value[img]);

$bs = new CIBlockSection;
$arFields = Array(
  "ACTIVE" =>"Y",
 // "IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
  "IBLOCK_ID" => 45,
  "NAME" => $value[name],
  "SORT" => "500",
  "PICTURE" => $picture,
  "DESCRIPTION" => "",
  "UF_OLD_URL" => $value[href],
  "DESCRIPTION_TYPE" => ""
  );

$ID = $bs->Add($arFields);



}
*/
function pars($id_sect,$ss_sect){
	$url_parce='https://baxi.ru'.$ss_sect;
	$html = Parser::getPage([
		"url" => $url_parce
	]);
	if(!empty($html["data"])){
		$content = $html["data"]["content"];
		phpQuery::newDocumentHTML($content,'UTF8');
		$products = pq(".cart");
		$tmp = [];

		foreach($products as $key => $product){

			$product = pq($product);

			$tmp[] = [
				"href" => trim($product->find("a.read-more")->attr("href")),
				"img" => trim($product->find("img")->attr("src")),
				"name" => trim($product->find("h2")->text()),
				"anons" => trim($product->find("p")->text()),
			];
		}
		phpQuery::unloadDocuments();
	}	

	$text='';
	$count1=0;
	foreach($tmp as $value){	
	$count1++;
	$url=$value[img];
	$url_mass=explode("/", $url);
	$file_name=end($url_mass);
	$text.=$id_sect.';'.$value[name].';'.$value[img].';'.$value[anons].';'.$value[href]."\n";

	
	/*
	$text.=$count1.';'.$value[href].';'.$file_name.';'.$value[name]."\n";
	$picture=CFile::MakeFileArray('https://baxi.ru'.$value[img]);
	$params = array("replace_space"=>"-","replace_other"=>"-");
	$code=CUtil::translit($value[name], "ru", $params);
	
	$bs = new CIBlockSection;
	$arFields = Array(
	  "ACTIVE" =>"Y",
	  "IBLOCK_SECTION_ID" => $id_sect,
	  "IBLOCK_ID" => 45,
	  "NAME" => $value[name],
	  "SORT" => "500",
	  "CODE" => $code,
	  "PICTURE" => $picture,
	  "DESCRIPTION" => "",
	  "UF_OLD_URL" => $value[href],
	  "DESCRIPTION_TYPE" => ""
	  );
	$ID = $bs->Add($arFields);
	*/	
	}
	
	$file = 'parents1.txt';
	// Открываем файл для получения существующего содержимого
	$current = file_get_contents($file);
	// Добавляем нового человека в файл
	$current .= $text;
	// Пишем содержимое обратно в файл
	file_put_contents($file, $current);	
}


// for ($x=1; $x<3; $x++){
echo '<p>'.$x.'</p>';	
$arSelect_1 = Array('ID', 'NAME','UF_OLD_URL');
$arFilter_1 = Array('IBLOCK_ID'=>45, 'GLOBAL_ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y','DEPTH_LEVEL'=>2);
$row1 = CIBlockSection::GetList(Array("ID"=>"DESC"), $arFilter_1, false, $arSelect_1, Array("nPageSize"=>100));	
while($mass_row1 = $row1->GetNext())
{
$id_sect=$mass_row1['ID'];
$ss_sect=$mass_row1['UF_OLD_URL'];

echo '<p>'.$id_sect.'</p>';
pars($id_sect,$ss_sect);
}

//}







/*
foreach($tmp as $value){	
    $count1++;
    $url_arr=$value[img];
    $url_arr_dot=explode("/", $url_arr);
    $img=end($url_arr_dot);
    $aa.=$count1.';'.$value[name].';'.$img.';'.$value[href]."\n";
    //скачивание файла
    $ch = curl_init('https://baxi.ru/production'.$url_arr);//откуда качаем
    $fp = fopen('storage/'.$img, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}
$file = 'parents1.txt';
// Открываем файл для получения существующего содержимого
$current = file_get_contents($file);
// Добавляем нового человека в файл
$current .= $aa;
// Пишем содержимое обратно в файл
file_put_contents($file, $current);
*/
?>




