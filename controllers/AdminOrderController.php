<?php

class AdminOrderController extends AdminBase {

public function actionIndex() {
self::checkAdmin();

   $ordersList = Order::getOrdersList();
   
    require_once(ROOT.'/views/admin_order/index.php');
    return true;
}

public function actionView($id)
{
self::checkAdmin();

$order = Order::getOrderById($id);

$productsQuantity = json_decode($order['products'],true) ;  // true - асоціативний масив
$productIds = array_keys($productsQuantity);

$products = Cart::getProductsByIds($productIds);


    require_once(ROOT.'/views/admin_order/view.php');
    return true;
}

public function actionDelete($id)
{
    self::checkAdmin();

if(isset($_POST['submit']))
{

    Order::deleteOrder($id);

    header('location: /admin/order');
}

 
require_once(ROOT.'/views/admin_order/delete.php');
return true;


}

public function actionUpdate($id)
{
    self::checkAdmin();

    $order = Order::getOrderById($id);

if(isset($_POST['submit']))
{
  $option['userName'] = $_POST["userName"];
  $option['userPhone'] = $_POST['userPhone'];
  $option['userComment'] = $_POST['userComment'];
  $option['date'] = $_POST['date'];
  $option['status'] = $_POST['status'];

       Order::updateOrder($id,$option);  
      header("location: /admin/order/update/$id");
}

 
require_once(ROOT.'/views/admin_order/update.php');
return true;


}


}