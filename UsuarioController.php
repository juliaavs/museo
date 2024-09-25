<?php

class UsuarioController {
    public function login() {
        // Mostrar el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Crear una instancia del modelo Usuario
            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->comprobarUsuario($username, $password);

            if ($usuario) {
                echo "Bienvenido, $username!";
            } else {
                echo "Usuario o contraseña incorrectos.";
            }
        }

        // Cargar la vista del formulario
        require_once 'views/formLogin.php';
    }
}
?>
