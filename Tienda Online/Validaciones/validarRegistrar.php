<?php
class ValidarRegistrarse {
    public static function validarDatos($nombre, $apellido, $nickname, $password, $telefono, $domicilio) {
        $errores = [];

        // Validación de que no estén vacíos
        if (empty($nombre) || empty($apellido) || empty($nickname) || empty($password) || empty($telefono) || empty($domicilio)) {
            $errores[] = "Rellena todos los campos.";
        }

        // Validación de nombre: solo letras
        if (!empty($nombre) && !preg_match('/^[a-zA-Z]+$/', $nombre)) {
            $errores[] = "El nombre solo debe contener letras.";
        }

        // Validación de apellido: solo letras
        if (!empty($apellido) && !preg_match('/^[a-zA-Z]+$/', $apellido)) {
            $errores[] = "El apellido solo debe contener letras.";
        }

        // Validación de nickname: solo caracteres alfanuméricos
        if (!empty($nickname) && !preg_match('/^[a-zA-Z0-9]+$/', $nickname)) {
            $errores[] = "El nickname solo debe contener caracteres alfanuméricos.";
        }

        // Validación de contraseña: al menos 8 caracteres, con mayúsculas, minúsculas y números
        if (!empty($password) && !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $errores[] = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número.";
        }

        // Validación de teléfono: solo números
        if (!empty($telefono) && !ctype_digit($telefono)) {
            $errores[] = "El teléfono debe contener solo números.";
        }

        return $errores;
    }
}
?>