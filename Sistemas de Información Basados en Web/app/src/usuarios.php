<?php

// ======================================================
//      BUSCAR USUARIO POR EMAIL
// ======================================================

function getUsuarioPorEmail(
    $mysqli,
    $email
) {

    $sql = "

        SELECT *
        FROM usuarios
        WHERE email = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(
        "s",
        $email
    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $usuario =
        $resultado->fetch_assoc();

    $stmt->close();

    return $usuario;

}


// ======================================================
//      BUSCAR USUARIO POR NOMBRE
// ======================================================

function getUsuarioPorNombre(
    $mysqli,
    $nombre
) {

    $sql = "

        SELECT *
        FROM usuarios
        WHERE nombre = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(
        "s",
        $nombre
    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $usuario =
        $resultado->fetch_assoc();

    $stmt->close();

    return $usuario;

}


// ======================================================
//      BUSCAR USUARIO POR NOMBRE O EMAIL
// ======================================================

function getUsuarioPorNombreOEmail(
    $mysqli,
    $identificador
) {

    $sql = "

        SELECT *
        FROM usuarios

        WHERE nombre = ?
        OR email = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(

        "ss",

        $identificador,
        $identificador

    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $usuario =
        $resultado->fetch_assoc();

    $stmt->close();

    return $usuario;

}


// ======================================================
//      OBTENER USUARIO POR ID
// ======================================================

function getUsuarioPorId(
    $mysqli,
    $id
) {

    $sql = "

        SELECT *
        FROM usuarios
        WHERE id = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $usuario =
        $resultado->fetch_assoc();

    $stmt->close();

    return $usuario;

}


// ======================================================
//      REGISTRAR USUARIO
// ======================================================

function insertarUsuario(
    $mysqli,
    $nombre,
    $email,
    $password
) {

    $passwordHash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );

    $sql = "

        INSERT INTO usuarios
        (
            nombre,
            email,
            password
        )

        VALUES (?, ?, ?)

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(

        "sss",

        $nombre,
        $email,
        $passwordHash

    );

    $stmt->execute();

    $stmt->close();

}


// ======================================================
//      ACTUALIZAR USUARIO
// ======================================================

function actualizarUsuario(
    $mysqli,
    $id,
    $nombre,
    $email,
    $password = null
) {

    // CON CONTRASEÑA

    if(!empty($password)){

        $passwordHash =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );

        $sql = "

            UPDATE usuarios
            SET
                nombre = ?,
                email = ?,
                password = ?
            WHERE id = ?

        ";

        $stmt =
            $mysqli->prepare($sql);

        if(!$stmt){

            die("Error en la consulta");

        }

        $stmt->bind_param(

            "sssi",

            $nombre,
            $email,
            $passwordHash,
            $id

        );

    }

    // SIN CONTRASEÑA

    else {

        $sql = "

            UPDATE usuarios
            SET
                nombre = ?,
                email = ?
            WHERE id = ?

        ";

        $stmt =
            $mysqli->prepare($sql);

        if(!$stmt){

            die("Error en la consulta");

        }

        $stmt->bind_param(

            "ssi",

            $nombre,
            $email,
            $id

        );

    }

    $stmt->execute();

    $stmt->close();

}


// ======================================================
//      OBTENER TODOS LOS USUARIOS
// ======================================================

function getUsuarios(
    $mysqli
) {

    $sql = "

        SELECT *
        FROM usuarios
        ORDER BY nombre ASC

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $usuarios = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $usuarios[] = $fila;

    }

    $stmt->close();

    return $usuarios;

}


// ======================================================
//      ACTUALIZAR ROL
// ======================================================

function actualizarRolUsuario(

    $mysqli,
    $id,
    $rol

) {

    $sql = "

        UPDATE usuarios
        SET rol = ?
        WHERE id = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(

        "si",

        $rol,
        $id

    );

    $stmt->execute();

    $stmt->close();

}


// ======================================================
//      ELIMINAR USUARIO
// ======================================================

function eliminarUsuario(
    $mysqli,
    $id
) {

    $sql = "

        DELETE FROM usuarios
        WHERE id = ?

    ";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    $stmt->close();

}


// ======================================================
//      CONTAR SUPERUSUARIOS
// ======================================================

function contarSuperusuarios(
    $mysqli
) {

    $sql = "

        SELECT COUNT(*) AS total
        FROM usuarios
        WHERE rol = 'superusuario'

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $fila =
        $resultado->fetch_assoc();

    $stmt->close();

    return $fila['total'];

}

?>