<?php
namespace Model;
class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $primaryKey = 'idvendedores';
    protected static $columnasDB = [ // columnas oficiales de la tabla propiedades
        'idvendedores',
        'nombre',
        'apellido',
        'telefono'
    ];
    public $idvendedores;
    public $nombre;
    public $apellido;
    public $telefono;
    public function __construct($args=[]){
$this->idvendedores = $args['idvendedores'] ?? null;
$this->nombre = $args['nombre'] ?? '';
$this->apellido = $args['apellido'] ?? '';
$this->telefono = $args['telefono'] ?? '';  
    }




    // Obtener lista de vendedores para el select
//$query = "SELECT * FROM vendedores";
//$resultado = mysqli_query($db, $query);
//$vendedores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

public function validar()
{
    if($this->nombre === ''){
        self::$errores[] = "El nombre es obligatorio";
    }
    if($this->apellido === ''){
        self::$errores[] = "El apellido es obligatorio";
    }
    if($this->telefono === ''){
        self::$errores[] = "El teléfono es obligatorio";
    }
    if(!preg_match('/[0-9]{10}/', $this->telefono)){
        self::$errores[] = "Formato de numero no valido";
    }
    return self::$errores;
}


public static function find($id)
{
    $pk = static::$primaryKey ?? 'id';
    $query = "SELECT * FROM " . static::$tabla . " WHERE $pk = $id LIMIT 1";
    $resultado = self::consultarSQL($query);
    return array_shift($resultado);
}


public function eliminar()
{
    $pk = static::$primaryKey ?? 'id';
    $query = "DELETE FROM " . static::$tabla . " WHERE $pk = " . self::$db->escape_string($this->$pk) . " LIMIT 1";
    $resultado = self::$db->query($query);

    if ($resultado) {
        header('Location: /admin?resultado=3');
        exit;
    }
}
public function guardar(){
if(!is_null($this->idvendedores)){
        //actualizar
        $this->actualizar();
    }else{
        //crear un nuevo registro
        $this->crear();
    }
}

    public function actualizar(){
        $atributos= $this->sanitizar();
        $valores= [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
       $query = "UPDATE " . static::$tabla . " SET " . join(',', $valores) . " WHERE idvendedores = " . self::$db->escape_string($this->idvendedores)." LIMIT 1";


       $resultado = self::$db->query($query);

         if ($resultado) {
            header('Location: /admin?resultado=2');
            exit;
        } else {
            echo "Error al actualizar: " . mysqli_error(self::$db);
        }
    }

}