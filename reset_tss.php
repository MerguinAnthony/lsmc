<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://127.0.0.1:8000/service/transfert-tss-lasttss");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
