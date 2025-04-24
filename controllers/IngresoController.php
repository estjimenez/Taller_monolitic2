<?php
class IngresoController {
    private $ingresoModel;
    private $programaModel;
    private $salaModel;
    private $responsableModel;

    public function __construct($db) {
        $this->ingresoModel = new Ingreso($db);
        $this->programaModel = new Programa($db);
        $this->salaModel = new Sala($db);
        $this->responsableModel = new Responsable($db);
    }

    public function mostrarFormulario() {
        $programas = $this->programaModel->obtenerTodos();
        $salas = $this->salaModel->obtenerTodas();
        $responsables = $this->responsableModel->obtenerTodos();

        include 'views/ingresos/crear.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->ingresoModel->crear($_POST)) {
                header('Location: index.php?accion=mensaje&tipo=exito');
            } else {
                header('Location: index.php?accion=mensaje&tipo=error');
            }
        }
    }

    public function index() {
        $ingresos = $this->ingresoModel->obtenerIngresosDia();
        $programas = $this->programaModel->obtenerTodos();
        $responsables = $this->responsableModel->obtenerTodos();
        
        include 'views/ingresos/index.php';
    }

    public function buscar() {
        $filtros = [
            'fechaInicio' => $_GET['fechaInicio'] ?? null,
            'fechaFin' => $_GET['fechaFin'] ?? null,
            'codigoEstudiante' => $_GET['codigoEstudiante'] ?? null,
            'idPrograma' => $_GET['idPrograma'] ?? null,
            'idResponsable' => $_GET['idResponsable'] ?? null
        ];

        $ingresos = $this->ingresoModel->buscarIngresos($filtros);
        $programas = $this->programaModel->obtenerTodos();
        $responsables = $this->responsableModel->obtenerTodos();

        include 'views/ingresos/index.php';
    }

    public function mostrarEditar($id) {
        $ingreso = $this->ingresoModel->obtenerPorId($id);
        if (!$ingreso) {
            header('Location: index.php?mensaje=no-encontrado');
            return;
        }
        include 'views/ingresos/editar.php';
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                header('Location: index.php?mensaje=error');
                return;
            }

            $datos = [
                'codigoEstudiante' => $_POST['codigoEstudiante'],
                'nombreEstudiante' => $_POST['nombreEstudiante']
            ];

            if ($this->ingresoModel->actualizar($id, $datos)) {
                header('Location: index.php?mensaje=actualizado');
            } else {
                header('Location: index.php?mensaje=error');
            }
        }
    }

    public function mostrarActivos() {
        $ingresosActivos = $this->ingresoModel->obtenerIngresosActivos();
        include 'views/ingresos/activos.php';
    }

    public function registrarSalida() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                header('Location: index.php?mensaje=error');
                return;
            }

            if ($this->ingresoModel->registrarSalida($id)) {
                header('Location: index.php?accion=activos&mensaje=salida-registrada');
            } else {
                header('Location: index.php?accion=activos&mensaje=error');
            }
        }
    }
} 