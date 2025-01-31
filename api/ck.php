<?php
// Desactivar notificaciones de errores
error_reporting(0);

// Obtener los valores de los parámetros GET
$keyid = $_GET["keyid"] ?? '';
$key = $_GET["key"] ?? '';
$domain = (isset($_GET["URL"]) && !empty($_GET["URL"])) ? $_GET["URL"] : "drm.not-d3fau4.com";

// Validación
if (empty($keyid) || empty($key)) {
    http_response_code(503);
    header("Content-Type: application/json");
    $errorjson = [
        "Status" => "503",
        "Content" => "Validation Failed!",
        "Reason" => "Did not provide Key ID | Key or Key ID | Key isn't complete."
    ];
    echo json_encode($errorjson);
    exit;
}

$url = "$domain?&ck=" . base64_encode(json_encode([$keyid => $key]));

// Generar y mostrar la URL
die("<a href='$url'>$url</a>");
