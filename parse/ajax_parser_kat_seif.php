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

        echo '<p>'.$_POST['name'].'</p>';
        echo '<p>'.$_POST['url'].'</p>';
        echo '<p>'.$_POST['parent'].'</p>';


function pars($id_sect,$ss_sect){
    $url_parce='https://seif-ufa.ru'.$ss_sect;
    echo '<p>'.$url_parce.'</p>';
    $html = Parser::getPage([
        "url" => $url_parce
    ]);
    if(!empty($html["data"])){
        $content = $html["data"]["content"];
        $pq=phpQuery::newDocumentHTML($content,'');

        $products = pq(".Product__Box--Plate");

        foreach($products as $key => $product){
            
            echo '<p>tut</p>';
            $product = pq($product);
            //$name=trim($product->text());
            $name=$product->find('.Product__Link--Slider')->text();
            $src=$product->find('.Product__Image--Product')->attr("src");
            $url=$product->find('a.Product__Link--Image')->attr("href");

            echo '<p>1='.$name.'</p>';
             echo '<p>2='.$src.'</p>';
              echo '<p>3='.$url.'</p>';

              $tmp[] = [
                       // "href" => trim($product->attr("href")),
                       //"img" => trim($product->find("img")->attr("src")),
                       "name" => trim($name),
                       "src" => $src,
                       "href" => $url,
                        //"text" => trim($product->html()),
                    ];       

        }
        foreach($tmp as $value){
        $count1++;
        $aa.=$count1.';'.$value[name].';'.$value[href].';'.$value[src].';'.$_POST['parent'].';'."\n";
        
 /*    
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
*/
}
}

$file = 'seif_new.txt';
// Открываем файл для получения существующего содержимого
$current = file_get_contents($file);
// Добавляем нового человека в файл
$current .= $aa;
// Пишем содержимое обратно в файл
file_put_contents($file, $current);
file_put_contents($count, $count1); 


}



