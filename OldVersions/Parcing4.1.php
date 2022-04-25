<?php

#$headers = array(
#'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
/*'Cache-Control: max-age=0',
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

$url = 'https://auto.ru/volgograd/cars/gaz/all/?page=2';
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
curl_close($ch);*/

$content = file_get_contents('Testfile.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 1
$node = $dom->getElementsByTagName('span');   //берем все теги a


for ($i = 0; $i < $node->length; $i++) {
    $hrefText[] = $node->item($i)->textContent;	//вытаскиваем из тега атрибут href
}

for($i = 0; $i < $hrefText->length; $i++ ){	//избавляемся от ссылок с пустым атрибутом href
    if($hrefText[$i]!=''){
        unset($hrefText[$i]);;
    }
}

#print_r($hrefText);

/*
$root = $dom->getElementsByTagName('body')->item(0); // Добираемся до корневого элемента root
$nodelist = $root->childNodes; // Получаем объект NodeList, содержащий список дочерних узлов у root
for ($i = 0; $i < $nodelist->length; $i++) {
    $child = $nodelist->item($i); // Получаем i-й узел
    echo $child->nodeName . "\n"; // Выводим информацию об узле
    $proNodeList = $child->childNodes;
    for ($j = 0; $j < $proNodeList->length; $j++) {
        echo "-";
        $prochild = $nodelist->item($j); // Получаем i-й узел
        echo $prochild->nodeName . "\n"; // Выводим информацию об узле

    }
}*/


$classname = "ListingItem";

$a = new DOMXPath($dom);
$spans = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

for ($i = $spans->length - 1; $i > -1; $i--) {
    #$result[] = $spans->item($i)->firstChild->nodeValue;
    $result[] = $spans->item($i)->firstChild;
}



print_r($spans->item(0)->childNodes->item(0)->firstChild);
exit();


/*file_put_contents('Testfile.html', $content);
echo($content);*/