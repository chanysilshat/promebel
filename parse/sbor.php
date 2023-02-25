<?php ob_start();
session_start();
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();
CModule::IncludeModule("iblock");
CModule::IncludeModule('sale');

echo '
<style>
table{border-collapse:collapse;}
table td{border:solid 1px #000;}
</style>
<table style="width:100%;">
';

if ($_GET['go']==1)
{
// Подключаем класс для работы с excel
//require_once('PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
//require_once('PHPExcel/Writer/Excel5.php');



//$years='2019';	


// Создаем объект класса PHPExcel
//$xls = new PHPExcel();
// Устанавливаем индекс активного листа
//$xls->setActiveSheetIndex(0);
// Получаем активный лист
//$sheet = $xls->getActiveSheet();
// Подписываем лист
//$sheet->setTitle('Ветна аналитика заказов');
	
	
// выставляем заголовки столбцов
//$sheet->setCellValueByColumnAndRow(0,2,"№");
//$sheet->setCellValueByColumnAndRow(1,2,"Проект");	
	
$line_gor=2;	
$line_vert=1;
echo '
<tr>
	<td>
	
	</td>
	<td calspan="4">
	Январь
	</td>
	<td calspan="4">
	Февраль
	</td>
	<td calspan="4">
	Март
	</td>
	<td calspan="4">
	Апрель
	</td>
	<td calspan="4">
	Май
	</td>
	<td calspan="4">
	Июнь
	</td>
	<td calspan="4">
	Июль
	</td>
	<td calspan="4">
	Август
	</td>
	<td calspan="4">
	Сентябрь
	</td>
	<td calspan="4">
	Октябрь
	</td>
	<td calspan="4">
	Ноябрь
	</td>
	<td calspan="4">
	Декабрь
	</td>	
</tr>
';
for ($y = 2017; $y <= 2017; $y++) {
echo '<tr >
<td >'.$y.'</td>
';	
	
//$sheet->setCellValueByColumnAndRow(0,$line_gor,$y);	
	for ($m = 1; $m <= 12; $m++) {
$PAY_SYSTEM_1=7;	//онлайн оплата		
$PAY_SYSTEM_2=5;	//нал курьеру	
$PAY_SYSTEM_3=2;	//картой курьеру курьеру	



		
	switch ($m) {
		case 1:
			$text_mes= 'Январь';
			break;
		case 2:
			$text_mes= 'Февраль';
			break;
		case 3:
			$text_mes= 'Март';
			break;
		case 4:
			$text_mes= 'Апрель';
			break;
		case 5:
			$text_mes= 'Май';
			break;
		case 6:
			$text_mes= 'Июнь';
			break;
		case 7:
			$text_mes= 'Июль';
			break;
		case 8:
			$text_mes= 'Август';
			break;
		case 9:
			$text_mes= 'Сентябрь';
			break;
		case 10:
			$text_mes= 'Октябрь';
			break;
		case 11:
			$text_mes= 'Ноябрь';
			break;
		case 12:
			$text_mes='Декабрь';
			break;			
	}
$line_gor_m=$line_gor-1;
//$sheet->setCellValueByColumnAndRow($line_vert,$line_gor_m,$text_mes); //выводим месяц

	//echo '<p>'.$text_mes.'</p>';
// Выведем даты всех заказов текущего пользователя за текущий месяц, отсортированные по дате заказа
$arFilter = Array(
   "!USER_ID" => array(3126,1),
   ">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, $m, 1, $y)),
   "<=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, $m, 31, $y)),
   );

$kol=0;
$kol_op1=0;
$kol_op2=0;
$kol_op3=0;
$kol_op4=0;
$kol_op5=0;
$kol_oplat=0;
$kol_dost1=0;
$kol_dost2=0;
$kol_dost3=0;

$summa_op1=0;
$summa_op2=0;
$summa_op3=0;
$summa_op4=0;
$summa_op5=0;
$summa_oplat=0;
$summa_dost1=0;
$summa_dost2=0;
$summa_dost3=0;


$summa=0;
$sr_summa=0;
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
$summa=$summa+$ar_sales["SUM_PAID"];

if ($ar_sales["PAY_SYSTEM_ID"]==7){$kol_op1++;$summa_op1=$summa_op1+$ar_sales["SUM_PAID"];}
if ($ar_sales["PAY_SYSTEM_ID"]==4){$kol_op2++;$summa_op2=$summa_op2+$ar_sales["SUM_PAID"];}
if ($ar_sales["PAY_SYSTEM_ID"]==2){$kol_op3++;$summa_op3=$summa_op3+$ar_sales["SUM_PAID"];} 
if ($ar_sales["PAY_SYSTEM_ID"]==5){$kol_op4++;$summa_op4=$summa_op4+$ar_sales["SUM_PAID"];}
if ($ar_sales["PAY_SYSTEM_ID"]==''){$kol_op5++;$summa_op5=$summa_op5+$ar_sales["SUM_PAID"];}

if ($ar_sales["DELIVERY_ID"]==3){$kol_dost1++;$summa_dost1=$summa_dost1+$ar_sales["SUM_PAID"];}
if ($ar_sales["DELIVERY_ID"]==4){$kol_dost2++;$summa_dost2=$summa_dost2+$ar_sales["SUM_PAID"];}
if ($ar_sales["DELIVERY_ID"]==5){$kol_dost3++;$summa_dost3=$summa_dost3+$ar_sales["SUM_PAID"];} 
if (($ar_sales["PAYED"]=='Y') and ($ar_sales["PAY_SYSTEM_ID"]==7)){$kol_oplat++;$summa_oplat=$summa_oplat+$ar_sales["SUM_PAID"];;} 
//   echo $ar_sales["DATE_INSERT_FORMAT"]."<br>";
   $kol++;
}
$sr_summa=round($summa/$kol);
echo '
<td>
<table>
	<tr>
';
echo '<td colspan="5">'.$kol.'</td>';
echo '
	</tr>
	<tr>
		<td>Онлайн картой</td>
		<td>Оплата наличными курьеру</td>
		<td>Банковской картой курьеру</td>
		<td>Наличный расчет</td>
		<td>Не определено</td>
	</tr>
	<tr>
		<td>'.$kol_op1.'('.$kol_oplat.')</td>
		<td>'.$kol_op2.'</td>
		<td>'.$kol_op3.'</td>
		<td>'.$kol_op4.'</td>
		<td>'.$kol_op5.'</td>
	</tr>
	<tr>
		<td colspan="2">Доставка</td>
		<td colspan="2">Самовывоз</td>
		<td>Пункт выдачи</td>
	</tr>
	<tr>
		<td colspan="2">'.$kol_dost1.'</td>
		<td colspan="2">'.$kol_dost2.'</td>
		<td>'.$kol_dost3.'</td>
	</tr>
	<tr>
';
echo '<tr>
<td colspan="5">'.$summa.' р.</td>';

echo '</tr>';
echo '
	<tr>
		<td>Онлайн картой</td>
		<td>Оплата наличными курьеру</td>
		<td>Банковской картой курьеру</td>
		<td>Наличный расчет</td>
		<td>Не определено</td>
	</tr>
	<tr>
		<td>'.$summa_op1.' р.('.$summa_oplat.' р.)</td>
		<td>'.$summa_op2.' р.</td>
		<td>'.$summa_op3.' р.</td>
		<td>'.$summa_op4.' р.</td>
		<td>'.$summa_op5.' р.</td>
	</tr>
	<tr>
		<td colspan="2">Доставка</td>
		<td colspan="2">Самовывоз</td>
		<td>Пункт выдачи</td>
	</tr>
	<tr>
		<td colspan="2">'.$summa_dost1.' р.</td>
		<td colspan="2">'.$summa_dost2.' р.</td>
		<td>'.$summa_dost3.' р.</td>
	</tr>
	<tr>
';
echo '
	</tr>
	
</table>
</td>
';
//	echo '<p>Кол-во заказов='.$kol.'</p>';
//	echo '<p>Сумма заказов='.$summa.'</p>';
//	echo '<p>Средний чек='.$sr_summa.'</p>';



//$sheet->setCellValueByColumnAndRow($line_vert,$line_gor,$kol); //выводим кол-во заказов

//$vert_opl1=$line_vert;
//$line_opl=$line_gor+1;
//$line_opl_ch=$line_gor+2;
//$vert_opl2=$line_vert+1;
//$vert_opl3=$line_vert+2;
//$vert_opl4=$line_vert+3;

//////////////////////////////// разбивка по оплате

//$sheet->setCellValueByColumnAndRow($vert_opl1,$line_opl,"онлайн оплата"); //выводим онлайн опллат
//$sheet->setCellValueByColumnAndRow($vert_opl2,$line_opl,"нал курьеру"); //выводим онлайн опллат
//$sheet->setCellValueByColumnAndRow($vert_opl3,$line_opl,"картой курьеру"); //выводим онлайн опллат
//$sheet->setCellValueByColumnAndRow($vert_opl4,$line_opl,"наличными"); //выводим онлайн опллат
//$sheet->setCellValueByColumnAndRow($vert_opl1,$line_opl_ch,$kol_op1);
//$sheet->setCellValueByColumnAndRow($vert_opl2,$line_opl_ch,$kol_op2);
//$sheet->setCellValueByColumnAndRow($vert_opl3,$line_opl_ch,$kol_op3);
//$sheet->setCellValueByColumnAndRow($vert_opl4,$line_opl_ch,$kol_op4);

//$sheet->setCellValueByColumnAndRow($vert_opl1,$line_opl,"онлайн оплата"); //выводим онлайн опллат
//$sheet->setCellValueByColumnAndRow($vert_opl2,$line_opl,"нал курьеру"); //выводим онлайн опллат
//$sheet->setCellValueByColumnAndRow($vert_opl3,$line_opl,"картой курьеру"); //выводим онлайн опллат
//$sheet->setCellValueByColumnAndRow($vert_opl4,$line_opl,"наличными"); //выводим онлайн опллат


	$line_vert=$line_vert+4;
}

	$line_gor++;
	
echo '</tr>';	
}


/*
// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=vet_op.xls" );
 
// Выводим содержимое файла
 $objWriter = new PHPExcel_Writer_Excel5($xls);
 $objWriter->save('php://output');
*/

echo '</table>';
}

?>




