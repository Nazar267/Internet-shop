<?php


class AdminProductController extends AdminBase {

public function actionIndex() {

    self::checkAdmin();

   $productsList = Product::getProductsList();



   require_once(ROOT.'/views/admin_product/index.php');
return true;

}

public function actionDelete($id)
{
   self::checkAdmin();
    if(isset($_POST['submit']))
    {
        Product::deleteProductById($id);
        header("location: /admin/product");
    }

    require_once(ROOT.'/views/admin_product/delete.php');
    return true;
}

public function actionCreate() {
   
    self::checkAdmin();
     
   $categoriesList = Category::getCategoryList();

   if(isset($_POST['submit']))
   {
    $options["name"] = $_POST['name'];
    $options["code"] = $_POST['code'];
    $options["price"] = $_POST['price'];
    $options["category_id"] = $_POST['category_id'];
    $options["brand"] = $_POST['brand'];
    $options["description"] = $_POST['description'];
    $options["availability"] = $_POST['availability'];
    $options["is_new"] = $_POST['is_new'];
    $options["is_recommended"] = $_POST['is_recommended'];
    $options["status"] = $_POST['status'];

    $errors = false;

    // Валідація ...
    if(empty($options["name"])|| !isset($options['name']))  // якщо нічого не запишемо в name
    {
        $errors[] = "Заповніть всі поля";
    }
  
    if($errors == false){
       $id = Product:: createProduct($options);

       if($id)
       {
        if(is_uploaded_file($_FILES['image']['tmp_name']))  // чи завантажився той файл який ми надсилали
          {
            move_uploaded_file($_FILES['image']['tmp_name'],ROOT. "/upload/images/product$id.jpg");
          }    
       }
       header("location: /admin/product");
    }

   }

    require_once(ROOT.'/views/admin_product/create.php');
    return true;
}


public function actionUpdate($id) {

    self::checkAdmin();

    $categoriesList = Category::getCategoryList();

    $product = Product::getProductById($id);


    if(isset($_POST["submit"])) {

        $options["name"] = $_POST["name"];
        $options["code"] = $_POST["code"];
        $options["price"] = $_POST["price"];
        $options["category_id"] = $_POST["category_id"];
        $options["brand"] = $_POST["brand"];
        $options["description"] = $_POST["description"];
        $options["availability"] = $_POST["availability"];
        $options["is_new"] = $_POST["is_new"];
        $options["is_recommended"] = $_POST["is_recommended"];
        $options["status"] = $_POST["status"];
       
        $errors = false;

        // Валідація...
        if(!isset($options["name"]) || empty($options["name"]) ) {
            $errors[] = "Заповніть всі поля";
        }

        if($errors == false) {

            if(Product::updateProduct($id, $options)) {
                if(is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/upload/images/product$id.jpg");
                }
            }

            
                
            

            header("location: /admin/product");

        }

    }
    



    require_once(ROOT . "/views/admin_product/update.php");
    return true;
}

    


}