<?php

// ZAQzaq12
include_once "config.php";

//$test_code = encode('pass_mang4', 'mang4');

// var_dump($test_code); 

// die();


function encode($unencoded,$key)
{//Шифруем
    $string=base64_encode($unencoded);//Переводим в base64

    $arr=array();//Это массив
    $x=0;
    while ($x++< strlen($string))
    {//Цикл
        $arr[$x-1] = md5(md5($key.$string[$x-1]).$key);//Почти чистый md5
        $newstr = $newstr.$arr[$x-1][3].$arr[$x-1][6].$arr[$x-1][1].$arr[$x-1][2];//Склеиваем символы
    }
    return $newstr; //Вертаем строку
}


/*
Створити файл і підключити pass.php
Ajax повертає $_POST;

$login = $_POST['login'];
$pass = encode($_POST['pass'], $login);
Відправити запит до бд, якщо знайде результати то повернути json_success (дивитися в інеті як повернути json_success) = true, інакше false
*/
