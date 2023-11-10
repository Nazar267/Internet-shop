<?php

// якщо в нас описана функція __autoload() і якщо ми в тому SiteController ми будемо використовувати якийсь клас, якщо в нас описана функція 
// __autoload() то викличеться автоматично функція __autoload() в її параметр передасться назва класу який зараз використовується в даному випадку
// ' Category '  і ми будемо шукати в папках(які прописані в масиві функції _autoload() ) файлик який буде наз. $path =  ROOT . $path . $className . '.php'
class SiteController{

public function actionIndex(){


// Нам треба витягнути категорії, має бути модель, яка буде працювати з категоріями
   $categories = Category::getCategoryList();
   $latestProducts = Product::getLatestProducts();
   $recommendedProducts = Product::getRecommendedProducts();

require_once(ROOT.'/views/site/index.php');   // тут ми підключаємо view куди будемо виводити дані, у папці view створюємо папку site і створюємо файлик index
// По назві Controller називаємо папку, по назва action називаємо view

return true;
}



}