for ($i=1; $i <= 30; $i++) { 
    pars('',$_POST['url'].'?page='.$i);
}


    /*
$svojstvo1 = pq(".new_saleprtext tr");  
foreach($svojstvo1 as $key => $sv){
    echo '<p>7777777777777</p>';
    $sv = pq($sv);
    $text=$sv->find('.saleblue')->html();
    echo '<p>text='.$text.'</p>';   
}   
    */


    /*
$count = 'counter_element_id.txt';  
$count1=intval(file_get_contents($count));
$arSelect_1 = Array('ID', 'NAME','DETAIL_PAGE_URL','PRVIEW_TEXT','DETAIL_TEXT');
$arFilter_1 = Array('IBLOCK_ID'=>40, 'NAME'=>$_POST[name]);
$row1 = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter_1, false, Array("nPageSize"=>1), $arSelect_1);   
while($mass_row1 = $row1->GetNext())
{

    
$brend='';  
$dlina='';  
$vysota=''; 
$shirina='';    
$moschnost='';  
$napryazhenie='';   
$razmer_proitivnya='';  
$temperatur_rezhim='';  
$kolvo_urovnej='';  
$ves='';    
$img='';
$id_el=$mass_row1['ID'];
$prev_text= $mass_row1['PRVIEW_TEXT'];
$det_text= $mass_row1['DETAIL_TEXT'];
$descr='';  



    
    $img=$pq->find('.gallery-images')->attr("href");
    
    $descr=$pq->find('#description')->html();   
    
    
    $svojstvo = pq(".availability");
    foreach($svojstvo as $key => $sv){
        $sv = pq($sv);
        $text=$sv->html();
        echo '<p>text='.$text.'</p>';
////////////////////////////////            
$pos = strpos($text, 'Производитель');
if ($pos === false) {
   
} else {    
    $brend=$sv->find('span')->text();   
}       
////////////////////////////////    
$pos = strpos($text, 'Ширина нетто');
if ($pos === false) {
   
} else {    
    $shirina=$sv->find('span')->text(); 
}   
////////////////////////////////        
$pos = strpos($text, 'Высота нетто');
if ($pos === false) {
   
} else {    
    $vysota=$sv->find('span')->text();  
}   
////////////////////////////////
$pos = strpos($text, 'Длина нетто');
if ($pos === false) {
   
} else {    
    $dlina=$sv->find('span')->text();   
}   
////////////////////////////////
$pos = strpos($text, 'Мощность электрическая');
if ($pos === false) {
   
} else {    
    $moschnost=$sv->find('span')->text();   
}   
////////////////////////////////
$pos = strpos($text, 'Вес нетто');
if ($pos === false) {
   
} else {    
    $ves=$sv->find('span')->text(); 
}   
////////////////////////////////
$pos = strpos($text, 'Напряжение, В');
if ($pos === false) {
   
} else {    
    $napryazhenie=$sv->find('span')->text();    
}   
////////////////////////////////
$pos = strpos($text, 'Размер противня');
if ($pos === false) {
   
} else {    
    $razmer_proitivnya=$sv->find('span')->text();   
}   
////////////////////////////////
$pos = strpos($text, 'Температурный режим');
if ($pos === false) {
   
} else {    
    $temperatur_rezhim=$sv->find('span')->text();   
}   
////////////////////////////////
$pos = strpos($text, 'Количество уровней');
if ($pos === false) {
   
} else {    
    $kolvo_urovnej=$sv->find('span')->text();   
}   
////////////////////////////////
    
    
    }

echo '<p>$img='.$img.'</p>';
echo '<p>$brend='.$brend.'</p>';
echo '<p>$dlina='.$dlina.'</p>';
echo '<p>$vysota='.$vysota.'</p>';
echo '<p>$shirina='.$shirina.'</p>';
echo '<p>$moschnost='.$moschnost.'</p>';
echo '<p>$ves='.$ves.'</p>';
echo '<p>$napryazhenie='.$napryazhenie.'</p>';
echo '<p>$razmer_proitivnya='.$razmer_proitivnya.'</p>';
echo '<p>$temperatur_rezhim='.$temperatur_rezhim.'</p>';
echo '<p>$kolvo_urovnej='.$kolvo_urovnej.'</p>';
$detailPicture = CFile::MakeFileArray('https://www.zvezdy.ru'.$img);

$PROP = array();
$PROP[812] = $brend;  
$PROP[845] = $dlina;  
$PROP[826] = $vysota;  
$PROP[872] = $shirina;  
$PROP[886] = $moschnost;  
$PROP[840] = $ves;  
$PROP[885] = $napryazhenie;  
$PROP[915] = $razmer_proitivnya;  
$PROP[928] = $temperatur_rezhim;  
$PROP[912] = $kolvo_urovnej;  

echo '<pre>';
Print_r($detailPicture);
echo '</pre>';

 if(CModule::IncludeModule('iblock')){  
$el = new CIBlockElement;


////////////////////////////
if (($prev_text=='') and ($det_text=='')){
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), 
      "IBLOCK_SECTION_ID" => "",
      "IBLOCK_ID"      => 40,
      "ACTIVE"         => "Y", 
        "PREVIEW_TEXT"   => "",
        "DETAIL_TEXT"    => $descr,
      "DETAIL_PICTURE"     => $detailPicture,
      "PREVIEW_PICTURE"     => $detailPicture,
    "PROPERTY_VALUES"=> $PROP,
      );  
}
if (($prev_text=='') and ($det_text!='')){
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), 
      "IBLOCK_SECTION_ID" => "",
      "IBLOCK_ID"      => 40,
      "ACTIVE"         => "Y", 
        "PREVIEW_TEXT"   => $descr,
      "DETAIL_PICTURE"     => $detailPicture,
      "PREVIEW_PICTURE"     => $detailPicture,
    "PROPERTY_VALUES"=> $PROP,
      );  
}
if (($prev_text!='') and ($det_text=='')){
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), 
      "IBLOCK_SECTION_ID" => "",
      "IBLOCK_ID"      => 40,
      "ACTIVE"         => "Y", 
        "DETAIL_TEXT"    => $descr,
      "DETAIL_PICTURE"     => $detailPicture,
      "PREVIEW_PICTURE"     => $detailPicture,
    "PROPERTY_VALUES"=> $PROP,
      );  
}
///////////////////////////////  
  
$res = $el->Update($id_el,$arLoadProductArray);   
 echo '<p>'.$id_el.'</p>'; 


echo '<pre>sdsdsd';
Print_r($res);
echo '</pre>sdsdsd';
echo 'fffffffffffff';
 }

/*
$brend=801
$dlina=845
$vysota=826
$shirina=872
$moschnost=886
$ves=840
$napryazhenie=885
$razmer_proitivnya=915
$temperatur_rezhim=928
$kolvo_urovnej=912  



    
    //$brend=$pq->find('.availability:nth-child(2) span')->text();
    

    
    //$strana=$pq->find(".availability-sku .availability:nth-child(3)")->test();
    //echo '<p>$strana='.$strana.'</p>';


    $aa=$count1.';'.$_POST[name].';'.$_POST[url].';'.$mass_row1['ID']."\n";
    $file = 'element.txt';
    // Открываем файл для получения существующего содержимого
    $current = file_get_contents($file);
    // Добавляем нового человека в файл
    $current .= $aa;
    // Пишем содержимое обратно в файл
    file_put_contents($file, $current);
    
    
    
}
*/

    
//file_put_contents($count, $count1); 
        
