<?php
$page=1;
$content = file_get_contents('Testfile'.$page.'.html');
$dom = new DOMDocument;	//создаем объект
$dom1 = new DOMDocument;
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент

$headers = array(
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Cache-Control: max-age=0',
    'Connection: keep-alive',
    'Cookie: _csrf_token=5aa1d78afdfe754d3afd9f011cbee63bb0b6eb0703505dff; suid=7b76e8301a309333c613c2cb8e4025f3.3f5be59fe6fb91a911c2da767e89291d; counter_ga_all7=1; yuidlt=1; yandexuid=1564217981535371030; my=YysBgMIA; ys=wprid.1636185672932835-4978657586141381350-sas2-0965-9d2-sas-l7-balancer-8080-BAL-4091%23udn.cDpmb3gyMTI5; autoru_sid=a%3Ag625feb472rdd9bicm0i24bmulp4qdu0.ba8a25ffccbaa977d109dac15dc58222%7C1650453319164.604800.Vz86QKjce3DMMlXL3w8UfA.1-LNsfahidn6BXrfBeQ3lpIpdkX95AUFD_cpYBcC0mo; autoruuid=g625feb472rdd9bicm0i24bmulp4qdu0.ba8a25ffccbaa977d109dac15dc58222; gids=38; los=1; bltsr=1; gradius=200; from=direct; cmtchd=MTY1MDU3Mzk1ODgwMQ==; crookie=LeM47LDAuKeIAgyPJCsf+8aXuNmo4qlhXqmbaHsiiGdBgkVA+VxHDV4wwejTrmFNn1Ve6GGO2EkL6cxzfGd8l5HjVTI=; yandex_login=fox2129; i=fFh1ox5aPNfd6H6p25bTXuBH3xf2rhxqouomT/3/8gneemhreUcB5XdNxKjZcQF/qxWNT4jq7WWOOzTyWgHDmAkJHf0=; safe_deal_promo=-1; autoru-visits-count=4; _yasc=lpSrwS+fsOyJJ1jkJAthNtkQplDI2dSk5LyLFSIdC4D0CxyF; Session_id=3:1650825170.5.0.1644764676899:RivTsg:ce.1.2:1|307988193.0.2|61:3965.215825.gekDtHntKfS-Wx2i1ZqL3q0krmo; mda2_beacon=1650825170177; sso_status=sso.passport.yandex.ru:blocked; spravka=dD0xNjUwODI1NjY1O2k9MTg4LjIzMy45NS4yNDg7RD0wMTkwNzZFM0Y3NzdBRjA2Rjk5RTEwNEQ0QjYzQTk3NDdFQjM5NTlCNjA4QUQ1MkYwMjE3NEMwQ0ZCRkQxRDM4MkQ4OTg1MEY7dT0xNjUwODI1NjY1NzUyNzg4NzI1O2g9MDA3MzE0MTE1ZTg4NzUyNTI5NWQ4ODI2OTA4NzY2ZDc=; from_lifetime=1650825670464',
    'Host: auto.ru',
    'sec-ch1-ua: " Not A;Brand";v="99", "Chromium";v="100", "Microsoft Edge";v="100"',
    'sec-ch1-ua-mobile: ?0',
    'sec-ch1-ua-platform: "Windows"',
    'Sec-Fetch-Dest: document',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-User: ?1',
    'sec-gpc: 1',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44'
);

$nodes_photo = array();
$nodes_photo = $dom->getElementsByTagName("a");
$last = '';
$cari=1;
foreach ($nodes_photo as $element)
{
    $classy_photo = $element->getAttribute("href");
    if (str_contains($classy_photo, "https://auto.ru/cars/used/sale/")&&($classy_photo!=$last))
    {
        echo $classy_photo."\n";
        $last=$classy_photo;
        $url = $last;
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 500);
        curl_setopt($ch1, CURLOPT_TIMEOUT, 400);
        curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch1, CURLOPT_REFERER, $url);
        curl_setopt($ch1, CURLOPT_COOKIEFILE, __DIR__ . '/cookieAuto.txt');
        curl_setopt($ch1, CURLOPT_COOKIEJAR, __DIR__ . '/cookieAuto.txt');
        $content_car = curl_exec($ch1);
        curl_close($ch1);

        echo "Downloading page is done"."\n";


        $dom1->loadHTML($content_car);	//загружаем контент
        if($dom1->getElementsByTagName("title")->item(0)->textContent != 'Ошибка 404! Страница не найдена. - AUTO.RU') {
            $photo_nodes = array();
            $photo_nodes = $dom1->getElementsByTagName("img");
            foreach ($photo_nodes as $element1)
            {
                if (str_contains($element1->getAttribute("class"), "ImageGalleryDesktop__image"))
                {
                    $classy1 = $element1->getAttribute("src");
                    $file=file_get_contents('http:'.$classy1);
                    echo $classy1."\n";
                    break;
                }
            };
            file_put_contents('Auto-'.($cari+($page-1)*38).'.jpg',$file);

        }
        else{
            copy('NoPhoto.jpg','Auto-'.($cari+($page-1)*38).'.jpg');
            echo "Фото отстутствует!";
            $cari++;
        }
    }

}
