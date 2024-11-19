<?php

require_once '../Controlador/ControladorProducto.php';
require_once '../Modelo/DTOProducto.php';
if(isset($_POST["salir"])){
    header("location: ../Vista/tienda.php");
}else{
    $controlador= new ControladorProducto();
    $producto=new DTOProducto($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen']);
    // Obtén el nombre del archivo desde el formulario
    $archivo = $_POST['imagen'];

    // Define la ruta del archivo en la carpeta donde se encuentra
    $directorio = '../Recursos/Subidas/';  // Asegúrate de que este directorio sea el correcto
    $rutaArchivo = $directorio . basename($archivo);
    unlink($rutaArchivo);
    $controlador->eliminarProducto($producto);
}


?>