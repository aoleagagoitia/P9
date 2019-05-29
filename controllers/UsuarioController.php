<?php

require_once 'models/usuario.php';

class usuarioController {

    public function index() {
        echo "Controlador Usuarios, Acción index";
    }

    public function registro() { //Lo que vamos a ver en la URL
        require_once 'views/usuario/registro.php'; //Cargo vista
    }

    public function save() { //Para guardar el usuario
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($nombre && $apellidos && $email && $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();
                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        header("Location:" . base_url . 'usuario/registro');
    }

    public function login() {
        if (isset($_POST)) {
            //Identificación del usuario
            //Consulta a la BBDD para comprobar los datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();

            //Sesión para mantener al usuario identificado
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'Identificación fallida!!';
            }
        }
        header("Location:" . base_url);
    }

    public function logout() {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location:" . base_url);
    }

    public function valorar() {
        if (isset($_SESSION['identity']) && !isset($_SESSION['admin'])) {
            if ($_POST['comment'] != "" && $_POST['user_id'] != "" && $_POST['product_id'] != "" && $_POST['rating'] != "") {
                $id = $_SESSION['identity']->id;
                $usuario = new Usuario();
                
                $rol = $usuario->obtenerRol();
                $product_id = $_POST['product_id'];
                // Comprobar si ha valorado alguna vez este producto
                $numValoraciones = $this->comprobarValoracionesPorUsuario($id, $product_id);
                $result = false;

                if ($numValoraciones === "0") {

                    $result = ValoracionController::crear($rol);
                } else {
                    echo "Ya has valorado este producto.<br/>";
                }

                if ($result) {

                    echo "Valoración creada";
                } else {
                    echo "Error";
                }
            }

            // header("Location:" . base_url."/producto/ver&id=".$_POST['product_id']);
        }
    }

    /**
     * Esta funcion comprueba si ha valorado el producto especificado el usuario conectado
     * @param type $id
     * @param type $productId
     * @return type
     */
    public function comprobarValoracionesPorUsuario($id, $productId) {

        $usuario = new Usuario();

        $numeroValoraciones = $usuario->getNumeroValoracionPorUser($id, $productId);

        return $numeroValoraciones;
    }

    /**
     * Esta funcion devuelve el numero de valoraciones que ha hecho en total
     * @return type
     */
      public function actualizarRol() {
        // Se le envia por POST el id
        $usuario = new Usuario();
    
        $numeroValoraciones = $usuario->getNumeroValoracionesTotales();
        $rol = $usuario->obtenerRol();
        $intermedio = "intermedio";
        $experto = "experto";
        $result = false;
        
        if ($rol === "novato" && $numeroValoraciones === "10") {
            //$_SESSION['identity']->rol = $intermedio;
            $result = $usuario->updateRolUser($intermedio);
        }else if($rol === "intermedio" && $numeroValoraciones === "20"){
            //$_SESSION['identity']->rol = $experto;
            $result = $usuario->updateRolUser($experto);            
        }
        
        return $result;
    }

}
