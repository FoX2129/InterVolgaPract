<?php

$content = file_get_contents('Testfile.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 2


$a = new DOMXPath($dom);

$spans_name = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'Link ListingItemTitle__link')]");
$spans_cost = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' ListingItemPrice__content ')]");
$spans_year = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' ListingItem__year ')]");
$spans_run = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' ListingItem__kmAge ')]");

for ($i = $spans_name->length - 1; $i > -1; $i--) {
    $name[]         = $spans_name->item($i)->firstChild->nodeValue;
    $cost[]         = $spans_cost->item($i)->lastChild->nodeValue;
    $year[]         = $spans_year->item($i)->firstChild->nodeValue;
    $run[]          = $spans_run->item($i)->lastChild->nodeValue;
}

$spans_combine = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'ListingItemTechSummaryDesktop__cell')]");
for ($i = $spans_combine->length - 1; $i > -1; $i-=5) {

    $collor[]       = $spans_combine->item($i)->firstChild->nodeValue;
    $drive[]        = $spans_combine->item($i-1)->firstChild->nodeValue;
    $type[]         = $spans_combine->item($i-2)->firstChild->nodeValue;
    $transmission[] = $spans_combine->item($i-3)->firstChild->nodeValue;
    $engine[]       = $spans_combine->item($i-4)->firstChild->nodeValue;
}

print_r($name);
print_r($cost);
print_r($engine);
print_r($transmission);
print_r($type);
print_r($drive);
print_r($collor);
print_r($year);
print_r($run);
