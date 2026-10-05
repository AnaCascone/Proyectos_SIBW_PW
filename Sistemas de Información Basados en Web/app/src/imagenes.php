<?php

// ======================================================
//      OBTENER IMÁGENES DE UNA NOTICIA
// ======================================================

function getImagenes(
    $mysqli,
    $id_noticia
) {

    $sql = "

        SELECT *
        FROM imagenes
        WHERE id_noticia = ?

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

    $imagenes = [];

    while(
        $fila =
        $resultado->fetch_assoc()
    ){

        $imagenes[] = $fila;

    }

    $stmt->close();

    return $imagenes;

}


// ======================================================
//      INSERTAR IMAGEN
// ======================================================

function insertarImagen(

    $mysqli,
    $id_noticia,
    $archivo,
    $descripcion

) {

    $sql = "

        INSERT INTO imagenes
        (

            id_noticia,
            archivo,
            descripcion

        )

        VALUES (?, ?, ?)

    ";

    $stmt =  $mysqli->prepare($sql);

    if(!$stmt){
        die("Error en la consulta");
    }

    $stmt->bind_param(

        "iss",

        $id_noticia,
        $archivo,
        $descripcion

    );

    $stmt->execute();

    $stmt->close();

}


// ======================================================
//      ELIMINAR IMAGEN
// ======================================================

function eliminarImagen(
    $mysqli,
    $id
) {

    $sql = "

        DELETE FROM imagenes
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