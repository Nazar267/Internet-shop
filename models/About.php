<?php

class About{

public static function getAboutInfo(){

 
$db = Db::getConnection();

$query="SELECT * FROM contacts";

$result = $db->query($query);

return $result->fetch(PDO::FETCH_ASSOC);

   
}

}
