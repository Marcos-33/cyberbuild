<?php
$conexion = mysqli_connect("192.168.14.187","cyberbuild","Admin1234","faltas");
//Inicia conexion con la base de datos
//"Nombre del servidor" , "Nombre del usuario, "Contrasena", "Nombre BD"

if($conexion->connect_errno)
    {
        echo "No hay conexión : (".$conexion->connect_error.")".$conexion->connect_error;
    }
    $dni = $_POST["dni"];
    $contrasena = $_POST["contrasena"]; 
    $rol = $_POST["rol"];
//login

    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $queryusuario   = mysqli_query($conexion,"SELECT * FROM usuario WHERE dni = '$dni'");
        $nr             = mysqli_num_rows($queryusuario);
        $buscarpass     = mysqli_fetch_array($queryusuario);
        //Algoritmo: bcrypt
        //Identificador en el hash: $2y$
        //Coste: 10 por defecto
        //ejemplo: $2y$10$e0NR2bQp3Z6pQWJ4Z5lH8uJ8QKf6jF5Oa8uE6O9uF5O9uF5O9uF5O

        if(($nr == 1)&&(password_verify($contrasena,$buscarpass['contrasena'])))
            {
                session_start();
                $_SESSION["user"] = [
                "dni" => $buscarpass["dni"],
                "rol" => $buscarpass["rol"] 
                ];
                header('Location: main.php');
            }
            else 
            {
                echo  "<script>alert('Usuario o contraseña incorrecto');window.location='index.html'</script>";
            }
    }
?>