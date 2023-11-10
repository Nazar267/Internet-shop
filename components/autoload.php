<?php

function myloader($className)      // ф-ія має називатись строго __autoload($className) приймає 1 параметр назву класу
{
// тут ми маємо сказати, в яких папках шукати оцей клас зробимо масив
$arrayPath = [
    '/models/',    // В оцій папці ми будемо шукати файлики з класами
  
    '/components/'  // Так само ми зробимо для компонентів, тобто там де ми підключаємо компоненти ми заберемо силки
];


   foreach ($arrayPath as $path) {
    // нам треба сформувати весь шлях по відношенню до ROOT не просто папка /models/ а саме по відношенню до ROOT
   $path =  ROOT . $path . $className . '.php';

    if(is_file($path))   // якщо такий файлик є, то він підключиться 
    include_once($path);     // підключаємо файл в якому знах клас 

   }


}
// Не забуваємо цей autoload.php піключити
// autoload() функція буде працювати коли ми називєамо php файлик аналогічно до класу який в ньому або клас називаємо так само як php- файлик 

// В php 8.0 ми повинні ще реєструвати цю функцію (або якщо вибиває помикла __autoload() is no longer supported)

spl_autoload_register('myloader');   // параметром вона приймає назву нашої autoload-функції