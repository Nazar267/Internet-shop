<?php

class CabinetController{

public function actionIndex(){
   

     $userId = User::checkLogged();


     $user = User::getUserById($userId);

    require_once(ROOT.'/views/cabinet/index.php');
    return true;
}

public function actionEdit()
{
   

    $userId = User::checkLogged();

  $user =  User::getUserById($userId);
  
  $name= $user["name"];
  $password = $user["password"]; 

   $errors=false;
   $result = false;

   if(isset($_POST["submit"]))
   {
    $name=$_POST['name'];
    $password = $_POST['password'];
   
    if(!User::checkName($name)){
        $errors[]="ім'я має бути ....";
    }

    if(!User::checkPassword($password)){
        $errors[]="Пароль має бути ....";
    }

    if($errors == false)
    {
        $result = User::edit($userId,$name, $password);
    }

   }
    require_once(ROOT.'/views/cabinet/edit.php');
    return true;
}


public function actionHistory($userId)
{

    $categories = Category::getCategoryList();

    $order = Order::getOrderByUserId($userId);
   
     $products = [];
     
     $someArr = [];

   for ($i=0; $i < count($order); $i++) 
    { 

     $tmp =  json_decode(($order[$i]['products']),true); 
     
        array_push($someArr, $tmp);
     
   
 
     $ids = array_keys($tmp);   



      foreach ($ids as $value) {
      array_push($products,$value);      
      }     
    
    }    
      
    $IdAndCount = [];


for ($i=0; $i < count($someArr); $i++) { 
    
    foreach ($someArr[$i] as $key => $value) {
        if(array_key_exists($key,$IdAndCount))
        {
            $IdAndCount[$key] += $value;
        }
        else{
            $IdAndCount[$key] = $value;
        }   
    }
}   
    $products = Cart::getProductsByIds($products);

    require_once(ROOT. '/views/cabinet/history.php');
    return true;
}






}