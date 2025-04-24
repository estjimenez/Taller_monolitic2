<!DOCTYPE html>
<html>
<head>
    <title>Estudiantes Actualmente en Salas</title>
    <meta charset="UTF-8">
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background: #f0f0f0; }
        .tiempo-transcurrido { color: #666; }
        .acciones { margin: 20px 0; }
    </style>
</head>
<body>
    <h2>Estudiantes Actualmente en Salas</h2>

    <div class="acciones">
        <a href="index.php"><button>Ver Todos los Ingresos</button></a>
        <a href="index.php?accion=mostrarFormulario"><button>Nuevo Ingreso</button></a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Estudiante</th>
                <th>Programa</th>
                <th>Sala</th>
                <th>Hora Ingreso</th>
                <th>Tiempo en Sala</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ingresosActivos)): ?>
                <?php foreach($ingresosActivos as $ingreso): ?>
                    <tr>
                        <td><?php echo $ingreso['codigoEstudiante']; ?></td>
                        <td><?php echo $ingreso['nombreEstudiante']; ?></td>
                        <td><?php echo $ingreso['programa']; ?></td>
                        <td><?php echo $ingreso['sala']; ?></td>
                        <td><?php echo $ingreso['horaIngreso']; ?></td>
                        <td class="tiempo-transcurrido">
                            <?php 
                            $inicio = strtotime($ingreso['horaIngreso']);
                            $ahora = time();
                            $diferencia = $ahora - $inicio;
                            echo floor($diferencia / 3600) . 'h ' . 
                                 floor(($diferencia % 3600) / 60) . 'm';
                            ?>
                        </td>
                        <td>
                            <form method="POST" action="index.php?accion=registrarSalida" 
                                  onsubmit="return confirm('¿Confirmar salida del estudiante?');">
                                <input type="hidden" name="id" value="<?php echo $ingreso['id']; ?>">
                                <button type="submit">Registrar Salida</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">
                        No hay estudiantes en las salas en este momento
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html> 