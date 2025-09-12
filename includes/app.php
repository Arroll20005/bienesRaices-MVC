<?php



require "funciones.php";
require "conf/database.php";
require_once __DIR__ . '/../Router.php';
require_once __DIR__ . '/../controllers/PropiedadController.php';
require_once __DIR__ . '/../controllers/VendedoresController.php';
require __DIR__ ."/../vendor/autoload.php";
use Model\ActiveRecord;

$db = conectarDB();
ActiveRecord::setDB($db); //se asigna la instancia de la base de datos a la clase ActiveRecord