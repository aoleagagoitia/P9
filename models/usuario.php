<?php

class Usuario {

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;
    private $numValoracionesTotales;

    public function __construct() {

        $this->db = Database::connect();

        if(isset($_POST['user_id'])){
            $id = $_POST['user_id'];
            $this->id = $id;
        }
    }

    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getNumValoracionesTotales() {
        return $this->numValoracionesTotales;
    }

    function setNumValoracionesTotales($numValoracionesTotales) {
        $this->numValoracionesTotales = $numValoracionesTotales;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    public function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function save() { //aquí guardo la información del objeto en la bbdd. De momento no pongo la fecha de usuario registrado
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'novato', null)";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function login() {
        $result = false;
        $email = $this->email;
        $password = $this->password;

        //Comprobar si el usuario existe
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);
        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            //Verificar la contraseña
            $verify = password_verify($password, $usuario->password);
            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
    }

    public function getNumeroValoracionPorUser($id, $productId) {
        $sql = "select count(*) as numero from valoraciones, usuarios where valoraciones.usuario_id=usuarios.id and usuarios.id={$id} and valoraciones.producto_id={$productId}";

        $numeroValoraciones = $this->db->query($sql)->fetch_object()->numero;

        return $numeroValoraciones;
    }

    public function getNumeroValoracionesTotales() {
        $sql = "select count(*) as numero from valoraciones, usuarios where valoraciones.usuario_id=usuarios.id and aprobada='1' and usuarios.id={$this->id}";
        
        $numeroValoraciones = $this->db->query($sql)->fetch_object()->numero;



        return $numeroValoraciones;
    }

    public function updateRolUser($level) {
        $sql = "update usuarios set rol = '{$level}' where id ={$this->id}";
        
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function obtenerRol() {
        $sql = "select rol from usuarios where id={$this->id}";
        
        $result = $this->db->query($sql)->fetch_object()->rol;
        
        return $result;
    }

}
