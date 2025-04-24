<?php
require_once 'models/RegistroModel.php';

class RegistroController {
    private $modelo;
    
    public function __construct() {
        $this->modelo = new RegistroModel();
    }
    
    public function mostrarFormulario() {
        $programas = $this->modelo->getProgramas();
        $salas = $this->modelo->getSalas();
        $responsables = $this->modelo->getResponsables();
        
        require_once 'views/registro_form.php';
    }
    
    public function procesarRegistro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'codigo' => $_POST['codigo'],
                'nombre' => $_POST['nombre'],
                'idPrograma' => $_POST['idPrograma'],
                'idSala' => $_POST['idSala'],
                'idResponsable' => $_POST['idResponsable']
            ];
            
            if ($this->modelo->guardarIngreso($datos)) {
                $mensaje = "Ingreso registrado exitosamente";
                $tipo = "exito";
            } else {
                $mensaje = "Error al registrar el ingreso";
                $tipo = "error";
            }
            
            require_once 'views/mensaje.php';
        }
    }
} 