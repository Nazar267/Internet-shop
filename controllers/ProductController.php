<?php

class ProductController{

    // якщо всі товари основна сторінка якогось розділу сайту Index



public function actionView($id){     // якщо щось одне(одна новина, один товар)
 
$categories = Category::getCategoryList();
$product = Product::getProductById($id);


require_once(ROOT.'/views/product/view.php');

return true;
}




}

