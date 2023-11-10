<?php
// Моделі- це окремі класи, які будуть мати методи які будуть працювати з БД(і не тільки з БД)
class Category{

public static function getCategoryList(){

$db = Db::getConnection();

$query="SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC ";     // ASC  - ASCENDING

$result = $db->query($query);

return $result->fetchAll(PDO::FETCH_ASSOC);

}

public static function getStatusText($status)
{
   if($status == 1)
   return "active";
   return 'Not active';
   
}

public static function createCategory($option)
{
$db = Db::getConnection();
$query = "INSERT INTO category (name, sort_order, status) VALUES (:name, :sort_order, :status)";

$result = $db->prepare($query);

$result->bindParam(":name",$option['name'],PDO::PARAM_STR);
$result->bindParam(":sort_order",$option['sort_order'], PDO::PARAM_INT);
$result->bindParam(":status", $option['status'], PDO::PARAM_INT);

if($result->execute()){
  return  $db->lastInsertId();
}

}

public static function getCategoryById($id)
{
    $db = Db::getConnection();
    $query = "SELECT * FROM category WHERE id=$id";
    $result = $db->query($query);

    return $result->fetch();
}

public static function updateCategory($id,$option)
{
$db = Db::getConnection();

$query = "UPDATE category SET name=:name, sort_order=:sort_order, status=:status WHERE id=:id";

$result = $db->prepare($query);
$result->bindParam(":id",$id, PDO::PARAM_INT);
$result->bindParam(":name", $option['name'], PDO::PARAM_INT);
$result->bindParam(":sort_order", $option['sort_order'], PDO::PARAM_INT);
$result->bindParam(":status", $option['status'], PDO::PARAM_INT);

return $result->execute();

}

public static function deleteCategory($id)
{
$db = Db::getConnection();
$query = "DELETE from category WHERE id=:id";
$result = $db->prepare($query);

$result->bindParam(":id",$id, PDO::PARAM_INT);

return $result->execute();

}


}



