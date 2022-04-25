<?php

$content = file_get_contents('Testfile1.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 2


$a = new DOMXPath($dom);


for ($i = 0; $i < $spans_cost->length; $i++) {
    $result[] = $spans_cost->item($i)->lastChild->nodeValue;
}

print_r($result);
