<?php
/**
 * Conecta con una API externa y procesa la información recibida en formato JSON.
 * 
 * @param string $url Dirección URL del endpoint de la API.
 * @return array|null Devuelve un array asociativo con los dtos, o null en caso de fallo.
 */
function getDataFromAPI($url){
    // Obtención de dtos mediante la URL.
    $json = @file_get_contents($url);
    // Si ha fallado la obtención de datos, devuelve null
    if($json===false){
        return null;
    }
    // Devuelve los datos. True para devolver array asociativo.
    return json_decode($json, true);
}

