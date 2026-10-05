<?php
require_once __DIR__ . '/DatosObject.php';

class Pais extends DatosObject {

    // Todos los paises, ordenados por continente y luego por nombre (para el menu)
    public static function obtenerPaises() {
        $conexion = self::conectar();
        $sql = 'SELECT * FROM ' . TABLA_PAISES . ' ORDER BY continente, nombre';
        $sentencia = $conexion->query($sql);

        $paises = array();
        while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $paises[] = new Pais($fila);
        }

        self::desconectar($conexion);
        return $paises;
    }
}