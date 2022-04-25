<?php

$headers = array(
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Cache-Control: max-age=0',
'Connection: keep-alive',
'Cookie: _csrf_token=5aa1d78afdfe754d3afd9f011cbee63bb0b6eb0703505dff; suid=7b76e8301a309333c613c2cb8e4025f3.3f5be59fe6fb91a911c2da767e89291d; counter_ga_all7=1; yuidlt=1; yandexuid=1564217981535371030; my=YysBgMIA; ys=wprid.1636185672932835-4978657586141381350-sas2-0965-9d2-sas-l7-balancer-8080-BAL-4091%23udn.cDpmb3gyMTI5; autoru_sid=a%3Ag625feb472rdd9bicm0i24bmulp4qdu0.ba8a25ffccbaa977d109dac15dc58222%7C1650453319164.604800.Vz86QKjce3DMMlXL3w8UfA.1-LNsfahidn6BXrfBeQ3lpIpdkX95AUFD_cpYBcC0mo; autoruuid=g625feb472rdd9bicm0i24bmulp4qdu0.ba8a25ffccbaa977d109dac15dc58222; gids=38; los=1; bltsr=1; gradius=200; spravka=dD0xNjUwNDU1NjgyO2k9MTg4LjIzMy45NS4yNDg7RD0zOTRDNDE5Nzk5MkVFODZCNTI0MEJFRkEyQUQ3NEQyQkI5N0I3NTAxM0I1MzJDQUNCODg1ODYzNjk2RTI0MjI3RDRFMzhENzU7dT0xNjUwNDU1NjgyMDI0NjY4MDM0O2g9Njk3ZDM4MzAzOWUwZWY2ZmQ5MTVmMTEzNjhmZDJkYjE=; from=direct; _yasc=b/xaWpt6+t7+aTPUbrmxuQqSjp7xd/BSPFgkDZzW1azi7qph; from_lifetime=1650563254792',
'Host: auto.ru',
'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="100", "Microsoft Edge";v="100"',
'sec-ch-ua-mobile: ?0',
'sec-ch-ua-platform: "Windows"',
'Sec-Fetch-Dest: document',
'Sec-Fetch-Mode: navigate',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-User: ?1',
'sec-gpc: 1',
'Upgrade-Insecure-Requests: 1',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44');

$url = 'https://auto.ru/volgograd/cars/gaz/all/?page=1';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
$content = curl_exec($ch);
curl_close($ch);



print_r($content);

file_put_contents('Testfile.html', $content);
echo "Downloading page is done";
