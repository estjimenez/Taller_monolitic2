<?php
require_once 'config/database.php';
require_once 'models/Ingreso.php';
require_once 'models/Programa.php';
require_once 'models/Sala.php';
require_once 'models/Responsable.php';
require_once 'controllers/IngresoController.php';

$database = new Database();
$db = $database->getConnection();

$controller = new IngresoController($db);

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

switch($accion) {
    case 'index':
        $controller->index();
        break;
    case 'buscar':
        $controller->buscar();
        break;
    case 'mostrarFormulario':
        $controller->mostrarFormulario();
        break;
    case 'guardar':
        $controller->guardar();
        break;
    case 'editar':
        $controller->mostrarEditar($_GET['id']);
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    case 'activos':
        $controller->mostrarActivos();
        break;
    case 'registrarSalida':
        $controller->registrarSalida();
        break;
    default:
        $controller->index();
        break;
}
?>
