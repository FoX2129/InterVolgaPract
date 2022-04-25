<?php

$string = '2.5 л / 70 л.с. / Бензин';
#echo strpos($string,'л');
$array= array(
    substr($string,0,strpos($string,' ')),
    substr($string,strpos($string,' ')+7,strpos($string,' ',strpos($string,' ')+7)-strpos($string,' ')-7-1),
    substr($string,strpos($string,' ',(strpos($string,' ')+7)+1)+7)
);