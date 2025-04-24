<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ingreso - Salas de Cómputo</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .formulario { max-width: 500px; margin: 0 auto; }
        .campo { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .exito { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="formulario">
        <h2>Registro de Ingreso a Salas de Cómputo</h2>
        <form method="POST" action="index.php?action=procesarRegistro">
            <div class="campo">
                <label>Código del Estudiante:</label>
                <input type="text" name="codigo" required maxlength="10">
            </div>
            
            <div class="campo">
                <label>Nombre del Estudiante:</label>
                <input type="text" name="nombre" required maxlength="250">
            </div>
            
            <div class="campo">
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
            
            <div class="campo">
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
            
            <div class="campo">
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
    </div>
</body>
</html> 