<?php
require_once __DIR__ . '/DatosObject.php';

class Usuario extends DatosObject {

    // Comprueba usuario y contrasena. Devuelve el Usuario si es correcto, o false.
    public static function comprobarLogin($nombreUsuario, $contrasenia) {
        $conexion = self::conectar();
        $sql = 'SELECT * FROM ' . TABLA_USUARIOS . ' WHERE nombre_usuario = :usuario';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':usuario', $nombreUsuario);
        $sentencia->execute();
        $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
        self::desconectar($conexion);

        if ($fila && password_verify($contrasenia, $fila['contrasenia'])) {
            return new Usuario($fila);
        }
        return false;
    }

    // Da de alta un usuario nuevo (el tipo se queda en 'usuario' por defecto)
    public static function insertarUsuario($nombreUsuario, $nombreCompleto, $email, $contrasenia, $fechaNacimiento) {
        $conexion = self::conectar();
        $sql = 'INSERT INTO ' . TABLA_USUARIOS . ' (nombre_usuario, nombre_completo, email, contrasenia, fecha_nacimiento)
                VALUES (:usuario, :nombre, :email, :contrasenia, :nacimiento)';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':usuario', $nombreUsuario);
        $sentencia->bindValue(':nombre', $nombreCompleto);
        $sentencia->bindValue(':email', $email);
        $sentencia->bindValue(':contrasenia', password_hash($contrasenia, PASSWORD_DEFAULT));
        $sentencia->bindValue(':nacimiento', $fechaNacimiento);
        $correcto = $sentencia->execute();
        self::desconectar($conexion);
        return $correcto;
    }

    // Comprueba si ya existe ese nombre de usuario
    public static function existeUsuario($nombreUsuario) {
        $conexion = self::conectar();
        $sql = 'SELECT id FROM ' . TABLA_USUARIOS . ' WHERE nombre_usuario = :usuario';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':usuario', $nombreUsuario);
        $sentencia->execute();
        $fila = $sentencia->fetch();
        self::desconectar($conexion);
        return $fila !== false;
    }

    // Comprueba si ya existe ese email
    public static function existeEmail($email) {
        $conexion = self::conectar();
        $sql = 'SELECT id FROM ' . TABLA_USUARIOS . ' WHERE email = :email';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':email', $email);
        $sentencia->execute();
        $fila = $sentencia->fetch();
        self::desconectar($conexion);
        return $fila !== false;
    }
}