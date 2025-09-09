<?php

namespace Model;

class Propiedades extends ActiveRecord
{
    // Propiedades estáticas compartidas por todas las instancias
    protected static $tabla = 'propiedades';

    protected static $columnasDB = [ // columnas oficiales de la tabla propiedades
        'id',
        'titulo',
        'precio',
        'imagen',
        'descripcion',
        'habitaciones',
        'WC',
        'estacionamiento',
        'creado',
        'vendedores_idvendedores'
    ];
      // Propiedades de instancia que representan una propiedad
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $WC;
    public $estacionamiento;
    public $creado;
    public $vendedores_idvendedores;
        public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? 0;
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? 0;
        $this->WC = $args['WC'] ?? 0;
        $this->estacionamiento = $args['estacionamiento'] ?? 0;
        $this->creado = date('Y/m/d'); // fecha actual
        $this->vendedores_idvendedores = $args['vendedores_idvendedores'] ?? '';
    }

     public function validar()
    {
        self::$errores = [];

        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
        if (!$this->precio || !is_numeric($this->precio)) {
            self::$errores[] = "Debes añadir un precio válido";
        }
        if (!$this->descripcion || strlen($this->descripcion) < 10) {
            self::$errores[] = "La descripción debe tener al menos 10 caracteres";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir el número de habitaciones";
        }
        if (!$this->WC) {
            self::$errores[] = "Debes añadir el número de baños";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir el número de estacionamientos";
        }
        if (!$this->vendedores_idvendedores) {
            self::$errores[] = "Debes seleccionar un vendedor";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria!!!!";
        }

        return self::$errores;
    }
       public function eliminar(){

        $query= "DELETE FROM " . static::$tabla . " WHERE id = ". self::$db->escape_string($this->id)." LIMIT 1";
        $resultado= self::$db->query($query);
        if($resultado){
            
            $this->borrarImagen();
        
            header('Location: /admin?resultado=3');
        }
    }
}