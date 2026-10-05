<?php
require_once __DIR__ . '/../includes/configuracion.inc.php';

abstract class DatosObject {

    protected $datos;   // array con los campos de una fila de la tabla

    public function __construct($datos) {
        $this->datos = $datos;
    }

    // Devuelve el valor de un campo de la fila
    public function devolverValor($campo) {
        return $this->datos[$campo];
    }

    // Abre la conexion con la base de datos y devuelve el objeto PDO
    protected static function conectar() {
        try {
            $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die('Error al conectar con la base de datos: ' . $e->getMessage());
        }
    }

    // Cierra la conexion
    protected static function desconectar(&$conexion) {
        $conexion = null;
    }
}