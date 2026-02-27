 <?php
$conexion = mysqli_connect("192.168.14.187","cyberbuild","Admin1234","faltas");
//Inicia conexion con la base de datos


if($conexion->connect_errno)
    {
        echo "No hay conexión : (".$conexion->connect_error.")".$conexion->connect_error;
    }
    $dni = $_POST["dni"];
    $contrasena = $_POST["contrasena"]; 
    $rol = $_POST["rol"];
    $nombre = $_POST["nombre"];
    $ape = $_POST["apellido"];
    $gmail = $_POST["gmail"];
    $familia = $_POST["familia"];

    
        if ($_SERVER["REQUEST_METHOD"] === "POST") { 
            $queryusuario   = mysqli_query($conexion,"SELECT * FROM usuario WHERE dni = '$dni'");
            $nr             = mysqli_num_rows($queryusuario);
            $buscarpass     = mysqli_fetch_array($queryusuario);
            
            //Algoritmo: bcrypt
            //Identificador en el hash: $2y$
            //Coste: 10 por defecto
            //ejemplo: $2y$10$e0NR2bQp3Z6pQWJ4Z5lH8uJ8QKf6jF5Oa8uE6O9uF5O9uF5O9uF5O
            //registar
        
            
                $pass_fuerte = password_hash($contrasena, PASSWORD_DEFAULT);
                $queryregistrar = "INSERT INTO usuario(dni,contrasena,nombre,apellido,gmail,familia,rol) values ('$dni','$pass_fuerte','$nombre','$ape','$gmail','$familia','$rol')";

                if(mysqli_query($conexion,$queryregistrar))
                    {
                        echo "<script>alert('Usuario registrado: $nombre $ape');window.location='main.php'</script>";
                    }
                    else 
                    {
                        echo "Error: ".$queryregistrar."<br>".mysqli_error($conexion);
                }
            }
?>