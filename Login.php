<? 
session_start(); 

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-compatible" content= "IE-Edge"> 
        <meta name="viewport" content ="width=divice-width, initial-scale=1.0 ">
        <link href="https://fonts.googleapis.com/css?/Family=Tahoma" href="stylesheet">
        <title>DPW2_U2_A2_ENMM_loginphp</title>
        <link rel="stylesheet" href="Estilos.css " href="IniciarSesión.html" href="Conexion.php">
    </head> 
    <body> 
    <?php
    include("Conexion.php");
    $IdUsuario = $_POST['IdUsuario'];
    $Contrasena = $_POST['Contrasena'];
    //$TipoUsuario = $_POST['TipoUsuario'];
    $Ingresar = $_POST['Ingresar'];
    
    try{
        if(isset($_POST['Ingresar'])){
    //Conexión a BD
    if($dbh!=null) //Se logró la conexión con la BD
    { $stmt = $dbh->prepare("SELECT IdUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, TipoUsuario FROM
        Usuarios WHERE IdUsuario=:IdUsuario AND Contrasena=:Contrasena");
         $stmt->bindParam(':IdUsuario', $IdUsuario); $stmt->bindParam(':Contrasena', $Contrasena);
         // Ejemplo de FetchMode por asociación (Podemos dejar el ya especificado)
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         // Ejecutar la consulta
         $stmt->execute();
         $datos = $stmt->fetch();
         
         if($datos['IdUsuario']!=NULL){ //Si obtuvo un registro
            $_SESSION["IdUsuario"]=$datos["IdUsuario"]; $_SESSION["Nombre"]=$datos["Nombre"]; 
            $_SESSION["ApellidoPaterno"]=$datos["ApellidoPaterno"]; $_SESSION["ApellidoMaterno"]=$datos["ApellidoMaterno"]; 
            $_SESSION["TipoUsuario"]=$datos["TipoUsuario"];

            if($_SESSION["TipoUsuario"]=="PDC") 
            {//Extrae la etiqueta de tipo de usuario
            echo "Logueo exitoso. Bienvenido ".$_SESSION["Nombre"] ." ". $_SESSION["ApellidoPaterno"] ." ".
           $_SESSION["ApellidoMaterno"];
            echo "<br> Has iniciado sesión como ". $_SESSION["IdUsuario"];
            echo "<br><br><a href='UsuarioPDC.html'><img src='Imagenes/atras.jpg'></a>";// Indexphp por Indexhtml
            //echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=index.html">';
            }
            else
           { $_SESSION["TipoUsuario"]=="PF";
            echo "Logueo exitoso. Bienvenido ".$_SESSION["Nombre"] ." ". $_SESSION["ApellidoPaterno"] ." ".
           $_SESSION["ApellidoMaterno"];
            echo "<br> Has iniciado sesión como ". $_SESSION["IdUsuario"];
            echo "<br><br><a href='UsuarioPF.html'><img src='Imagenes/atras.jpg'></a>";// Indexphp por Indexhtml
            //echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=index.html">';
        }
    }
    else{
        echo "Logueo erróneo. Identificador de Usuario o Contraseña Incorrecta."; 
        echo "<br><br><a href='Index.html'><img src='Imagenes/atras.jpg'></a>"; 
        exit(); 
    }
       $dbh=null; //Termina conexión
       } 
       else //No se logró conexión
       {
       echo "Error: No hay Conexión con la Base de Datos.";
       }
    }
}
    catch(PDOException $e){
    echo("Error: " .$e->getLine());
    }
?>  
    </body>
</html>