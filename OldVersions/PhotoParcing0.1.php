<?php
$content = file_get_contents('Testfile1.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 2




$nodes = array();
$nodes = $dom->getElementsByTagName("a");
print_r($nodes);
foreach ($nodes as $element)
{
    $classy = $element->getAttribute("href");
    if (str_contains($classy, "https://auto.ru/cars/used/sale/")&&($classy!=$last))
    {
        echo $classy,"\n";
        $last=$classy;
    }

}
echo $last,"<--- Этот был последний \n";




echo "done";