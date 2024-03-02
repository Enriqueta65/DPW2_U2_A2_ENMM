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
        <title>DPW2_U2_A2_ENMM_Registrarsephp</title>
        <link rel="stylesheet" href="Estilos.css " href="Registrarse.html"> 
    </head> 
    <body> 
    <?php
    include("Conexion.php");
    $IdUsuario = $_POST['IdUsuario'];
    $Nombre = $_POST['Nombre'];
    $ApellidoPaterno = $_POST['ApellidoPaterno'];
    $ApellidoMaterno = $_POST['ApellidoMaterno'];
    $Edad = $_POST['Edad'];
    $Sexo = $_POST['Sexo'];
    $Telefono = $_POST['Telefono'];
    $Email = $_POST['Email'];
    $TipoUsuario = $_POST['TipoUsuario'];
    $Contrasena = $_POST['Contrasena'];
    $Confirmar= $_POST['Confirmar'];
    $Registrar = $_POST['Registrar'];

    try{
        if(isset($Registrar)){
//Función que valida longitud, en contraseña
          
           if($dbh!=null) {//Se logró la conexión con la BD
                $stmt = $dbh->prepare("SELECT IdUsuario FROM
                Usuarios WHERE IdUsuario=:IdUsuario");
                 $stmt->bindParam(':IdUsuario', $IdUsuario); 
                 // Ejemplo de FetchMode por asociación (Podemos dejar el ya especificado)
                 $stmt->setFetchMode(PDO::FETCH_ASSOC);
                 // Ejecutar la consulta
                 $stmt->execute();
                 $datos = $stmt->fetch();
                 
            if($_SESSION["IdUsuario"]=$IdUsuario){
                
                // Si el usuario es diferente al usuario ingresado
                /*if($Nombre == NULL || $ApellidoPaterno == NULL || $ApellidoMaterno == NULL 
                || $Edad == NULL || $Sexo ==NULL || $Telefono == NULL || $Email == NULL 
                || $TipoUsuario == NULL || $Contrasena == NULL){*/
                    if($IdUsuario == NULL || $Nombre == NULL || $ApellidoPaterno == NULL || 
                    $ApellidoMaterno == NULL || $Edad == NULL || 
                    $Sexo == NULL || $Telefono == NULL || $Email == NULL || 
                    $TipoUsuario == NULL || $Contrasena == NULL)
                {
                    echo "<br>Atención debe ingresar todos los datos para su registro<br>";
                    echo "<br><br><a href='Registrarse.html'><img src='Imagenes/atras.jpg'></a>";
                    exit();
                    }
                    else if($TipoUsuario == "PDC"){
                            //Mensaje de error
                            echo "Error en Tipo de Usuario, solo se pueden registrar Padres de Familia"; 
                            echo "<br><br><a href='Index.html'><img src='Imagenes/atras.jpg'></a>";
                            exit();
                            }
                            else if((strlen($Contrasena))==7){
                            //Mensaje de error
                            echo "<br>La Contraseña debe contener 8 caracteres<br>";
                            echo "<br><br><a href='Registrarse.html'><img src='Imagenes/atras.jpg'></a>";
                            exit();
                            } 
                            else if (preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[#,$,-,_,&,%])$/", $Contrasena)){
                            echo "<br>La Contraseña debe contener al menos un caracter especial<br>";
                            echo "<br><br><a href='Registrarse.html'><img src='Imagenes/atras.jpg'></a>";
                            exit();
                            }
                            //Condicional que valida que las contraseñas coíncidan
                            else if($Contrasena != $Confirmar){
                           //Mensaje de error
                           echo "<br>Las Contraseñas No coínciden, favor de verificarlo <br>";
                           echo "<br><br><a href='Registrarse.html'><img src='Imagenes/atras.jpg'></a>";
                           exit();
                        }
                        else {

                            $stmt = $dbh-> prepare("INSERT INTO Usuarios (IdUsuario, Nombre, ApellidoPaterno, ApellidoMaterno,
                            Edad, Sexo, Telefono, Email, TipoUsuario, Contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bindParam(1, $IdUsuario); $stmt->bindParam(2, $Nombre); $stmt->bindParam(3, $ApellidoPaterno); 
                            $stmt->bindParam(4, $ApellidoMaterno); $stmt->bindParam(5, $Edad); 
                            $stmt->bindParam(6, $Sexo); $stmt->bindParam(7, $Telefono); $stmt->bindParam(8, $Email);
                            $stmt->bindParam(9, $TipoUsuario); $stmt->bindParam(10, $Contrasena); 
                            // Ejecutar la consulta preparada
                            $stmt->execute();
                            echo "Su Registro  $Nombre $ApellidoPaterno $ApellidoMaterno $TipoUsuario fue Realizado con Éxito.";
                            echo "<br><br><a href='Index.html'><img src='Imagenes/atras.jpg'></a>";
                            exit(); //Cierra conexión
                            $dbh=null;
                }
                } else {
                        echo "Usuario $IdUsuario ya Registrado, Favor de Verificarlo";
                        echo "<br><br><a href='Registrarse.html'><img src='Imagenes/atras.jpg'></a>";
                        exit();
                        //Cierra conexión
                        $dbh=null;
                        }
                    }
                    }
                else {
                 echo "Error: No hay Conexión con la Base de Datos"; 
                 echo "<br><br><a href='Index.html'><img src='Imagenes/atras.jpg'></a>";
                 exit();  
                }
            }
            catch(PDOException $e){
            echo("Error: " .$e->getLine());
                }
                
    ?>  
    </body>
</html>