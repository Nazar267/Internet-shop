<?php

class Product{

const SHOW_BY_DEFAULT=2;

public static function getLatestProducts($count=self::SHOW_BY_DEFAULT ){
    $db = Db::getConnection();

    $query="SELECT id,name,price,image, is_new FROM product WHERE status=1 ORDER BY id DESC LIMIT $count";     // ASC  - ASCENDING
    
    $result = $db->query($query);
    
    return $result->fetchAll(PDO::FETCH_ASSOC);

}


public static function getProductListByCategory($categoryId,$page = 1)
{
// на основі page треба обчислити зміщення

$offset = ($page - 1) * self::SHOW_BY_DEFAULT;


    $db=Db::getConnection();  

   $query="SELECT id,name,price,is_new FROM product WHERE status=1 AND category_id=$categoryId ORDER BY id DESC LIMIT ".self::SHOW_BY_DEFAULT . " OFFSET $offset";
   
   $result= $db->query($query);
   return $result->fetchAll(PDO::FETCH_ASSOC);

 }
   

    public static function getProductById($id)
    {
        $db=Db::getConnection();
        $query="SELECT * FROM product WHERE id=$id";
       $result = $db->query($query);
       return $result->fetch(PDO::FETCH_ASSOC);  // fetch() а не fetchAll() тому що в нас один рядочок повернула query($query)


    }


    public static function getRecommendedProducts(){
    
        $db=Db::getConnection();
        $query="SELECT * FROM product WHERE is_recommended=1";
        $result = $db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);

    }


    // метод який бде витягувати по айді категорії к-сть товарів

    public static function getTotalProductsInCategory($categoryId)
    {
        $db=Db::getConnection();
        $query = "SELECT COUNT(id) AS count FROM product WHERE status = 1 AND category_id = $categoryId";
        $result = $db->query($query);
        $data = $result->fetch();   // 
        return $data["count"];
   
   
    }

       public static function getProductsList()
       {
        $db = Db::getConnection();
        $query = "SELECT id, code, name, price FROM product ORDER BY id ASC";
        $result = $db->query($query);

       return $result-> fetchAll(PDO::FETCH_ASSOC);


       }


public static function deleteProductById($id)
{
    $db = Db::getConnection();
    $query = "DELETE FROM product WHERE id=:id";
   $result = $db->prepare($query);
    $result->bindParam(':id',$id,PDO::PARAM_INT);

    return $result->execute();

}

public static function createProduct($options) {
    $db = Db::getConnection();
    $image = '';

    $query = "INSERT INTO product 
    (name, code, price, category_id, brand, description,
     availability, is_new, is_recommended, status, image) 
     VALUES(:name, :code, :price, :category_id, :brand, :description, 
     :availability, :is_new, :is_recommended, :status, :image)";

     $result = $db->prepare($query);
     
     $result->bindParam(':name', $options["name"], PDO::PARAM_STR);
     $result->bindParam(':code', $options["code"], PDO::PARAM_STR);
     $result->bindParam(':price', $options["price"], PDO::PARAM_STR);
     $result->bindParam(':category_id', $options["category_id"], PDO::PARAM_INT);
     $result->bindParam(':brand', $options["brand"], PDO::PARAM_STR);
     $result->bindParam(':description', $options["description"], PDO::PARAM_STR);
     $result->bindParam(':availability', $options["availability"], PDO::PARAM_INT);
     $result->bindParam(':is_new', $options["is_new"], PDO::PARAM_INT);
     $result->bindParam(':is_recommended', $options["is_recommended"], PDO::PARAM_STR);
     $result->bindParam(':status', $options["status"], PDO::PARAM_INT);
     $result->bindParam(':image', $image, PDO::PARAM_STR);


 if($result->execute())
    {
         return $db->lastInsertId();
    }
    
    return 0;
   
 
}

public static function getImage($id) {

    $noImage = "noimage.jpg";

    $path = '/upload/images/';

    $pathToProductImage = $path . 'product' . $id. '.jpg';

    if(file_exists(ROOT. $pathToProductImage)) {
        return $pathToProductImage;
    }

    return $path . $noImage;

}

public static function updateProduct($id, $options) {
    $db = Db::getConnection();

    $image = '';

    $query = "UPDATE product 
    SET name = :name, code = :code, price = :price, category_id = :category_id, 
    brand = :brand, description = :description, availability = :availability, 
    is_new = :is_new, is_recommended = :is_recommended, status = :status, 
    image = :image 
    WHERE id = :id";
    

    $result=$db->prepare($query);

    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':name', $options["name"], PDO::PARAM_STR);
    $result->bindParam(':code', $options["code"], PDO::PARAM_STR);
    $result->bindParam(':price', $options["price"], PDO::PARAM_STR);
    $result->bindParam(':category_id', $options["category_id"], PDO::PARAM_INT);
    $result->bindParam(':brand', $options["brand"], PDO::PARAM_STR);
    $result->bindParam(':description', $options["description"], PDO::PARAM_STR);
    $result->bindParam(':availability', $options["availability"], PDO::PARAM_INT);
    $result->bindParam(':is_new', $options["is_new"], PDO::PARAM_INT);
    $result->bindParam(':is_recommended', $options["is_recommended"], PDO::PARAM_INT);
    $result->bindParam(':status', $options["status"], PDO::PARAM_INT);
    $result->bindParam(':image', $image, PDO::PARAM_STR);

    return $result->execute();
}

}