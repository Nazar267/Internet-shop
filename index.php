<?php
// FRONT CONTROLLER     // всі запити ідуть сюди



// 1. Загальні налаштування
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// 2. Підключення файлів сиситеми
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/autoload.php');

 
// require_once(ROOT . '/components/Router.php');  // їх вже не потрібно, оскільки autuload.php також буде шукати ті класи ...
// require_once(ROOT . '/components/Db.php');


// 3. З'єднання з БД


// 4. Виклик Router
$router = new Router();
$router->run();