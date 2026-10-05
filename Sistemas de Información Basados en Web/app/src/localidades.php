<?php

// ======================================================
//      FUNCIÓN PARA OBTENER LAS LOCALIDADES
// ======================================================

function getLocalidades($mysqli) {

    // Realizamos una consulta SQL para obtener
    // el nombre de todas las localidades almacenadas

    $consulta = $mysqli->query(

        "SELECT nombre
         FROM localidades"

    );

    $localidades = [];

    // Recorremos todos los resultados obtenidos.

    while($fila = $consulta->fetch_assoc()) {

        // Añadimos únicamente el nombre de la localidad
        $localidades[] = $fila['nombre'];

    }

    return $localidades;

}

?>