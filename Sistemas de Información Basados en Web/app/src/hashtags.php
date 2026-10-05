<?php

// ======================================================
//      OBTENER TODOS LOS HASHTAGS
// ======================================================

function getHashtags(
    $mysqli
) {

    $sql = "

        SELECT *
        FROM hashtags
        ORDER BY nombre ASC

    ";

    $resultado =
        $mysqli->query($sql);

    $hashtags = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $hashtags[] = $fila;

    }

    return $hashtags;

}

// ======================================================
//      OBTENER HASHTAG POR NOMBRE
// ======================================================

function getHashtagPorNombre(
    $mysqli,
    $nombre
) {

    $sql = "

        SELECT *
        FROM hashtags
        WHERE nombre = ?

    ";

    $stmt = $mysqli->prepare($sql);

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

    $hashtag =
        $resultado->fetch_assoc();

    $stmt->close();

    return $hashtag;

}


// ======================================================
//      INSERTAR HASHTAG
// ======================================================

function insertarHashtag(
    $mysqli,
    $nombre
) {

    $sql = "

        INSERT INTO hashtags
        (
            nombre
        )

        VALUES (?)

    ";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(
        "s",
        $nombre
    );

    $stmt->execute();

    $id =
        $mysqli->insert_id;

    $stmt->close();

    return $id;

}

// ======================================================
//      ACTUALIZAR HASHTAG
// ======================================================

function actualizarHashtag(

    $mysqli,
    $id,
    $nombre

) {

    $sql = "

        UPDATE hashtags
        SET nombre = ?
        WHERE id = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    $stmt->bind_param(
        "si",
        $nombre,
        $id
    );

    $stmt->execute();

    $stmt->close();

}

// ======================================================
//      ELIMINAR HASHTAG
// ======================================================

function eliminarHashtag(
    $mysqli,
    $id
) {

    $sql = "

        DELETE FROM hashtags
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

// ======================================================
//      ASOCIAR HASHTAG A NOTICIA
// ======================================================

function asociarHashtagNoticia(

    $mysqli,
    $id_noticia,
    $id_hashtag

) {

    $sql = "

        INSERT IGNORE INTO noticias_hashtags
        (

            id_noticia,
            id_hashtag

        )

        VALUES (?, ?)

    ";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(

        "ii",

        $id_noticia,
        $id_hashtag

    );

    $stmt->execute();

    $stmt->close();

}

// ======================================================
//      OBTENER HASHTAGS DE UNA NOTICIA
// ======================================================

function getHashtagsNoticia(
    $mysqli,
    $id_noticia
) {

    $sql = "

        SELECT hashtags.*

        FROM hashtags

        INNER JOIN noticias_hashtags
        ON hashtags.id = noticias_hashtags.id_hashtag

        WHERE noticias_hashtags.id_noticia = ?

    ";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $stmt->bind_param(
        "i",
        $id_noticia
    );

    $stmt->execute();

    $resultado =
        $stmt->get_result();

    $hashtags = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $hashtags[] = $fila;

    }

    $stmt->close();

    return $hashtags;

}

// ======================================================
//      PROCESAR HASHTAGS
// ======================================================

function procesarHashtags(

    $mysqli,
    $id_noticia,
    $textoHashtags

) {

    // Convertimos los hashtags en un texto separado por comas: 
    // Ej. "incendio, tráfico, alerta"

    $hashtags =
        explode(
            ",",
            $textoHashtags
        );

    foreach($hashtags as $hashtag){

        $hashtag = strtolower(trim($hashtag));

        if(empty($hashtag)){

            continue;

        }

        // Buscar hashtag existente
        $existente =
            getHashtagPorNombre(
                $mysqli,
                $hashtag
            );

        // Si no existe → crearlo
        if(!$existente){

            $idHashtag =
                insertarHashtag(
                    $mysqli,
                    $hashtag
                );

        }

        else{

            $idHashtag =
                $existente['id'];

        }

        // Asociar hashtag-noticia
        asociarHashtagNoticia(

            $mysqli,
            $id_noticia,
            $idHashtag

        );

    }

}

// ======================================================
//      BUSCAR NOTICIAS POR HASHTAG
// ======================================================

function getNoticiasPorHashtag(
    $mysqli,
    $hashtag
) {

    $sql = "

        SELECT DISTINCT noticias.*,

        (
            SELECT archivo
            FROM imagenes
            WHERE imagenes.id_noticia = noticias.id
            LIMIT 1
        ) AS imagen

        FROM noticias

        INNER JOIN noticias_hashtags
        ON noticias.id = noticias_hashtags.id_noticia

        INNER JOIN hashtags
        ON hashtags.id = noticias_hashtags.id_hashtag

        WHERE hashtags.nombre LIKE ?

        AND noticias.publicado = 1

        ORDER BY noticias.fecha DESC

    ";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt){

        die("Error en la consulta");

    }

    $busqueda =
        "%" . $hashtag . "%";

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
//      ELIMINAR HASHTAGS DE UNA NOTICIA
// ======================================================

function eliminarHashtagsNoticia(
    $mysqli,
    $id_noticia
) {

    $sql = "

        DELETE FROM noticias_hashtags
        WHERE id_noticia = ?

    ";

    $stmt =
        $mysqli->prepare($sql);

    $stmt->bind_param(
        "i",
        $id_noticia
    );

    $stmt->execute();

    $stmt->close();

}


// ======================================================
//      ELIMINAR HASHTAGS HUÉRFANOS
// ======================================================

function eliminarHashtagsHuerfanos(
    $mysqli
) {

    $sql = "

        DELETE FROM hashtags

        WHERE id NOT IN (

            SELECT id_hashtag
            FROM noticias_hashtags

        )

    ";

    $mysqli->query($sql);

}