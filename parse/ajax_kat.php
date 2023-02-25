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
 function go(dir,name,url,counter){
 console.log(dir);
 console.log(name);
 console.log(url);
 console.log(counter);

  var $result = $("#res");
  $.ajax({
    type: "POST",
    data: {
      "dir":dir,
      "name":name,
      "url":url,
      "counter":counter,
    },
    dataType: "html",
    url: "ajax_parser_kat.php",
    beforeSend: function() {
    $result.html('<div>Отправляю...</div>');
    },
    success: function(data) {
$result.html(data);


    },
  });

//  console.log(id);
  }
 </script>
 <div id="res">sdfsdff</div>
<script type="text/javascript">
 <?
$counter=1; 
$names=file('parents.txt');
$count=5000;
foreach($names as $name):
 ?>
<?$pieces3 = explode(";", $name);?>
setTimeout(function() {go("<?=$pieces3[1]?>","<?=$pieces3[2]?>","<?echo substr($pieces3[4],0,-1);?>","<?=$counter?>");}, <?=$count?>);
<?$count=$count+7000;
$counter++;
?>
<?endforeach;?>
</script>
 </body>
 </html>