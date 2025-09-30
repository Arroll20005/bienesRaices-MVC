<?php 
namespace Controllers;

use MVC\Router;
use Model\Propiedades;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propiedades = Propiedades::get(3);
        $inicio = true;
        $router->render('paginas/index', ['propiedades' => $propiedades, 'inicio' => $inicio    ]);
    }
    public static function nosotros(Router $router){
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedades::all();
        $router->render('paginas/propiedades', ['propiedades' => $propiedades]);
    }
    public static function propiedad(Router $router){
        $id= ValidarORedireccionar('/propiedades');
        $propiedad= Propiedades::find($id);
        $router->render('paginas/propiedad', ['propiedad' => $propiedad]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog', []);
    }
    public static function entrada(Router $router){
        
        $router->render('paginas/entrada', []);
    }
    public static function contacto(Router $router){
            $mensaje= null;
     
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
               $respuesta= $_POST['contacto'];
                $mail= new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8f2ff7ecd0850c';
        $mail->Password = 'f1b09fe20272ac';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 

            //configurar contenido del mail
            $mail->setFrom('info@bienesraices.com');
            $mail->addAddress('info@bienesraices.com', 'Bienes Raices');
            $mail->Subject = 'tienes un new mensaje';

            //habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //definir el contenido
            $contenido = '<html><p>tienes un nuevo mensaje...</p>';
            $contenido .= '<p> nombre: '. $respuesta['nombre']. '.</p>';
 

//ENVIAR DE FORMA CONDICIONAL ALGUNOS CAMPOS DEPENDIENDO SI ES EMAIL O TELEFONO
if($respuesta['contacto']=== 'telefono'){
    $contenido .= '<p> ser contactado por telefono</p>';
     $contenido .= '<p> telefono: '. $respuesta['telefono']. '.</p>';
    $contenido .= '<p> fecha contacto: '. $respuesta['fecha']. '.</p>';
    $contenido .= '<p> hora contacto: '. $respuesta['hora']. '.</p>';
}else{
        $contenido .= '<p> ser contactado por email</p>';
           $contenido .= '<p> email: '. $respuesta['email']. '.</p>';
}

           
            $contenido .= '<p> mensaje: '. $respuesta['mensaje']. '.</p>';
            $contenido .= '<p> vende o compra: '. $respuesta['tipo']. '.</p>';

            $contenido .= '<p> precio o presupuesto: '. $respuesta['precio']. '.</p>';
            
          




            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';
           

           if($mail->send()){
            $mensaje= "Mensaje enviado con exito!!!!";
              } else {
                $mensaje= "El mensaje no se pudo enviar";
                $mensaje= "Error de correo: " . $mail->ErrorInfo;
              }
           }
        
        $router->render('paginas/contacto', ['mensaje'=>$mensaje]);
    }
    

}