/*

    
    
    
            
    $products = pq(".product-inner");
    $tmp = [];
    
    foreach($products as $key => $product){

        $product = pq($product);

        $tmp[] = [
            "href" => trim($product->find(".product a")->attr("href")),
            "img" => trim($product->find(".product img")->attr("src")),
            "name" => trim($product->find("a.text-danger")->text()),
        ];


    }   
    
*/
    
/*  
$count = 'counter_element.txt';
$count1=intval(file_get_contents($count));


foreach($tmp as $value){
$count1++;
$aa.=$count1.';'.$value[name].';'.$value[href].';'.$value[img]."\n";

}

echo '<pre>';
Print_r($aa);
echo '</pre>';

$file = 'text_razdel_element.txt';
// Открываем файл для получения существующего содержимого
$current = file_get_contents($file);
// Добавляем нового человека в файл
$current .= $aa;
// Пишем содержимое обратно в файл
file_put_contents($file, $current);
file_put_contents($count, $count1); 
*/



    
    /*
    //$products = pq("table table table tr");

    //$hrefy=$pq->find('#workarea div');
    $detail_text=$pq->find('main.tm-content')->html();
    echo '--------------------------';
    echo '<pre>';
    Print_r($detail_text);
    echo '</pre>';
    
    echo '$detail_text='.$detail_text;
    
    
    $imgs = pq("#workarea img");
    $tmp[]='';
    foreach ($imgs as $img){
        $img = pq($img);
        
        
        $ss_img = $img->attr("src");
        $pos = strpos($ss_img, '/upload/');
if ($pos === false) {
  //  echo "Строка '$findme' не найдена в строке '$mystring1'";
} 
else {
   // echo '<p>$ss_img='.$ss_img.'</p>';

    $url_arr=$ss_img;
    $url_arr_dot=explode("/", $url_arr);
    $img_n=end($url_arr_dot);
    $ch = curl_init('http://www.minepets.ru'.$ss_img);//откуда качаем
    $fp = fopen('storage/'.$img_n, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);    
    
    $tmp[]=[
        "img" => $ss_img,
        "img_new" => '/storage/'.$img_n,
    ];
}
    }
*/
/*  
    foreach ($tmp as $tmp_obmen){
        if ($tmp_obmen["img"]!=''){
        echo '<p>'.$tmp_obmen["img"].' на '.$tmp_obmen["img_new"].'</p>';
        $detail_text = str_replace($tmp_obmen["img"], $tmp_obmen["img_new"], $detail_text);
        }
    }
*/  

//echo '<p>анонс фото = '.$tmp[1]['img'].'</p>';
    


/*
//$picture=CFile::MakeFileArray('http://www.veterinarka.ru'.$_POST[url]);
$params = Array(
   "max_len" => "100", // обрезает символьный код до 100 символов
   "change_case" => "L", // буквы преобразуются к нижнему регистру
   "replace_space" => "-", // меняем пробелы на нижнее подчеркивание
   "replace_other" => "-", // меняем левые символы на нижнее подчеркивание
   "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
   "use_google" => "false", // отключаем использование google
);
$code=CUtil::translit($_POST[name], "ru", $params);
//собираем массив полей

$arFields = Array(
    "IBLOCK_ID"          => 30,
    "IBLOCK_SECTION_ID"  => 173,
    "NAME"               => $_POST[name],
    "CODE"               => $code,
    "ACTIVE"             => "N",
    "PRVIEW_TEXT_TYPE"   => "html",
    "PRVIEW_TEXT"        => "",
    "DETAIL_TEXT_TYPE"   => "html",
    "DETAIL_TEXT"        => $detail_text,
    "DETAIL_PICTURE"     => "",
    //"PREVIEW_PICTURE"     => $picture,
    "PROPERTY_VALUES"    => Array(            // массив со свойствами инфоблока
        "ISTOK"  => "www.veterinarka.ru",
    ),
);
$obElement = new CIBlockElement();
*/


//добавляем элемент, а ели не получается, то выводим ошибку
//$ID = $obElement->Add($arFields);
//if( $ID < 1 ) { echo $obElement->LAST_ERROR; }




}

?>






