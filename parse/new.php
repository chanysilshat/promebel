<?php
session_start();
//require_once 'connection.php'; // подключаем скрипт
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<?php
// Подключаем класс для работы с excel
require_once('PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
require_once('PHPExcel/Writer/Excel5.php');



if ($_GET['go'])
{
$style_wrap = array(
    // рамки
    'borders'=>array(
        // внешняя рамка
        'outline' => array(
            'style'=>PHPExcel_Style_Border::BORDER_THICK,
            'color' => array(
                'rgb'=>'000000'
            )
        ),
        // внутренняя
        'allborders'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb'=>'000000'
            )
        )
    )
);
// Создаем объект класса PHPExcel
$xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('План-факт лиды');






// выставляем заголовки столбцов
$sheet->setCellValueByColumnAndRow(0,2,"№");
$sheet->setCellValueByColumnAndRow(1,2,"Проект");



$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);



// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=lidy.xls" );
 
// Выводим содержимое файла
 $objWriter = new PHPExcel_Writer_Excel5($xls);
 $objWriter->save('php://output');
 
}
?>
