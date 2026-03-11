<?php
$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");
//Inicia conexion con la base de datos
//"Nombre del servidor" , "Nombre del usuario, "Contrasena", "Nombre BD"

if($conexion->connection_error)
    {
        echo "No hay conexión : (".$conexion->connect_error.")".$conexion->connect_error;
    }

    $dni = $_POST["dni"];
    $contrasena = $_POST["contrasena"]; 
    // Login 

    // función para validar el formato de DNI español
    function validarDNI($dni) {
        $dni = strtoupper(trim($dni));
        if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            return false;
        }
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $numero = intval(substr($dni, 0, 8));
        $letra = substr($dni, 8, 1);
        return $letras[$numero % 23] === $letra;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // antes de consultar la base, comprobar formato de DNI
        if (!validarDNI($dni)) {
            echo "<script>alert('DNI inválido');window.location='index.html'</script>";
            exit;
        }
        // Consulta directa con valores interpolados
        $sql = "SELECT nombre, apellido, dni, rol, contrasena FROM usuario WHERE dni = '$dni'";
        $resultado = $conexion->query($sql);
        //Busca en la base de datos y selecciona la fila donde el dni es igual al dni ingresado por el usuario
        $nr = $resultado ? $resultado->num_rows : 0;
        //Cuenta el numero de filas que devuelve la consulta, si es 1, significa que el usuario existe
        
        if($nr == 1) {
            $buscarpass = $resultado->fetch_array(MYSQLI_ASSOC);
            
            //Algoritmo: bcrypt
            //Identificador en el hash: $2y$
            //Coste: 10 por defecto
            //ejemplo: $2y$10$e0NR2bQp3Z6pQWJ4Z5lH8uJ8QKf6jF5Oa8uE6O9uF5O9uF5O9uF5O

            if(password_verify($contrasena, $buscarpass['contrasena']))
                //Si la contraseña ingresada, al ser encriptada, coincide con la contraseña 
                //almacenada en la base de datos, entonces se inicia sesión
                {
                    session_start();
                    $_SESSION["user"] = [
                    "nombre" => $buscarpass["nombre"],
                    "apellido" => $buscarpass["apellido"], 
                    "dni" => $buscarpass["dni"],
                    "rol" => $buscarpass["rol"],
                    "LAST_ACTIVITY" => $buscarpass["LAST_ACTIVITY"]
                    ];
                    //Cuando el usuario inicia sesión, se crea una sesión con su dni y rol 
                    header('Location: main.php');
                    //Te manda al main.php al iniciar sesión
                }
                else 
                {
                    echo  "<script>alert('DNI o contraseña incorrecto');window.location='index.html'</script>";
                }
        }
        else 
        {
            echo  "<script>alert('DNI o contraseña incorrecto');window.location='index.html'</script>";
        }
    }
?>