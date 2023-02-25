<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<div class="contact">
<script src="https://api-maps.yandex.ru/2.1/?apikey=e68ad316-957b-45bd-8f91-b88b78ccf785&lang=ru_RU"></script>
	<div class="contact-info">
		<div class="contact-info-item">
			<div class="contact-title">Адрес местонахождения компании</div>
			<div class="contact-text">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/bitrix/templates/seif/include/file/address.php"
					)
				);?>
			</div>
		</div>
		<div class="contact-info-item">
			<div class="contact-title">Телефон</div>
			<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/bitrix/templates/seif/include/file/phone.php"
					)
				);?>
		</div>
		<div class="contact-info-item">
			<div class="contact-title">E-mail</div>
			<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/bitrix/templates/seif/include/file/mail.php"
					)
				);?>
		</div>
		<div class="contact-info-item">
			<div class="contact-title">Режим работы</div>
			<div class="contact-text">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/bitrix/templates/seif/include/file/work.php"
					)
				);?>
			</div>
		</div>
		<?/*?><div class="contact-info-item">
			<div class="contact-title">Как добраться</div>
			<div class="contact-text">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/bitrix/templates/seif/include/file/how-to-get.php"
					)
				);?>
			</div>
		</div><?*/?>
	</div>
	<img src="/bitrix/templates/seif/images/contact-min.jpg" class="contact-mesto" alt="Контакты">
	<div id="map" class="contact-map" style="width: 100%; height: 400px"></div>
</div>
<script>
	ymaps.ready(init);
        function init(){
            var myMap = new ymaps.Map("map", {
                center: [54.785761, 56.066731],
                zoom: 15
            });
       

	    myMap.geoObjects
	        .add(new ymaps.Placemark([54.785761, 56.066731], {
	            balloonContent: 'Улица Новоженова, 90/1 (офис на 2 этаже), Уфа, Республика Башкортостан, Россия'
	        }, {
	            preset: 'islands#blueDotIcon'
	        }));
	        myMap.behaviors.disable('scrollZoom'); 
        }
        
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>