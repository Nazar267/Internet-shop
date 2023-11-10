<?php

class UserController{

    public function actionRegister()
    {
         
        $name= "";
        $email="" ;
        $password = "";
        $errors = false;

        $result = false;  // вона ідповідає за те чи виводити форму щераз в разі якщо користвач ввів щось некореткно

      if(isset($_POST["submit"]))
      {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(!User::checkName($name)){
            if(!is_array($errors)) $errors = [];
            $errors[] = "Ім'я має бути більше ніж 2 символа";  // [] це як push в кінець добавляє

        }
        
        if(!User::checkEmail($email)){
            if(!is_array($errors)) $errors = [];
            $errors[] = "Email некоректний";  // [] це як push в кінець добавляє
      
        }
        if(!User::checkPassword($password)){
            if(!is_array($errors)) $errors = [];
            $errors[] = "Пароль не має бути коротшим ніж 5 символів";  // [] це як push в кінець добавляє
     
        }

        if(User::checkEmailExists($email)){
        if(!is_array($errors)) $errors = [];
        $errors[] = "Коритувач з таким email вже існує";  // [] це як push в кінець добавляє

        }


        if($errors == false)
        {
        $result = User::register($name,$email,$password); 
        }



      }


      require_once(ROOT.'/views/user/register.php');

        return true;
    }

    public function actionLogin() {
     $email = '';
     $password = '';
     $errors = false;
     
     if(isset($_POST['submit'])){
          
      $email = $_POST['email'];
      $password = $_POST['password'];

      $userId =  User::checkUserData($email,$password);
  
      if(!$userId){
        $errors[]="Некоректні дані для входу на сайт";
      }
      else{
        // записати в сесію
        User::auth($userId);
        header("location: /cabinet"); // header() приймає стрічку
      }

     }


        require_once(ROOT.'/views/user/login.php');
        return true;
    }

    public static function actionLogout()
    {
      

        // видаляємо з файлу по ключку user
        unset($_SESSION['user']);
        //
        session_destroy();
        setcookie("PHPSESID","",time() - 3600) ;
        header("location: /");
  

    }

}