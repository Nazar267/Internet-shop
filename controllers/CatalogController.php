<?php

class CatalogController{

public function actionIndex(){

$categories=Category::getCategoryList();
$latestProducts=Product::getLatestProducts(12);

include_once(ROOT.'/views/catalog/index.php');
    return true;
}

public function actionCategory($categoryId, $page = 1){  // $page параметр 



// витягуємо всі категорії, щоб відображати зліва
$categories= Category::getCategoryList();

// Витягуємо всі продукти за id_category
$categoryProducts = Product::getProductListByCategory($categoryId, $page);

$total = Product::getTotalProductsInCategory($categoryId);

$pagination = new Pagination($total,$page,Product::SHOW_BY_DEFAULT,'page-');

    require_once(ROOT.'/views/catalog/category.php');
    return true;
}


}
 