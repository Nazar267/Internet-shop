<?php

class AdminCategoryController extends AdminBase
{

    

public function actionIndex() {

    self::checkAdmin();
    $categoriesList = Category::getCategoryList();

    require_once(ROOT. '/views/admin_category/index.php' );
    return true;
}

public function actionCreate()
{

    self::checkAdmin();

if(isset($_POST['submit']))
{
$option['name'] = $_POST['name'];
$option['sort_order'] = $_POST['sort_order'];
$option['status'] = $_POST['status'];

$errors = false;

if(empty($option['name'] || !isset($option['name'])))
{
$errors[] = 'Заповніть усі поля';
}

if($errors == false)
{
   $idCategory = Category::createCategory($option);

   if($idCategory)
   header('location: admin/category');

}

}

require_once(ROOT.'/views/admin_category/create.php');
return true;
}

public function actionUpdate($id)
{
self::checkAdmin();

$category = Category::getCategoryById($id);

if(isset($_POST['submit']))
{
$option['name'] = $_POST['name'];
$option['sort_order'] = $_POST['sort_order'];
$option['status'] = $_POST['status'];

$errors = false;

if(!isset($option['name']) || empty($option['name']))
{
$errors[] = 'Заповніть коректно всі поля';
}

if($errors == false)
{
Category::updateCategory($id,$option);

header('location: admin/category');

}

}

require_once(ROOT.'/views/admin_category/update.php');
return true;
}

public function actionDelete($id)
{
self::checkAdmin();

if(isset($_POST['submit']))
{
Category::deleteCategory($id);
header('location: admin/category');
}

require_once(ROOT.'/views/admin_category/delete.php');
return true;
}


}
