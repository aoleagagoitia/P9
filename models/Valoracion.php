<?php

class Valoracion
{
    private $id;
    private $producto_id;
    private $usuario_id;
    private $estrellas;
    private $comentario;
    private $fecha;
    private $aprobada;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->aprobada = "0";
        $this->fecha = date("Y-m-d");
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $this->id = $id;
        }
    }
    
    function getId() {
        return $this->id;
    }

    function getProducto_id() {
        return $this->producto_id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getEstrellas() {
        return $this->estrellas;
    }

    function getComentario() {
        return $this->comentario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getAprobada() {
        return $this->aprobada;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProducto_id($producto_id) {
        $this->producto_id = $producto_id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setEstrellas($estrellas) {
        $this->estrellas = $estrellas;
    }

    function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setAprobada($aprobada) {
        $this->aprobada = $aprobada;
    }
    
    public function crear($comment, $userId, $productId, $rating){
        
        $sql = "INSERT INTO valoraciones (producto_id, usuario_id, estrellas, comentario, fecha, aprobada) VALUES ({$productId}, {$userId}, {$rating},'{$comment}','{$this->fecha}','{$this->aprobada}')";
        
        $save = $this->db->query($sql);
        echo $save;
        
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    
    public function aprobar(){
        $sql = 'update valoraciones set aprobada = "1" where id = '.$this->id;
        $update = $this->db->query($sql);
        
        $result = false;
        if ($update) {
            $result = true;
        }
        return $result;
        
    }

    public function rechazar(){
        $sql = 'DELETE FROM valoraciones WHERE id = '.$this->id;
        $delete = $this->db->query($sql);
        
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
        
    }
}