<?php

$carpeta = "documentos/";
$archivo = $carpeta . basename($_FILES["archivo"]["name"]);

if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo)) { 
  echo "Archivo subido correctamente";
} else {
    echo "Error al subir el archivo";
}

?> 