<!DOCTYPE html>
<html>
<head>
    <title>Editar Ingreso</title>
    <meta charset="UTF-8">
    <style>
        .form-group { margin-bottom: 15px; }
        .readonly-info { background: #f5f5f5; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h2>Editar Ingreso</h2>
    
    <form method="POST" action="index.php?accion=actualizar">
        <input type="hidden" name="id" value="<?php echo $ingreso['id']; ?>">

        <div class="form-group">
            <label>Código Estudiante:</label>
            <input type="text" name="codigoEstudiante" 
                   value="<?php echo $ingreso['codigoEstudiante']; ?>" 
                   required maxlength="10">
        </div>

        <div class="form-group">
            <label>Nombre Estudiante:</label>
            <input type="text" name="nombreEstudiante" 
                   value="<?php echo $ingreso['nombreEstudiante']; ?>" 
                   required maxlength="250">
        </div>

        <div class="readonly-info">
            <h3>Información del Ingreso (No editable)</h3>
            <p>Programa: <?php echo $ingreso['programa']; ?></p>
            <p>Sala: <?php echo $ingreso['sala']; ?></p>
            <p>Fecha de Ingreso: <?php echo $ingreso['fechaIngreso']; ?></p>
            <p>Hora de Ingreso: <?php echo $ingreso['horaIngreso']; ?></p>
            <p>Responsable: <?php echo $ingreso['responsable']; ?></p>
            <p>Fecha de Creación: <?php echo $ingreso['created_at']; ?></p>
            <?php if ($ingreso['updated_at']): ?>
                <p>Última Modificación: <?php echo $ingreso['updated_at']; ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <button type="submit">Guardar Cambios</button>
            <a href="index.php"><button type="button">Cancelar</button></a>
        </div>
    </form>
</body>
</html> 