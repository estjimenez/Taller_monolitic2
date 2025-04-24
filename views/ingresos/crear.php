<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ingreso a Salas</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Registro de Ingreso a Salas</h2>
    
    <form method="POST" action="index.php?accion=guardar">
        <div>
            <label>Código Estudiante:</label>
            <input type="text" name="codigoEstudiante" required maxlength="10">
        </div>

        <div>
            <label>Nombre Estudiante:</label>
            <input type="text" name="nombreEstudiante" required maxlength="250">
        </div>

        <div>
            <label>Programa:</label>
            <select name="idPrograma" required>
                <option value="">Seleccione un programa</option>
                <?php foreach($programas as $programa): ?>
                    <option value="<?php echo $programa['id']; ?>">
                        <?php echo $programa['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Sala:</label>
            <select name="idSala" required>
                <option value="">Seleccione una sala</option>
                <?php foreach($salas as $sala): ?>
                    <option value="<?php echo $sala['id']; ?>">
                        <?php echo $sala['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Responsable:</label>
            <select name="idResponsable" required>
                <option value="">Seleccione un responsable</option>
                <?php foreach($responsables as $responsable): ?>
                    <option value="<?php echo $responsable['id']; ?>">
                        <?php echo $responsable['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Registrar Ingreso</button>
    </form>
</body>
</html> 