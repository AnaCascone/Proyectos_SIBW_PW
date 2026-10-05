<?php
require_once __DIR__ . '/DatosObject.php';

class Viaje extends DatosObject {

    // Listado paginado de viajes. $inicio = desde que fila; $numero = cuantos.
    public static function obtenerViajes($inicio, $numero) {

        // Los pasamos a entero porque van directos dentro del SQL (si son int, nos aseguramos de que no se pueda inyectar código)
        $inicio = (int) $inicio;
        $numero = (int) $numero;

        $conexion = self::conectar();

        $sql = 'SELECT v.*, p.nombre AS pais, p.continente
                FROM ' . TABLA_VIAJES . ' v 
                JOIN ' . TABLA_PAISES . ' p ON v.pais_id = p.id
                ORDER BY v.id
                LIMIT ' . $inicio . ', ' . $numero;

        $sentencia = $conexion->query($sql);

        $viajes = array();
        while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $viajes[] = new Viaje($fila);
        }

        self::desconectar($conexion);
        return $viajes;
    }

    // Numero total de viajes (para saber cuantas paginas hay)
    public static function contarViajes() {

        $conexion = self::conectar();

        $total = $conexion->query('SELECT COUNT(*) FROM ' . TABLA_VIAJES)->fetchColumn();

        self::desconectar($conexion);
        return (int) $total;
    }

    // Un viaje concreto por su id
    public static function obtenerViaje($id) {

        $conexion = self::conectar();

        $sql = 'SELECT v.*, p.nombre AS pais, p.continente
                FROM ' . TABLA_VIAJES . ' v
                JOIN ' . TABLA_PAISES . ' p ON v.pais_id = p.id
                WHERE v.id = :id';

        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':id', $id);
        $sentencia->execute();

        $fila = $sentencia->fetch(PDO::FETCH_ASSOC);

        self::desconectar($conexion);

        return $fila ? new Viaje($fila) : false;
    }


    // ------------- Filtrado por país --------------

    // Viajes de un pais concreto 
    public static function viajesPorPais($paisId) {
        $conexion = self::conectar();
        $sql = 'SELECT v.*, p.nombre AS pais, p.continente
                FROM ' . TABLA_VIAJES . ' v
                JOIN ' . TABLA_PAISES . ' p ON v.pais_id = p.id
                WHERE v.pais_id = :pais
                ORDER BY v.fecha_inicio';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':pais', $paisId);
        $sentencia->execute();

        $viajes = array();
        while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $viajes[] = new Viaje($fila);
        }

        self::desconectar($conexion);
        return $viajes;
    }

    // Listado paginado de viajes de un pais concreto. $inicio = desde que fila; $numero = cuantos.
    public static function obtenerViajesPorPais($paisId, $inicio, $numero){
        $inicio = (int) $inicio;
        $numero = (int) $numero;

        $conexion = self::conectar();

        $sql = 'SELECT v.*, p.nombre AS pais, p.continente
            FROM ' . TABLA_VIAJES . ' v
            JOIN ' . TABLA_PAISES . ' p ON v.pais_id = p.id
            WHERE v.pais_id = :pais
            ORDER BY v.id
            LIMIT ' . $inicio . ', ' . $numero;
        
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':pais', $paisId);
        $sentencia->execute();

        $viajes = array();

        while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $viajes[] = new Viaje($fila);
        }

        self::desconectar($conexion);

        return $viajes;
    }

    // Numero total de viajes de un pais concreto (para saber cuantas paginas hay)
    public static function contarViajesPorPais($paisId) {
        $conexion = self::conectar();

        $sql = 'SELECT COUNT(*) FROM ' . TABLA_VIAJES . ' WHERE pais_id = :pais';

        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':pais', $paisId);
        $sentencia->execute();

        $total = $sentencia->fetchColumn();

        self::desconectar($conexion);
        
        return (int) $total;
    }

    // ----------------- Buscador ------------------

    // Viajes cuyo destino o país contenga el texto y que estén disponibles en la fecha indicada
    public static function buscarViajes($texto, $fecha) {

        $conexion = self::conectar();

        $sql = 'SELECT v.*, p.nombre AS pais, p.continente
                FROM ' . TABLA_VIAJES . ' v
                JOIN ' . TABLA_PAISES . ' p ON v.pais_id = p.id
                WHERE (
                    v.destino LIKE :texto
                    OR p.nombre LIKE :texto
                )
                AND :fecha BETWEEN v.fecha_inicio AND v.fecha_fin
                ORDER BY v.fecha_inicio';

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(':texto', '%' . $texto . '%');
        $sentencia->bindValue(':fecha', $fecha);

        $sentencia->execute();

        $viajes = array();

        while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $viajes[] = new Viaje($fila);
        }

        self::desconectar($conexion);

        return $viajes;
    }

    // -------------------- CRUD para el admin ------------------
    // Inserta un nuevo viaje
    public static function insertarViaje(
        $destino,
        $paisId,
        $descripcion,
        $frasePromo,
        $imagen,
        $precio,
        $fechaInicio,
        $fechaFin
    ) {

        $conexion = self::conectar();

        $sql = 'INSERT INTO ' . TABLA_VIAJES . '
                (destino, pais_id, descripcion, frase_promo, imagen, precio, fecha_inicio, fecha_fin)
                VALUES
                (:destino, :pais, :descripcion, :frase, :imagen, :precio, :inicio, :fin)';

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(':destino', $destino);
        $sentencia->bindValue(':pais', $paisId);
        $sentencia->bindValue(':descripcion', $descripcion);
        $sentencia->bindValue(':frase', $frasePromo);
        $sentencia->bindValue(':imagen', $imagen);
        $sentencia->bindValue(':precio', $precio);
        $sentencia->bindValue(':inicio', $fechaInicio);
        $sentencia->bindValue(':fin', $fechaFin);

        $sentencia->execute();

        self::desconectar($conexion);
    }


    // Actualiza un viaje existente
    public static function actualizarViaje(
        $id,
        $destino,
        $paisId,
        $descripcion,
        $frasePromo,
        $imagen,
        $precio,
        $fechaInicio,
        $fechaFin
    ) {

        $conexion = self::conectar();

        $sql = 'UPDATE ' . TABLA_VIAJES . '
                SET destino = :destino,
                    pais_id = :pais,
                    descripcion = :descripcion,
                    frase_promo = :frase,
                    imagen = :imagen,
                    precio = :precio,
                    fecha_inicio = :inicio,
                    fecha_fin = :fin
                WHERE id = :id';

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(':id', $id);
        $sentencia->bindValue(':destino', $destino);
        $sentencia->bindValue(':pais', $paisId);
        $sentencia->bindValue(':descripcion', $descripcion);
        $sentencia->bindValue(':frase', $frasePromo);
        $sentencia->bindValue(':imagen', $imagen);
        $sentencia->bindValue(':precio', $precio);
        $sentencia->bindValue(':inicio', $fechaInicio);
        $sentencia->bindValue(':fin', $fechaFin);

        $sentencia->execute();

        self::desconectar($conexion);
    }


    // Elimina un viaje
    public static function eliminarViaje($id) {

        $conexion = self::conectar();

        $sql = 'DELETE FROM ' . TABLA_VIAJES . '
                WHERE id = :id';

        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':id', $id);

        $sentencia->execute();

        self::desconectar($conexion);
    }

    // --------------------- Carrusel ------------------
    public static function obtenerViajesCarrusel() {

        return self::obtenerViajes(0, 6);

    }
}