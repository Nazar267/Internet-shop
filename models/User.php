<?php
// валадаціїї даних проводять в МОДЕЛЯХ
class User{

public static function register($name,$email,$password)
{

    $role = 'user';

    $db = Db::getConnection();

    $query = "INSERT INTO user (name, email, password, role)
     VALUES (:name, :email, :password, :role)";

    $result = $db->prepare($query);

    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':password', $password, PDO::PARAM_STR);
    $result->bindParam(':role', $role, PDO::PARAM_STR);
    
    return $result->execute();


//    

}

public static function checkName($name)  
{
    if(strlen($name)>2)
       return true;
    return false;
}


public static function checkPhone($phone)  
{
    if(strlen($phone) > 10)
       return true;
    return false;
}



public static function checkPassword($password)  
{
    if(strlen($password)>5)
       return true;
    return false;
}

public static function checkEmail($email)  
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
   
}

public static function checkEmailExists($email)
{
    $db = Db::getConnection();
    $query = "SELECT COUNT(id) from user WHERE email=:email";
    $result = $db->prepare($query);
    $result->bindParam(':email',$email, PDO::PARAM_STR);

    $result->execute(); // тут пішов запит 
   
    if($result->fetchColumn())  // fetchColumn() повертає нам масив якщо будуть там дані якщо не буде то поверне false
    return true;
    else false;  

}


public static function checkUserData($email, $password)
{

$db = Db::getConnection();

$query = "SELECT * FROM user WHERE email = :email AND password = :password";

 $result = $db->prepare($query);

 $result->bindParam(':email',$email,PDO::PARAM_STR);
 $result->bindParam(':password',$password,PDO::PARAM_STR);

   $result->execute();

   $user = $result->fetch();

   if($user)
   return $user["id"];

   return false;


}

   public static function auth($userId){
    

     $_SESSION['user']=$userId;

   }

   public static function checkLogged(){
   
     
     if(isset($_SESSION['user']))
     return $_SESSION['user'];

     header('location: /user/login');


   }

   public static function isGuest() {
    
  
    if(isset($_SESSION['user']))
    return false;

    return true;     
   }


   public static function getUserById($id)
   {
    $db = Db::getConnection();
    $query = "SELECT * from user WHERE id=:id";
   $result =  $db->prepare($query);

     $result->bindParam(':id',$id,PDO::PARAM_INT);
     $result->execute();

     $user = $result->fetch();

     return $user;

   }

  public static function edit($id,$name,$password) {
 $db = Db::getConnection();

 $query = "UPDATE user SET name = :name, password = :password WHERE id= :id";
   $result = $db->prepare($query);
   $result->bindParam(':id',$id,PDO::PARAM_INT);
   $result->bindParam(':name',$name,PDO::PARAM_STR);
   $result->bindParam(':password',$password,PDO::PARAM_STR);
  
   return $result->execute();

}

public static function getUserIdFromSession()
{
  return $_SESSION['user'];
}

}
