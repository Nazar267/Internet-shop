<?php

class Order
{

public static function save($userName, $userPhone,$userComment, $userId, $products)
{
   $db =  Db::getConnection();

    $query = "INSERT INTO product_order (user_name, user_phone, user_comment, 
    user_id, products) VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)";

$result = $db->prepare($query);
   
    $products = json_encode($products); // ми не можемо масив зберігати в БД тут краще зберегти як стрічку то ми перетворимо в стрічку

    $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
    $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
    $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
    $result->bindParam(':user_id', $userId, PDO::PARAM_INT);   
    $result->bindParam(':products', $products, PDO::PARAM_STR);

    return $result->execute();

}

public static function getOrdersList()
{

$db = Db::getConnection();
$query = "SELECT * FROM product_order ORDER BY id DESC";
$result = $db->query($query);
return $result->fetchAll(PDO::FETCH_ASSOC);

}

public static function getStatusText($status){

switch ($status) {
    case 1:
        return "Нове замовлення";
        case 2:
            return "В обробці";
            case 3:
                return "В доставці";
                case 4:
                    return "Закрите";
   
}
}


public static function getOrderById($id)
{
$db = Db::getConnection();
$query = "SELECT * from product_order WHERE id = :id";
$result = $db->prepare($query);
$result->bindParam(":id",$id,PDO::PARAM_INT);

$result->execute();

return $result->fetch(PDO::FETCH_ASSOC);



}

public static function deleteOrder($id)
{

$db = Db::getConnection();
$query = "DELETE FROM product_order WHERE id = :id";
$result = $db->prepare($query);
$result->bindParam(":id",$id,PDO::PARAM_INT);
return $result->execute();
}


public static function updateOrder($id,$option)
{

    $db = Db::getConnection();
    $query = "UPDATE product_order SET user_name=:user_name, user_phone=:user_phone, user_comment=:user_comment, date=:date, status=:status 
    WHERE id=:id";
    $result = $db->prepare($query);
    $result->bindParam(":id",$id,PDO::PARAM_INT);
    $result->bindParam(":user_name",$option['userName'],PDO::PARAM_STR);
    $result->bindParam(":user_phone",$option['userPhone'],PDO::PARAM_STR);
    $result->bindParam(":user_comment",$option['userComment'],PDO::PARAM_STR);
    $result->bindParam(":date",$option['date'],PDO::PARAM_STR);
    $result->bindParam(":status",$option['status'],PDO::PARAM_INT);
  
    return $result->execute();

}

public static function getOrderByUserId($userId)
{
$db = Db::getConnection();
$query = "SELECT * from product_order WHERE user_id=:id";
$result = $db->prepare($query);
$result->bindParam(":id",$userId,PDO::PARAM_INT);
$result->execute();
return $result->fetchAll(PDO::FETCH_ASSOC);
}



}

