<?if($APPLICATION->GetCurPage() != '/'):?>
	</div>
<?endif;?>
<footer class="m-footer">
	<div class="m-footer-logo">Интернет-магазин сейфов и металлической мебели</div>
	<a href="/kontakty/" class="m-footer-address">
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
	</a>
	<div class="m-footer-mail">
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
	<div class="m-footer-phone">
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
</footer>
<div class="m-footer-info">
	<a href="" class="m-footer-info-ir"></a>
	<div class="m-footer-info-polit">
		Отправляя любую форму на сайте, вы соглашаетесь с <a href="/politika-konfidentsialnosti/">политикой конфиденциальности</a> данного сайта.
	</div>
</div>