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
 function go(url,counter){
 
  var $result = $("#res");
  $.ajax({
    type: "POST",
    data: {
      //"dir":dir,
     //"name":name,
     // "img":img,
     // "anons":anons,
      "url":url,
      "counter":counter,
    },
    dataType: "html",
    url: "ajax_parser.php",
    beforeSend: function() {
    $result.html('<div>Отправляю...</div>');
    },
    success: function(data) {
$result.html(data);


    },
  });
 // console.log(id);
  }
 </script>
 <div id="res">sdfsdff</div>
<script type="text/javascript">
 <?
$counter=1; 
$names=file('text_klich.txt');
$count=5000;

 ?>
<?

	for ($i=1;$i<2354;$i++){

?>
setTimeout(function() {go("<?echo '/shop/?PAGEN_1='.$i?>","<?=$counter?>");}, <?=$count?>);
<?	
	$counter++;
	$count=$count+4000;
	}


?>



</script>
 </body>
 </html>