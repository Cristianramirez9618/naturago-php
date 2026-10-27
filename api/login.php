<?php

// ========================================
// API DE INICIO DE SESIÓN - NATURAGO
// ========================================

// Indicamos que la respuesta será JSON.
header("Content-Type: application/json; charset=UTF-8");

// Permitimos solicitudes POST.
header("Access-Control-Allow-Methods: POST");

// Indicamos los encabezados permitidos.
header("Access-Control-Allow-Headers: Content-Type");

// Incluimos la conexión a la base de datos.
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
    empty($datos["correo"]) ||
    empty($datos["password"])
) {

    echo json_encode([
        "success" => false,
        "mensaje" => "Correo y contraseña son obligatorios"
    ]);

    exit;
}


// ========================================
// GUARDAR LOS DATOS
// ========================================

$correo = trim($datos["correo"]);

$password = $datos["password"];


// ========================================
// VALIDAR FORMATO DEL CORREO
// ========================================

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "mensaje" => "El correo electrónico no es válido"
    ]);

    exit;
}


// ========================================
// BUSCAR USUARIO
// ========================================

$sql = "
    SELECT id, nombre, correo, password
    FROM usuarios
    WHERE correo = ?
";

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


// ========================================
// VERIFICAR SI EL USUARIO EXISTE
// ========================================

if ($resultado->num_rows === 0) {

    echo json_encode([
        "success" => false,
        "mensaje" => "El usuario no está registrado"
    ]);

    $stmt->close();

    $conexion->close();

    exit;
}


// Obtenemos los datos del usuario.
$usuario = $resultado->fetch_assoc();


// ========================================
// VERIFICAR CONTRASEÑA
// ========================================

if (!password_verify(
    $password,
    $usuario["password"]
)) {

    echo json_encode([
        "success" => false,
        "mensaje" => "Contraseña incorrecta"
    ]);

    $stmt->close();

    $conexion->close();

    exit;
}


// ========================================
// INICIO DE SESIÓN CORRECTO
// ========================================

echo json_encode([

    "success" => true,

    "mensaje" => "Inicio de sesión correcto",

    "usuario" => [

        "id" => $usuario["id"],

        "nombre" => $usuario["nombre"],

        "correo" => $usuario["correo"]

    ]

]);


// ========================================
// CERRAR CONEXIONES
// ========================================

$stmt->close();

$conexion->close();

?>