<?php 
namespace Model;

 class ActiveRecord{
    // Propiedades estáticas compartidas por todas las instancias
    protected static $tabla= '';

     protected static $db; // conexión a la base de datos
    protected static $errores = []; // array para almacenar errores de validación
    protected static $columnasDB = [ // columnas oficiales de la tabla propiedades
        ''
    ];

  

    // Asignar la conexión a la base de datos (estática)
    public static function setDB($database)
    {
        self::$db = $database;
    }

    // Constructor para inicializar una propiedad, con valores por defecto


    // Guarda la propiedad en la base de datos (insert)

public function guardar(){

    if(!is_null($this->id)){
        //actualizar
        $this->actualizar();
    }else{
        //crear un nuevo registro
        $this->crear();
    }

  
}
//__________-----_____

    public function crear()
    {
        $atributos = $this->sanitizar();

        $query = "INSERT INTO " . static::$tabla . " (
            " . join(", ", array_keys($atributos)) . "
        ) VALUES (
            '" . join("', '", array_values($atributos)) . "'
        );";

        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /admin?resultado=1');
            exit;
        } else {
            echo "Error al insertar: " . mysqli_error(self::$db);
        }

        //return $resultado; // true si éxito, false si error
    }

    public function actualizar(){
        $atributos= $this->sanitizar();
        $valores= [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
       $query = "UPDATE " . static::$tabla . " SET " . join(',', $valores) . " WHERE id = " . self::$db->escape_string($this->id)." LIMIT 1";


       $resultado = self::$db->query($query);

         if ($resultado) {
            header('Location: /admin?resultado=2');
            exit;
        } else {
            echo "Error al actualizar: " . mysqli_error(self::$db);
        }
    }

    // Escapa caracteres especiales para evitar inyección SQL
    public function sanitizar()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Devuelve un array con los atributos que mapean columnas de la tabla
public function atributos()
{
    $atributos = [];

    foreach (static::$columnasDB as $columna) {
        // Excluir ids autoincrement
        if (str_starts_with($columna, 'id')) continue;

        $atributos[$columna] = $this->$columna ?? null;
    }

    return $atributos;
}

    // Devuelve los errores de validación actuales
    public static function getErrores()
    {
        return static::$errores;
    }

    // Setter para la imagen, solo si se recibe un valor válido
    public function setImagen($imagen)
    {
        if(isset($this->id)){
             $this->borrarImagen();
        }

        if ($imagen) {
           $this->imagen = $imagen;
          


        }
    }

    // Validación de los datos de la propiedad
    public function validar()
    {
     static::$errores = [];

        
        return static::$errores;
    }

    // Obtiene todas las propiedades (array de objetos)
    public static function all()
    {
        $query = "SELECT * FROM ". static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // obtener numero determinado de registros------------------------------------------------------

        public static function get($cantidad)
    {
        $query = "SELECT * FROM ". static::$tabla . " LIMIT " . (int)$cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca una propiedad por su ID y devuelve el objeto (o null)
    public static function find($id)
    {
        $query = "SELECT * FROM ". static::$tabla ." WHERE id = $id LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Ejecuta una consulta SQL y devuelve un array de objetos Propiedades
    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);

        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjetos($registro);
        }

        $resultado->free();

        return $array;
    }

    // Crea un objeto Propiedades a partir de un registro (array asociativo)
    protected static function crearObjetos($registros)
    {
        $objeto = new static;
        foreach ($registros as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    public function eliminar(){

        $query= "DELETE FROM " . static::$tabla . " WHERE id = ". self::$db->escape_string($this->id)." LIMIT 1";
        $resultado= self::$db->query($query);
        if($resultado){
          
             header('Location: /admin?resultado=3');
             exit;
        }
      
        
       
      
    }


    // Sincroniza los atributos del objeto con un array de datos (usualmente del formulario)
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function borrarImagen(){
        if(!is_null($this->id)){
            $existeArchivo= file_exists(__DIR__ . '/../imagenes/' . $this->imagen);
            if($existeArchivo){
                unlink(__DIR__ . '/../imagenes/' . $this->imagen);
            }
        }

    }

}