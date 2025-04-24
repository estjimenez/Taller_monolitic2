<?php
class Ingreso {
    private $conn;
    private $tabla = "ingresos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($datos) {
        $query = "INSERT INTO " . $this->tabla . "
                (codigoEstudiante, nombreEstudiante, idPrograma, 
                fechaIngreso, horaIngreso, idResponsable, idSala, created_at)
                VALUES
                (:codigo, :nombre, :programa, CURDATE(), CURTIME(), 
                :responsable, :sala, NOW())";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':codigo' => $datos['codigoEstudiante'],
            ':nombre' => $datos['nombreEstudiante'],
            ':programa' => $datos['idPrograma'],
            ':responsable' => $datos['idResponsable'],
            ':sala' => $datos['idSala']
        ]);
    }

    public function obtenerIngresosDia() {
        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                FROM " . $this->tabla . " i
                JOIN programas p ON i.idPrograma = p.id
                JOIN salas s ON i.idSala = s.id
                JOIN responsables r ON i.idResponsable = r.id
                WHERE DATE(i.fechaIngreso) = CURDATE()
                ORDER BY i.horaIngreso DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarIngresos($filtros) {
        $condiciones = [];
        $parametros = [];

        if (!empty($filtros['fechaInicio']) && !empty($filtros['fechaFin'])) {
            $condiciones[] = "DATE(i.fechaIngreso) BETWEEN :fechaInicio AND :fechaFin";
            $parametros[':fechaInicio'] = $filtros['fechaInicio'];
            $parametros[':fechaFin'] = $filtros['fechaFin'];
        }

        if (!empty($filtros['codigoEstudiante'])) {
            $condiciones[] = "i.codigoEstudiante = :codigo";
            $parametros[':codigo'] = $filtros['codigoEstudiante'];
        }

        if (!empty($filtros['idPrograma'])) {
            $condiciones[] = "i.idPrograma = :programa";
            $parametros[':programa'] = $filtros['idPrograma'];
        }

        if (!empty($filtros['idResponsable'])) {
            $condiciones[] = "i.idResponsable = :responsable";
            $parametros[':responsable'] = $filtros['idResponsable'];
        }

        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                FROM " . $this->tabla . " i
                JOIN programas p ON i.idPrograma = p.id
                JOIN salas s ON i.idSala = s.id
                JOIN responsables r ON i.idResponsable = r.id";

        if (!empty($condiciones)) {
            $query .= " WHERE " . implode(" AND ", $condiciones);
        }

        $query .= " ORDER BY i.fechaIngreso DESC, i.horaIngreso DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($parametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                FROM " . $this->tabla . " i
                JOIN programas p ON i.idPrograma = p.id
                JOIN salas s ON i.idSala = s.id
                JOIN responsables r ON i.idResponsable = r.id
                WHERE i.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $datos) {
        $query = "UPDATE " . $this->tabla . "
                SET codigoEstudiante = :codigo,
                    nombreEstudiante = :nombre,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':codigo' => $datos['codigoEstudiante'],
            ':nombre' => $datos['nombreEstudiante'],
            ':id' => $id
        ]);
    }

    public function registrarSalida($id) {
        $query = "UPDATE " . $this->tabla . "
                SET horaSalida = CURTIME(),
                    updated_at = NOW()
                WHERE id = :id 
                AND horaSalida IS NULL";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function obtenerIngresosActivos() {
        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                FROM " . $this->tabla . " i
                JOIN programas p ON i.idPrograma = p.id
                JOIN salas s ON i.idSala = s.id
                JOIN responsables r ON i.idResponsable = r.id
                WHERE i.horaSalida IS NULL
                AND i.fechaIngreso = CURDATE()
                ORDER BY i.horaIngreso DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 