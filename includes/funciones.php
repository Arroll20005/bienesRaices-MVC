<?php 

function incluirTemplate($nombre, $inicio=false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}
define("TEMPLATES_URL", __DIR__."/templates");
define("FUNCIONES_URL", __DIR__."funciones.php");
define("CARPETA_IMAGENES", $_SERVER['DOCUMENT_ROOT'] . "/imagenes/");

function Autenticado() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start(); // Esto es crucial
    }

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        return false;
    }

    return true;
}
function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
//escapar HTML
function s($html) {
    return htmlspecialchars($html ?? '', ENT_QUOTES, 'UTF-8');
}
function validarTipoContenido($tipo){
    $tipos= ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);//busca en el array el valor a buscar
}
function mostrarNotificacion($codigo){
    $mensaje= '';
    switch($codigo){
        case 1: 
            $mensaje= 'Creado correctamente';
            break;
            case 2:
            $mensaje= 'Actualizado correctamente';
            break;
            case 3:
            $mensaje= 'Eliminado correctamente';
            break;
            default:
            $mensaje= false;
            break;
    }
    return $mensaje;
}
function ValidarORedireccionar(string $url){
    

    $id = $_GET['id'] ?? $_POST['id'] ?? null;

    
    
    
$id = filter_var($id, FILTER_VALIDATE_INT);


 if ($id === false || $id === null) {
    
    header("Location: /admin");
    
    exit;
}
return $id;
}