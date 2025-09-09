<?php 
namespace Controllers;
use MVC\Router;
use Model\Propiedades;
use Model\Vendedor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class PropiedadController {
    // Aquí van los métodos del controlador
        public static function inicio(Router $router){
            $propiedades = Propiedades::all();
            $resultado= null;

            $router->render('propiedades/admin', [
                'propiedades' => $propiedades
                ,'resultado' => $resultado
            ]);
        }
   
   
   
   
   
   
     public static function index(Router $router) {
        $propiedades = Propiedades::all();

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades
        ]);
    }



public static function crear(Router $router) {
    $vendedores = Vendedor::all();
    $errores = Propiedades::getErrores();
    $propiedades = new Propiedades(); // objeto vacío para GET

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1) Sincronizar / crear el modelo con los datos del formulario
        $propiedades = new Propiedades($_POST['propiedades']);
        $propiedades->sincronizar($_POST['propiedades']);

        // 2) Nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        // 3) Validación tamaño (primera línea de defensa)
        if (isset($_FILES['propiedades']['size']['imagen']) &&
            $_FILES['propiedades']['size']['imagen'] > 1000 * 1000) { // 1MB
            $errores[] = "La imagen es muy pesada";
        }

        // 4) Procesar la imagen si fue subida
        $imagenSubida = isset($_FILES['propiedades']['tmp_name']['imagen']) &&
                        is_uploaded_file($_FILES['propiedades']['tmp_name']['imagen']);

        if ($imagenSubida) {
            // comprobar errores del upload
            if ($_FILES['propiedades']['error']['imagen'] !== 0) {
                $errores[] = "Error al subir la imagen";
            } else {
                // Comprobar tipo MIME (imagen)
                $mime = mime_content_type($_FILES['propiedades']['tmp_name']['imagen']);
                if (!in_array($mime, ['image/jpeg', 'image/png'])) {
                    $errores[] = "Formato de imagen no válido. Sólo JPG o PNG.";
                } else {
                    // Asegurar carpeta de imágenes
                    if (!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES, 0755, true);
                    }

                    // Redimensionar / procesar con Intervention Image
                  try {
    // Inicializa ImageManager con el driver GD
    $imageManager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

    // Leer y redimensionar la imagen
    $image = $imageManager->read($_FILES['propiedades']['tmp_name']['imagen'])
                          ->cover(800, 600); // Recorta/ajusta al tamaño deseado

    // Asignar nombre al modelo (solo si todo OK)
    $propiedades->setImagen($nombreImagen);

} catch (\Exception $e) {
                        $errores[] = "Error procesando la imagen: " . $e->getMessage();
                    }
                }
            }
        }

        // 5) Validaciones del modelo (agregamos sus errores)
        $errores = array_merge($errores, $propiedades->validar());

        // 6) Si no hay errores, guardar imagen (si existe) y guardar registro
        try {
            if (empty($errores)) {
                if (isset($image) && $image instanceof \Intervention\Image\Image) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $resultado = $propiedades->guardar();

                if ($resultado) {
                    header('Location: /admin?resultado=1');
                    exit;
                }
            }
        } catch (\Exception $e) {
            // Captura errores de DB
            $errores[] = "Error de base de datos: " . $e->getMessage();
            if (str_contains($e->getMessage(), 'Out of range value for column')) {
                $errores[] = "El valor ingresado es demasiado grande para el campo correspondiente.";
            }
        }
    }

    // 7) Render (si GET o si hubo errores en POST)
    $router->render('propiedades/crear', [
        'propiedades' => $propiedades,
        'vendedores'  => $vendedores,
        'errores'     => $errores
    ]);
}

    public static function actualizar(Router $router){
        echo "Desde el controlador de actualizar propiedades";
    }


}