<!DOCTYPE html>
<html id="mainhtml" lang="ru">
	<head>
		<title>2apps.ru - разработка мобильных приложений</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		 <link rel="shortcut icon" href="https://www.2apps.ru/favicon.ico">
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	</head>
	<body>
	<script type="text/javascript">
	function go(url,dir1,dir2){
		var $result = $("#res");
  $.ajax({
    type: "POST",
    data: {
      "url": url,
      "dir1":dir1,
      "dir2":dir2,
    },
    dataType: "html",
    url: "Parser.php",
    beforeSend: function() {
    $result.html('<div>Отправляю...</div>');
    },
    success: function(data) {
$result.html(data);


    },
  });
  console.log(url);
  }
	</script>
	<div id="res">sdfsdff</div>
<script type="text/javascript">
	<?
$names=file('parse.txt');
$count=1000;
foreach($names as $name):
	?>
<?$pieces3 = explode(";", $name);?>
setTimeout(function() {go('http://air-fresh.biz<?=substr($pieces3[2],0,-1)?>','<?=$pieces3[0]?>','<?=$pieces3[1]?>')}, <?=$count?>);
<?$count=$count+5000;
?>
<?endforeach;?>
</script>
	</body>
	</html>
