<?php
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $password = sha1($_POST['password']);

    include "conexion.php";
    $conexion = conexion();

    /*Validacion de usuarios repetidos no admitidos*/
    $sql = "SELECT usuario FROM t_usuarios WHERE usuario = '$usuario'";
    $respuesta = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($respuesta) > 0) {
        echo "Este usuario ya existe, usa otro por favor!";
        exit;
    } 

    $sql = "INSERT INTO t_usuarios (nombre, 
                                    apellido, 
                                    usuario, 
                                    password) 
            VALUES ('$nombre', 
                    '$apellidos', 
                    '$usuario', 
                    '$password')";
    $respuesta = mysqli_query($conexion, $sql);
    mysqli_close($conexion);

    if ($respuesta) {
        header("location:../index.php");
    } else {
        echo "No se pudo registrar";
    }
?>