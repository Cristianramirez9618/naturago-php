<?php

// ========================================
// API DE REGISTRO DE USUARIOS - NATURAGO
// ========================================

// Indicamos que la respuesta será JSON.
header("Content-Type: application/json; charset=UTF-8");

// Permitimos solicitudes POST.
header("Access-Control-Allow-Methods: POST");

// Indicamos los encabezados permitidos.
header("Access-Control-Allow-Headers: Content-Type");

// Incluimos la conexión a la base de datos.
// __DIR__ obtiene la ubicación real de este archivo.
require_once __DIR__ . "/../config/database.php";


// ========================================
// VALIDAR MÉTODO DE LA SOLICITUD
// ========================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo json_encode([
        "success" => false,
        "mensaje" => "Método no permitido. Usa POST."
    ]);

    exit;
}


// ========================================
// OBTENER DATOS JSON
// ========================================

$datos = json_decode(
    file_get_contents("php://input"),
    true
);


// ========================================
// VALIDAR DATOS RECIBIDOS
// ========================================

if (
    !is_array($datos) ||
    empty($datos["nombre"]) ||
    empty($datos["correo"]) ||
    empty($datos["password"])
) {

    echo json_encode([
        "success" => false,
        "mensaje" => "Todos los campos son obligatorios"
    ]);

    exit;
}


// ========================================
// GUARDAR Y LIMPIAR LOS DATOS
// ========================================

$nombre = trim($datos["nombre"]);

$correo = trim($datos["correo"]);

$password = $datos["password"];


// ========================================
// VALIDAR EL FORMATO DEL CORREO
// ========================================

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "mensaje" => "El correo electrónico no es válido"
    ]);

    exit;
}


// ========================================
// VERIFICAR SI EL CORREO YA EXISTE
// ========================================

$sql = "SELECT id FROM usuarios WHERE correo = ?";

$stmt = $conexion->prepare($sql);


// Verificamos que la consulta se haya preparado.
if (!$stmt) {

    echo json_encode([
        "success" => false,
        "mensaje" => "Error al preparar la consulta"
    ]);

    exit;
}


// Enviamos el correo a la consulta.
$stmt->bind_param(
    "s",
    $correo
);


// Ejecutamos la consulta.
$stmt->execute();


// Obtenemos el resultado.
$resultado = $stmt->get_result();


// Si el correo ya existe.
if ($resultado->num_rows > 0) {

    echo json_encode([
        "success" => false,
        "mensaje" => "El correo ya está registrado"
    ]);

    $stmt->close();

    $conexion->close();

    exit;
}


// Cerramos la primera consulta.
$stmt->close();


// ========================================
// ENCRIPTAR CONTRASEÑA
// ========================================

$passwordHash = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// ========================================
// REGISTRAR NUEVO USUARIO
// ========================================

$sql = "
    INSERT INTO usuarios (nombre, correo, password)
    VALUES (?, ?, ?)
";

$stmt = $conexion->prepare($sql);


// Verificamos que la consulta se haya preparado.
if (!$stmt) {

    echo json_encode([
        "success" => false,
        "mensaje" => "Error al preparar el registro"
    ]);

    exit;
}


// Enviamos los datos a la consulta.
$stmt->bind_param(
    "sss",
    $nombre,
    $correo,
    $passwordHash
);


// ========================================
// EJECUTAR REGISTRO
// ========================================

if ($stmt->execute()) {

    echo json_encode([

        "success" => true,

        "mensaje" => "Usuario registrado correctamente"

    ]);

} else {

    echo json_encode([

        "success" => false,

        "mensaje" => "Error al registrar el usuario"

    ]);

}


// ========================================
// CERRAR CONEXIONES
// ========================================

$stmt->close();

$conexion->close();

?>