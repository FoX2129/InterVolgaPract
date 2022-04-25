<?php

$content = file_get_contents('Testfile1.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 2


$a = new DOMXPath($dom);

$spans_name = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'Link ListingItemTitle__link')]");//Забиваем NodeList названиями,
$spans_cost = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' ListingItemPrice__content ')]");//ценами,
$spans_year = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' ListingItem__year ')]");//годами производства,
$spans_run = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' ListingItem__kmAge ')]");//пробегом
$spans_combine = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'ListingItemTechSummaryDesktop__cell')]");//и данными сдвигателся.

for ($i = $spans_name->length - 1; $i > -1; $i--) { //идём с конца всех данных и копируем значения Node-ов в ячейки одного элемента массива
    $string=$spans_combine->item(($i+1)*5-5)->firstChild->nodeValue;
    $data[]=array($spans_name->item($i)->firstChild->nodeValue, #кладём этот элемент в массив
        $spans_cost->item($i)->lastChild->nodeValue,
        $spans_year->item($i)->firstChild->nodeValue,
        $spans_run->item($i)->lastChild->nodeValue,
        $spans_combine->item(($i+1)*5-1)->firstChild->nodeValue,
        $spans_combine->item(($i+1)*5-2)->firstChild->nodeValue,
        $spans_combine->item(($i+1)*5-3)->firstChild->nodeValue,
        $spans_combine->item(($i+1)*5-4)->firstChild->nodeValue,
        substr($string,0,strpos($string,' ')),
        substr($string,strpos($string,' ')+7,strpos($string,' ',strpos($string,' ')+7)-strpos($string,' ')-7-1),
        substr($string,strpos($string,' ',(strpos($string,' ')+7)+1)+7)
        );
    /*echo mb_check_encoding($spans_cost->item($i)->lastChild->nodeValue, "UTF-8")*/;
}

print_r($data);

$fp = fopen('Array.csv', 'w');//начинаем запись текстовой информации в файл
foreach ($data as $fields) {
    fputcsv($fp, $fields,';');
}
fclose($fp);
echo "Copy in 'Array.csv' is done";