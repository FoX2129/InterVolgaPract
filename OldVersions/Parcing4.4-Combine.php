<?php

$content = file_get_contents('Testfile.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 2

$classname = "ListingItemTechSummaryDesktop__cell";

$a = new DOMXPath($dom);
$spans = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

for ($i = $spans->length - 1; $i > -1; $i-=5) {
    $collor[] = $spans->item($i)->firstChild->nodeValue;
    $drive[] = $spans->item($i-1)->firstChild->nodeValue;
    $type[] = $spans->item($i-2)->firstChild->nodeValue;
    $transmission[] = $spans->item($i-3)->firstChild->nodeValue;
    $engine[] = $spans->item($i-4)->firstChild->nodeValue;
}

print_r($collor);
print_r($drive);
print_r($type);
print_r($transmission);
print_r($engine);
exit();
