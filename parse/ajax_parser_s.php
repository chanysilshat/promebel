<!DOCTYPE html>
<html id="mainhtml" lang="ru">
 <head>
  <title>Мой сайи</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 </head>
 <body>
 <script type="text/javascript">
 function go(url,name,counter){
 
  var $result = $("#res");
  $.ajax({
    type: "POST",
    data: {
      //"dir":dir,
     "name":name,
      //"img":img,
     // "anons":anons,
      "url":url,
      "counter":counter,
    },
    dataType: "html",
    url: "ajax_parser_element_zapis2.php",
    beforeSend: function() {
    $result.html('<div>Отправляю...</div>');
    },
    success: function(data) {
$result.html(data);


    },
  });

  }
 </script>
 <div id="res">поехали</div>
<script type="text/javascript">
 <?
$counter=1; 
$names=file('element.txt');
$count=5000;
foreach($names as $name):
 ?>
<?$pieces3 = explode(";", $name);?>
setTimeout(function() {go('<?echo substr($pieces3[2],0,-1);?>','<?=$pieces3[1]?>','<?=$counter?>');}, <?=$count?>);
<?$count=$count+105000;
$counter++;
?>
<?endforeach;?>
</script>
 </body>
 </html>