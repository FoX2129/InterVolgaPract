<?php


$content = file_get_contents('Testfile.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 2

$classname = "Link ListingItemTitle__link";

$a = new DOMXPath($dom);
$spans = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'Link ListingItemTitle__link')]");

for ($i = $spans->length - 1; $i > -1; $i--) {
    #$result[] = $spans->item($i)->firstChild->nodeValue;
    $name[] = $spans->item($i)->firstChild->nodeValue;
}

print_r($name);
exit();

