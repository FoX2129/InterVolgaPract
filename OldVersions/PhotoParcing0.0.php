<?php
$content = file_get_contents('Testfile1.html');
$dom = new DOMDocument;	//создаем объект
libxml_use_internal_errors(true); //скрываем ошибки часть 1
$dom->loadHTML($content);	//загружаем контент
libxml_clear_errors();  //скрываем ошибки часть 2




$nodes = array();
$nodes = $dom->getElementsByTagName("img");
print_r($nodes);
foreach ($nodes as $element)
{
    $classy = $element->getAttribute("src");
    if ((str_contains($classy, "//yastatic.net/naydex/autoru/")) || (str_contains($classy, "//avatars.mds.yandex.net/get-autoru-vos/")))
    {
        echo $classy,"\n";
    }

}
echo "done";