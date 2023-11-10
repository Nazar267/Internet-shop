<?php


class Cart{



public static function addProduct($id)
{
$productsInCart = [];

if(isset($_SESSION["products"])){
    $productsInCart = $_SESSION['products'];
}


if(array_key_exists($id,$productsInCart))
{
    $productsInCart[$id]++;
}
else{
    $productsInCart[$id]=1;  //  створили новий елемент по клчику $id і добавили товар зі значенням 1
}

$_SESSION['products']=$productsInCart;



}

public static function countItems()
{
    $count = 0;
  if(isset($_SESSION['products']))
  {

    foreach ($_SESSION['products'] as $id => $quantity) {
      $count+=$quantity;
    }

  }
      return $count;


}


public static function getProducts()
{

    if(isset($_SESSION['products']))
    return $_SESSION['products'];
return false;


}

public static function getProductsByIds($idsArray)
{

$idsString =  implode(', ',$idsArray); //  з масиву робить стрічку 

$db = Db::getConnection();
$query = "SELECT * from product WHERE id IN($idsString)"; // IN буде шкати всі товари по id які входять в пeрелік айдішок

$result = $db->query($query);

return $result->fetchAll(PDO::FETCH_ASSOC);  // fetchAll() щоб зробити масивом $resul. Двовимірний масив
}


public static function getTotalPrice($products) // модель не обов'язково має досупатись до БД вона може містити логіку
{
$productsInCart = self::getProducts(); //self:: викоик метода з-під класу
$total = 0;
if($productsInCart)
{
  foreach ($products as $product) {
    $total+= $product['price']*$productsInCart[$product['id']];
  }

return $total;
}

}


public static function clear()
{
    if(isset($_SESSION['products']))
    {
        // очищуємо те що стосується товарів, нам не треба виадаляти сесійну куку і не треба видаляти файлу
        unset($_SESSION['products']); // ми всю сесію не видаляємо а лше те що стосуєься цього ключа
    }
}

public static function deleteProduct($id)
{
$productsInCart = self::getProducts();

unset($productsInCart[$id]);

$_SESSION["products"]=$productsInCart;


}


}