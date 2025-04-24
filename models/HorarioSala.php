<?php
class HorarioSala {
    private $conn;
    private $tabla = "horarios_salas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerHorarioPorSala($idSala, $dia) {
        $query = "SELECT * FROM " . $this->tabla . "
                WHERE idSala = :idSala 
                AND dia = :dia
                ORDER BY horaInicio";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':idSala' => $idSala,
            ':dia' => $dia
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificarDisponibilidad($idSala, $fecha, $hora) {
        // Obtener el día de la semana en español
        $diasSemana = [
            'Sunday' => '',
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado'
        ];
        
        $dia = $diasSemana[date('l', strtotime($fecha))];
        
        // Verificar si hay clases programadas
        $query = "SELECT COUNT(*) FROM " . $this->tabla . "
                WHERE idSala = :idSala 
                AND dia = :dia
                AND :hora BETWEEN horaInicio AND horaFin";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':idSala' => $idSala,
            ':dia' => $dia,
            ':hora' => $hora
        ]);
        
        $ocupada = $stmt->fetchColumn() > 0;
        
        return !$ocupada;
    }
} 