<?php

class Usuario {
    private $conn;
    private $table = "usuari";  // Asegúrate de que esta tabla exista en tu base de datos

    public function __construct() {
        // Conectar a la base de datos
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Método para comprobar si el usuario existe y es válido
    public function comprobarUsuario($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE nom = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        
        // Vincular los parámetros de entrada
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        
        // Ejecutar la consulta
        $stmt->execute();

        // Comprobar si el usuario existe
        $resultado=false;
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verificar que el usuario sea 'convidat', 'tecnic' o 'administrador'
            if (in_array($row['nom'], ['convidat', 'tecnic', 'administrador'])) {
                $resultado= true;
            }
        }

        return $resultado;
    }
}
?>
