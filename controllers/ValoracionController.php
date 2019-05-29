<?php

require_once 'models/Valoracion.php';

class ValoracionController {

    public function index() {
        echo "Controlador Valoracion, Acción index";
    }

    public static function crear($rol) {

        $comment = $_POST['comment'];
        $userId = $_POST['user_id'];
        
        $productId = $_POST['product_id'];
        $rating = $_POST['rating'];

        if ($rol === "novato") {
            $rating *= 0.3;
        } else if ($rol === "intermedio") {
            $rating *= 0.5;
        }

        $valoracion = new Valoracion();
        $result = $valoracion->crear($comment, $userId, $productId, $rating);
        
        return $result;
    }

    public function aprobar() {
        $valoracion = new Valoracion();
        $result = $valoracion->aprobar();
        $result = usuarioController::actualizarRol();
             
        return $result;
    }
    
    public function rechazar() {
        $valoracion = new Valoracion();
        $result = $valoracion->rechazar();
        return $result;
    }

}
