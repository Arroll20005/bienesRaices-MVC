<?php
namespace MVC;
class Router {
  

    
   public $rutasGET =[];
   public $rutasPOST =[];
    public function get($ruta, $funcion){
        $this->rutasGET[$ruta]= $funcion;
    }
        public function post($ruta, $funcion){
        $this->rutasPOST[$ruta]= $funcion;
    }

    public function comprobarRutas ()
    {
        $rutaActual= $_SERVER['PATH_INFO'] ?? '/';
       ;
        $metodo= $_SERVER['REQUEST_METHOD'] ;
          if($metodo === 'GET'){
            
            $funcion= $this->rutasGET[$rutaActual] ?? null;
            
            if($funcion){
              
                call_user_func($funcion, $this);
            }else{
              echo "pagina no encontrada!";
            }
          }else if($metodo === 'POST'){
            $funcion= $this->rutasPOST[$rutaActual] ?? null;
            if($funcion){
                call_user_func($funcion, $this);
            }else{
              echo "pagina no encontrada!";
            }
          }
    }
    public function render($view, $datos=[]){
      foreach($datos as $key => $value){
        $$key = $value;
      }

         ob_start();
      include __DIR__ . "/vistas/$view.php";
   
      $contenido= ob_get_clean();
     
      include __DIR__ . "/vistas/propiedades/layout.php";
    }
  
}