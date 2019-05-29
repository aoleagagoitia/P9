<?php
require_once 'models/producto.php'; //Cargo el modelo para luego poder crear objetos con esta clase
class ProductoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        
        // Renderizar vista
        require_once 'views/producto/destacados.php';
    }

    public function ver()
    {

        if (isset($_GET['id'])) {
            

            $producto = new Producto(); //invoco al modelo
           
            $valoraciones = $producto->getValoraciones();
           
            $media = $producto->getMediaValoraciones();
            $primera = 0;
            $segunda = 0;
            $tercera = 0;
            $cuarta = 0;
            $quinta = 0;
            if($media){
                $producto->setMedia($media);
                $primera = $producto->getEstrellasEspecificas(1);
                $primera = ($primera/$producto->getNumValoracionesProducto()*100);
                $segunda = $producto->getEstrellasEspecificas(2);
                $segunda = ($segunda/$producto->getNumValoracionesProducto()*100);
                $tercera = $producto->getEstrellasEspecificas(3);
                $tercera = ($tercera/$producto->getNumValoracionesProducto()*100);
                $cuarta = $producto->getEstrellasEspecificas(4);
                $cuarta = ($cuarta/$producto->getNumValoracionesProducto()*100);
                $quinta = $producto->getEstrellasEspecificas(5);
                $quinta = ($quinta/$producto->getNumValoracionesProducto()*100);
            }

            
            $product = $producto->getOne(); //saco el producto que me interesa
           
        }
        require_once 'views/producto/ver.php';
    }
    
    public function aprobarValoracion() {
        
        $result = ValoracionController::aprobar();
        
        return $result;
    }

    public function rechazarValoracion(){
        $result = ValoracionController::rechazar();
        
        return $result;
    }
    public function gestion()
    {
        Utils::isAdmin();

        $producto = new Producto(); //creo variable $producto q es una instancia de la clase Producto
        $productos = $producto->getAll(); //creo el objeto para acceder al método getAll y hacer el select

        require_once 'views/producto/gestion.php';
    }

    public function crear()
    {
        Utils::isAdmin(); // Uso esto para permitir el acceso a crear solo a administradores
        require_once 'views/producto/crear.php';
    }

    public function save()
    { //método para guardar la información de productos en la BBDD
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            //$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            //compruebo que todos los datos han llegado correctamente
            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                //Guardar la imagen
                if (isset($_FILES['imagen'])) {

                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    //comprobando errores
                    //var_dump($file);
                    //die();

                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

                        //comprobando errores
                        //var_dump($file); die();

                        if (!is_dir('uploads/images')) { //Compruebo si no existe la carpeta
                            mkdir('uploads/images', 0777, true); //si no existe la creo con permisos 0777
                        }// con mkdir para crear directorios recursivos hay que poner true

                        $producto->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }

                if ($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        //header('Location:' . base_url . 'producto/gestion');
        echo "Operación realizada";
    }

    public function editar()
    {
        //Compruebo si me llega el valor, el id del producto
        //var_dump($_GET);

        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto(); //invoco al modelo
            $producto->setId($id);
            $pro = $producto->getOne(); //saco el producto que me interesa


            //Utilizo la vista de la creación
            require_once 'views/producto/crear.php';

        } else {
            header('Location:' . base_url . 'producto/gestion');
        }
    }

    public function eliminar()
    {
        //Compruebo si me llega el valor, el id del producto //var_dump($_GET);
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        //header('Location:' . base_url . 'producto/gestion');
        echo "Operación realizada";
    }

    

}