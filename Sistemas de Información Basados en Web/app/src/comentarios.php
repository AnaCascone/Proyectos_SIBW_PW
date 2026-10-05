<?php


// ======================================================
//      FUNCIÓN PARA OBTENER LOS COMENTARIOS
// ======================================================

function getComentarios(
    $mysqli,
    $id_noticia
) {

    $sql = "

        SELECT *
        FROM comentarios
        WHERE id_noticia = ?
        ORDER BY fecha DESC

    ";

    $stmt = $mysqli->prepare($sql);

    // Comprobar prepare
    if(!$stmt){

        die(
            "Error en la consulta"
        );

    }

    $stmt->bind_param(
        "i",
        $id_noticia
    );

    $stmt->execute();

    $resultado = $stmt->get_result();

    $comentarios = [];

    while(
        $fila = $resultado->fetch_assoc()
    ){

        $comentarios[] = $fila;

    }

    $stmt->close();

    return $comentarios;

}

// ======================================================
//      OBTENER ***TODOS**** LOS COMENTARIOS
// ======================================================

function getTodosComentarios(
    $mysqli,
    $busqueda = ""
) {

    // --------------- CON BÚSQUEDA ---------------
    if(!empty($busqueda)){

        $sql = "

            SELECT *
            FROM comentarios
            WHERE texto LIKE ?
            ORDER BY fecha DESC

        ";

        $stmt = $mysqli->prepare($sql);

        if(!$stmt){

            die("Error en la consulta");

        }

        $like =
            "%" . $busqueda . "%";

        $stmt->bind_param(
            "s",
            $like
        );

    }

    // --------------- SIN BÚSQUEDA ---------------

    else {

        $sql = "

            SELECT *
            FROM comentarios
            ORDER BY fecha DESC

        ";

        $stmt = $mysqli->prepare($sql);

        if(!$stmt){

            die("Error en la consulta");

        }

    }

    $stmt->execute();

    $resultado = $stmt->get_result();

    $comentarios = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $comentarios[] = $fila;

    }

    $stmt->close();

    return $comentarios;

}

// ======================================================
//      OBTENER COMENTARIO POR ID
// ======================================================

function getComentarioPorId($mysqli,$id) {

    $sql = "

        SELECT *
        FROM comentarios
        WHERE id = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $comentario =
        $resultado->fetch_assoc();

    $stmt->close();

    return $comentario;

}

// ======================================================
//      ACTUALIZAR COMENTARIO
// ======================================================

function actualizarComentario($mysqli,$id,$texto) {

    $sql = "

        UPDATE comentarios
        SET
            texto = ?,
            editado = 1
        WHERE id = ?

    ";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(
        "si",
        $texto,
        $id
    );

    $stmt->execute();

    $stmt->close();

}


// ======================================================
//      FUNCIÓN PARA INSERTAR UN COMENTARIO
// ======================================================
function insertarComentario(
    $mysqli,
    $id_noticia,
    $nombre,
    $email,
    $texto
) {

    // Definimos la consulta SQL preparada.
    // Los símbolos ? representan parámetros que
    // se sustituirán posteriormente de forma segura.

    $sql = "

        INSERT INTO comentarios
        (
            id_noticia,
            nombre,
            email,
            texto,
            fecha
        )

        VALUES (?, ?, ?, ?, NOW())

    ";

    // Preparamos la consulta SQL. Esto previene inyecciones SQL

    $stmt = $mysqli->prepare($sql);

    // Nos aseguramos de que el tipo de dato de cada parámetro es correcto (isss: int, string, string, string)
    $stmt->bind_param(

        "isss",

        $id_noticia,
        $nombre,
        $email,
        $texto

    );

    $stmt->execute();

    // Cerramos el statement para liberar recursos

    $stmt->close();

}

// ======================================================
//      ELIMINAR COMENTARIO
// ======================================================

function eliminarComentario(
    $mysqli,
    $id
) {

    $sql = "

        DELETE FROM comentarios
        WHERE id = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    $stmt->close();

}

?>