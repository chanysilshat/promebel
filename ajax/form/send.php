<?
$name=$_POST['name'];
$phone=$_POST['phone'];

$to = "web2@site-rb.ru";
$to2 = "site_analiz@mail.ru";

$subject = 'Заявка с сайта Сейфы. Тема: '.$_POST['tema'];

if (($_POST['name']!='') and ($_POST['name']!=' ')){

$message = 
    '<b>От кого: </b>'.$_POST['name'].'<br>
	 <b>Контакты: </b>'.$_POST['phone'].'<br>
	 <b>Страница, с которой написали: </b>'.$_POST['page'].'<br>';
	
	
$headers  = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From:promebelrf <info@promebelrf.ru>\r\n";
$headers .= "Reply-To: info@promebelrf.ru\r\n";


mail($to, $subject, $message, $headers, '-f info@promebelrf.ru');

echo '<div class="popup-mess-consult">Спасибо за заявку! <br> Мы скоро вам перезвоним</div>';
}
?>