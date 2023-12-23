<?php

// ZAQzaq12
include_once "config.php";

function encode($unencoded,$key)
{ //Шифруем
    $string=base64_encode($unencoded);//Переводим в base64

    $arr=array();//Это массив
    $x=0;
    $newstr = '';
    while ($x++< strlen($string))
    {//Цикл
        $arr[$x-1] = md5(md5($key.$string[$x-1]).$key);//Почти чистый md5
        $newstr = $newstr.$arr[$x-1][3].$arr[$x-1][6].$arr[$x-1][1].$arr[$x-1][2];//Склеиваем символы
    }
    return $newstr; //Вертаем строку
}


