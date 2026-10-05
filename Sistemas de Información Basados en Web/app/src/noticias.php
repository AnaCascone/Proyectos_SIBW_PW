<?php

require_once 'src/hashtags.php';

// ======================================================
//      FUNCIÓN PARA OBTENER TODAS LAS NOTICIAS
// ======================================================

function getNoticias($mysqli) {

    $sql = "

        SELECT noticias.*,

        (
            SELECT archivo
            FROM imagenes
            WHERE imagenes.id_noticia = noticias.id
            LIMIT 1
        ) AS imagen

        FROM noticias

        ORDER BY fecha DESC

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $noticias = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $fila['hashtags'] =

            getHashtagsNoticia(

                $mysqli,
                $fila['id']

            );

        $noticias[] = $fila;

    }

    $stmt->close();

    return $noticias;

}

function getNoticiasPublicadas($mysqli) {

    $sql = "

        SELECT noticias.*,

        (
            SELECT archivo
            FROM imagenes
            WHERE imagenes.id_noticia = noticias.id
            LIMIT 1
        ) AS imagen

        FROM noticias

        WHERE publicado = 1

        ORDER BY fecha DESC

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $noticias = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $fila['hashtags'] =

            getHashtagsNoticia(

                $mysqli,
                $fila['id']

            );

        $noticias[] = $fila;

    }

    $stmt->close();

    return $noticias;

}

// ======================================================
//      FUNCIÓN PARA OBTENER UNA NOTICIA CONCRETA
// ======================================================

function getNoticia($mysqli, $id) {

    $sql = "

        SELECT *
        FROM noticias
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

    $noticia =
        $resultado->fetch_assoc();

    $stmt->close();

    return $noticia;

}

// ======================================================
//      BUSCAR NOTICIAS
// ======================================================

function buscarNoticias(

    $mysqli,
    $titulo,
    $descripcion

) {

    $sql = "

        SELECT noticias.*,

        (
            SELECT archivo
            FROM imagenes
            WHERE imagenes.id_noticia = noticias.id
            LIMIT 1
        ) AS imagen

        FROM noticias

        WHERE titulo LIKE ?
        AND cuerpo LIKE ?

        ORDER BY fecha DESC

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){
        die("Error en la consulta");
    }

    $tituloBusqueda =
        "%" . $titulo . "%";

    $descripcionBusqueda =
        "%" . $descripcion . "%";

    $stmt->bind_param(

        "ss",

        $tituloBusqueda,
        $descripcionBusqueda

    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $noticias = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $fila['hashtags'] =

            getHashtagsNoticia(

                $mysqli,
                $fila['id']

            );

        $noticias[] = $fila;

    }

    $stmt->close();

    return $noticias;

}

// Buscar publicadas

function buscarNoticiasPublicadasAjax(
    $mysqli,
    $texto
){

    $sql = "

        SELECT id, titulo

        FROM noticias

        WHERE publicado = 1
        AND titulo LIKE ?

        ORDER BY fecha DESC

        LIMIT 10

    ";

    $stmt =
        $mysqli->prepare($sql);

    $busqueda =
        "%" . $texto . "%";

    $stmt->bind_param(
        "s",
        $busqueda
    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $noticias = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){
        $noticias[] = $fila;
    }

    return $noticias;
}

// ======================================================
//      INSERTAR NOTICIA
// ======================================================

function insertarNoticia(

    $mysqli,
    $titulo,
    $cuerpo,
    $fecha,
    $resumen,
    $concejalia,
    $responsables,
    $publicado

) {

    $sql = "

        INSERT INTO noticias
        (

            titulo,
            cuerpo,
            fecha,
            resumen,
            concejalia,
            responsables,
            publicado

        )

        VALUES (?, ?, ?, ?, ?, ?, ?)

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){
        die("Error en la consulta");
    }

    $stmt->bind_param(

        "ssssssi",

        $titulo,
        $cuerpo,
        $fecha,
        $resumen,
        $concejalia,
        $responsables,
        $publicado

    );

    $stmt->execute();

    $stmt->close();

    return $mysqli->insert_id;

}

// ======================================================
//      ACTUALIZAR NOTICIA
// ======================================================

function actualizarNoticia(

    $mysqli,
    $id,
    $titulo,
    $cuerpo,
    $fecha,
    $resumen,
    $concejalia,
    $responsables

) {

    $sql = "

        UPDATE noticias
        SET

            titulo = ?,
            cuerpo = ?,
            fecha = ?,
            resumen = ?,
            concejalia = ?,
            responsables = ?

        WHERE id = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){
        die("Error en la consulta");
    }

    $stmt->bind_param(

        "ssssssi",

        $titulo,
        $cuerpo,
        $fecha,
        $resumen,
        $concejalia,
        $responsables,
        $id

    );

    $stmt->execute();

    $stmt->close();

}

// ======================================================
//      ELIMINAR NOTICIA
// ======================================================

function eliminarNoticia(
    $mysqli,
    $id
) {

    $sql = "

        DELETE FROM noticias
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

    $stmt->close();

}


// ======================================================
//      PUBLICADOS / NO PUBLICADOS
// ======================================================

function cambiarPublicado(
    $mysqli,
    $id,
    $publicado
){

    $sql = "

        UPDATE noticias
        SET publicado = ?
        WHERE id = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    if(!$stmt){
        die("Error en la consulta");
    }

    $stmt->bind_param(
        "ii",
        $publicado,
        $id
    );

    $stmt->execute();

    $stmt->close();

}


?>