<?php

class Producto {

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;
    private $valoraciones;
    private $media;

    public function __construct() {
        $this->db = Database::connect();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->id = $id;
            $this->valoraciones = $this->setValoraciones();
        }
    }

    public function getMedia() {
        return $this->media;
    }

    public function setMedia($media) {

        $this->media = $media;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCategoria_id() {
        return $this->categoria_id;
    }

    public function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function getOferta() {
        return $this->oferta;
    }

    public function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    /* Devuelve todas las valoraciones */

    public function getValoraciones() {
        return $this->valoraciones;
    }

    // Solo entra a esta funcion cuando se carga el producto
    public function setValoraciones() {
        $sql = "SELECT valoraciones.*, usuarios.nombre as nombre FROM valoraciones, usuarios where usuarios.id=valoraciones.usuario_id and producto_id ={$this->getId()} ORDER BY 1 DESC";
        $valoraciones = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);

        return $valoraciones;
    }

    public function setEstrellas($valoraciones) {
        $this->valoraciones = $valoraciones;
    }

    public function getAll() {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY 1 DESC");

        return $productos;
    }

    public function getAllCategory() {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoria_id()} "
                . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom($limit) {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function getOne() {
        $productos = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");

        return $productos->fetch_object(); //lo devuelvo siendo un objeto usable con fetch
    }

    public function save() { //aquí guardo la información del objeto en la bbdd. De momento no pongo la fecha de usuario registrado
        $sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}' )";
        $save = $this->db->query($sql);

        //Mostrar error en la consulta
        //echo $sql;
        //echo "<br/>";
        //echo $this->db->error;
        //die();

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()} ";

        if ($this->getImagen() != null) {
            $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= " WHERE id={$this->id};";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        $delete = $this->db->query($sql); //ejecuto la consulta y guardo

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function getMediaValoraciones() {
        $sql = "SELECT round(avg(estrellas),2) as media FROM valoraciones where producto_id={$this->id} and aprobada='1'";
        
        $media = $this->db->query($sql)->fetch_object()->media;
        return $media;
    }

    public function getEstrellasEspecificas($numEstrella) {
        $sql = "select count(estrellas) as estrellas from valoraciones where round(estrellas) = {$numEstrella} and producto_id = {$this->id}";
        
        $estrellas = $this->db->query($sql)->fetch_object()->estrellas;
        
         return $estrellas;
    }
    
    public function getNumValoracionesProducto(){
        $sql = "select count(*) as num from valoraciones where producto_id = {$this->id}";
        
        $num = $this->db->query($sql)->fetch_object()->num;
        
        return $num;
    }

}
