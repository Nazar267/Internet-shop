<?php

class CartController{

public function actionIndex()  // переважно index описується згори
{

   $categories = Category::getCategoryList();

    // отримати товари із сесії(там ми зберігаємо id і к-сть товарів по тій id)

   $productsInCart = Cart::getProducts(); 

    // отрмиати повністю інформацію про товари 
   //
    if($productsInCart)  // перевіряю чи взагалі є кісь товари в корзині
    {
       $productsIds = array_keys($productsInCart);  // візье асоціативнйи масив і поверне лише ключі з нього
  
      $products =  Cart::getProductsByIds($productsIds);  // отримємо товари по аідішках
 
      // визначити загальну суму
    
     $totalPrice =  Cart::getTotalPrice($products);
    
    }

   
require_once(ROOT."/views/cart/index.php");
    return true;
}


public function actionAdd($id)
{
// add product to cart

Cart::addProduct($id);


$referer = $_SERVER["HTTP_REFERER"];   // щоб взнати маршрут зідки ми потрапили в корзину
header("location: $referer");
    return true;
}


public function actionDelete($id)
{


Cart::deleteProduct($id);
$referer = $_SERVER["HTTP_REFERER"];
header("location: $referer");
    return true;
}


public function actionCheckout()
{
 $categories = Category::getCategoryList();

 $result = false;

 $errors = false;

 if(isset($_POST['submit'])) {  // первіряємо чи форма відправлена чи ні
  // форма відправлена
     $userName = $_POST['userName'];
     $userPhone= $_POST['userPhone'];
     $userComment = $_POST['userComment']; // Витягнули з форми інформацію

    if(!User::checkName($userName))
    {
        $errors[] = "ім'я ає бути..";
    }
    if(!User::checkPhone($userPhone))
    {
        $errors[] = "Телефон макє бути";
    }

    if($errors == false)
    {
        // форма заповена коректно 

        $productsInCart = Cart::getProducts(); // витягуємо всі товари з корзини
         $userId = false;
        if(!User::isGuest())
        {
          $userId = User::checkLogged();
        }

       $result =  Order::save($userName,$userPhone, $userComment, $userId, $productsInCart);
     
       if($result)
       {
        Cart::clear();
       }
    
    
    }
    else{
        // форма заповенана не коректно
        $productsInCart = Cart::getProducts();
        $productsIds = array_keys($productsInCart);
        $products = Cart::getProductsByIds($productsIds); // повертаються товари
        $totalPrice =  Cart::getTotalPrice($products);
        $totalQuantity = Cart::countItems();
    }

 }
 else{
// форма не відправлена;
$productsInCart =  Cart::getProducts(); // поверне товари з корзини

if($productsInCart == false)
{
    // якщо в корзині немає товарів
 header("location: /");
}
else{
    // витягуємо всі товари і показуємо їх
   $productsIds = array_keys($productsInCart);  // витягуємоо ключі ids
   $products = Cart::getProductsByIds($productsIds); // повертаються товари по ids які є в корзині
   $totalPrice =  Cart::getTotalPrice($products);  // сума товарів
   $totalQuantity = Cart::countItems(); // загальна к-сть товарів
      $userName = '';
      $userPhone = '';
      $userComment = '';
    if(!User::isGuest())
    {
       $userId = User::checkLogged(); //  отримаємо id користувача
      $user = User::getUserById($userId); // по id користувача повертанеться нам користувач

      $userName = $user["name"];  
    }
    else
    {



    }



}

 }

require_once(ROOT."/views/cart/checkout.php");

    return true;
}


}
