<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Ingresos a Salas</title>
    <meta charset="UTF-8">
    <style>
        .filtros { margin: 20px 0; padding: 15px; background: #f5f5f5; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background: #f0f0f0; }
        .acciones { margin: 20px 0; }
    </style>
</head>
<body>
    <h2>Sistema de Ingresos a Salas</h2>

    <div class="acciones">
        <a href="index.php?accion=mostrarFormulario">
            <button>Registrar Nuevo Ingreso</button>
        </a>
        <a href="index.php?accion=activos">
            <button>Ver Estudiantes en Salas</button>
        </a>
    </div>

    <div class="filtros">
        <h3>Filtros de Búsqueda</h3>
        <form method="GET" action="index.php">
            <input type="hidden" name="accion" value="buscar">
            
            <div>
                <label>Rango de Fechas:</label>
                <input type="date" name="fechaInicio">
                <input type="date" name="fechaFin">
            </div>

            <div>
                <label>Código Estudiante:</label>
                <input type="text" name="codigoEstudiante">
            </div>

            <div>
                <label>Programa:</label>
                <select name="idPrograma">
                    <option value="">Todos los programas</option>
                    <?php foreach($programas as $programa): ?>
                        <option value="<?php echo $programa['id']; ?>">
                            <?php echo $programa['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Responsable:</label>
                <select name="idResponsable">
                    <option value="">Todos los responsables</option>
                    <?php foreach($responsables as $responsable): ?>
                        <option value="<?php echo $responsable['id']; ?>">
                            <?php echo $responsable['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="resultados">
        <h3>Ingresos <?php echo empty($_GET['accion']) ? 'del Día' : ''; ?></h3>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Estudiante</th>
                    <th>Programa</th>
                    <th>Sala</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ingresos)): ?>
                    <?php foreach($ingresos as $ingreso): ?>
                        <tr>
                            <td><?php echo $ingreso['codigoEstudiante']; ?></td>
                            <td><?php echo $ingreso['nombreEstudiante']; ?></td>
                            <td><?php echo $ingreso['programa']; ?></td>
                            <td><?php echo $ingreso['sala']; ?></td>
                            <td><?php echo $ingreso['fechaIngreso']; ?></td>
                            <td><?php echo $ingreso['horaIngreso']; ?></td>
                            <td><?php echo $ingreso['responsable']; ?></td>
                            <td>
                                <a href="index.php?accion=editar&id=<?php echo $ingreso['id']; ?>">
                                    <button type="button">Editar</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay ingresos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 