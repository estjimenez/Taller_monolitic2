<?php
require_once 'config/database.php';

class RegistroModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getProgramas() {
        $conexion = $this->db->conectar();
        $sql = "SELECT id, nombre FROM programas";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getSalas() {
        $conexion = $this->db->conectar();
        $sql = "SELECT id, nombre FROM salas";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getResponsables() {
        $conexion = $this->db->conectar();
        $sql = "SELECT id, nombre FROM responsables";
        $resultado = $conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    
    public function guardarIngreso($datos) {
        $conexion = $this->db->conectar();
        
        $codigo = $conexion->real_escape_string($datos['codigo']);
        $nombre = $conexion->real_escape_string($datos['nombre']);
        $idPrograma = (int)$datos['idPrograma'];
        $idSala = (int)$datos['idSala'];
        $idResponsable = (int)$datos['idResponsable'];
        
        $fechaActual = date('Y-m-d');
        $horaActual = date('H:i:s');
        $timestamp = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, 
                fechaIngreso, horaIngreso, idResponsable, idSala, created_at) 
                VALUES ('$codigo', '$nombre', $idPrograma, '$fechaActual', 
                '$horaActual', $idResponsable, $idSala, '$timestamp')";
        
        return $conexion->query($sql);
    }
} 