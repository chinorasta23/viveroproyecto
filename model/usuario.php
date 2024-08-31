<?php
class User {
    private $id;
    private $username;
    private $email;
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $id_rol = $es_admin ? self::ROL_ADMIN : self::ROL_CLIENTE;
        $query = "INSERT INTO usuario (username, nombre, primer_apellido, segundo_apellido, correo, password, id_rol) 
                  VALUES ('$username', '$nombre', '$primer_apellido', '$segundo_apellido', '$correo', '$hashedPassword', $id_rol)";
        return Database::getData($query);
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $this->setId($user['id']);
            $this->setUsername($user['username']);
            $this->setEmail($user['email']);
            return $user;
        }
        return false;
    }
}
?>