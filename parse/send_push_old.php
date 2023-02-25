<?
$url = 'https://fcm.googleapis.com/fcm/send';
$YOUR_API_KEY = 'AAAAcOVUMZc:APA91bHCPKrKLvdczO4jvwuUVlBaJPUPDwbjZ19hZvYkH5bTsEMl16Y5zi8IWmAQ74N1Ii7JobgTR7sAFuzB28FAA6820leQCknXRNhdQ5giw9S67ycNb1iHYMVe7uRvs4sug8ldAIoz'; // Server key
$YOUR_TOKEN_ID = '484883837335'; // Client token id

$request_body = [
    'to' => $YOUR_TOKEN_ID,
    'notification' => [
        'title' => 'Тестовая акция',
        'body' => sprintf('Начало в %s.', date('H:i')),
        'icon' => 'https://vetna.info/bitrix/templates/vetna_copy/images/k12.png',
        'click_action' => 'https://vetna.info/',
    ],
];
$fields = json_encode($request_body);

$request_headers = [
    'Content-Type: application/json',
    'Authorization: key=' . $YOUR_API_KEY,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>