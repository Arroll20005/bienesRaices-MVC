<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;
 class VendedoresController {




public static function crear(Router $router) {
    $vendedores = new Vendedor;
    $errores = Vendedor::getErrores();
   
   

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1) Sincronizar / crear el modelo con los datos del formulario
        $vendedores = new Vendedor($_POST['vendedores']);
        $vendedores->sincronizar($_POST['vendedores']);

        $errores = $vendedores->validar();

       
        if(empty($errores)){
            $resultado = $vendedores->guardar();
            if ($resultado) {
                    header('Location: /admin?resultado=1');
                    exit;
                }
        }
            

                
            }
        

    // 7) Render (si GET o si hubo errores en POST)
    $router->render('vendedores/crear', [
        'vendedores' => $vendedores,
        'errores'    => $errores
    ]);
}



  public static function actualizar(Router $router) {
    $id = ValidarORedireccionar('/admin');
    $vendedores = Vendedor::find($id);
    $errores = Vendedor::getErrores();

    // METODO POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $args = $_POST['vendedores'];
        $vendedores->sincronizar($args);

        $errores = $vendedores->validar();

       

        // Si no hay errores, actualizar en base de datos
        if (empty($errores)) {
           $resultado = $vendedores->guardar();
        }if ($resultado) {
                header('Location: /admin?resultado=2'); // 2 = actualizado
                exit;
    }

    // El render SIEMPRE debe ejecutarse, haya o no POST
    $router->render('vendedores/actualizar', [
        'vendedores'  => $vendedores,
        'errores'     => $errores
    ]);
}

} 
public static function eliminar(Router $router) {
    
    $id= ValidarORedireccionar('/admin');

    $vendedores = Vendedor::find($id);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tipo= $_POST['tipo'];
    if($tipo === 'vendedor'){
        $resultado= $vendedores->eliminar();
        if($resultado){
            header('Location: /admin?resultado=3');
            exit;
        }
    }}
}
 }


