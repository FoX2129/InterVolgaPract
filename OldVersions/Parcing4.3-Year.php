<?php

$content = file_get_contents('Testfile1.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 1


$a = new DOMXPath($dom);


for ($i = $spans_year->length - 1; $i > -1; $i--) {

}

print_r($year);