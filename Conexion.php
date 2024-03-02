
<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <meta http-equiv="X-UA-compatible" content= "IE-Edge"> 
    <meta name="viewport" content ="width=divice-width, initial-scale=1.0 ">
    <title>DPW2_U2_A2_ENMM_Conexion</title>

    </head>
    <body>
<?php
$dbname="DPW2_U2_A2_ENMM";
$user="root";
$password="";
$options = array(
 PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);

try {
 $dsn = "mysql:host=localhost;dbname=$dbname";
 $dbh = new PDO($dsn, $user, $password, $options);
} 

catch (PDOException $e){
 echo $e->getMessage();
} 
?>
    </body>
</html> 