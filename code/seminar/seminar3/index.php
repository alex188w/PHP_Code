<?php
$fileContents = file_get_contents('File.txt');
echo $fileContents . "<br/>";

$file = fopen("File.txt", "r");
$data = fread($file, 100);
fclose($file);
echo $data  . "<br/>";

$file = 'people.txt';
file_put_contents($file, 'Иван Иванов');
$fileContents = file_get_contents('people.txt');
echo $fileContents . "<br/>";


// $address = 'birthdays.txt';
// $name = readline("Введите имя: ");
// $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
// $data = $name . ", " . $date . "\r\n";
// $fileHandler = fopen($address, 'a');
// if(fwrite($fileHandler, $data)){
// echo "Запись $data добавлена в файл $address";
// }
// else {
//     echo "Произошла ошибка записи. Данные не сохранены";
// }
// fclose($fileHandler);