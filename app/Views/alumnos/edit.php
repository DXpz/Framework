<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border: 1px solid #ddd;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #333;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }
        
        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary {
            background: #333;
            color: white;
        }
        
        .btn-primary:hover {
            background: #555;
        }
        
        .btn-secondary {
            background: #ddd;
            color: #333;
        }
        
        .btn-secondary:hover {
            background: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Alumno</h1>
        <p class="subtitle">ID: <?= $alumno['id'] ?></p>
        
        <form action="<?= base_url('alumnos/edit/' . $alumno['id']) ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?= esc($alumno['nombre']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" value="<?= esc($alumno['apellido']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="<?= esc($alumno['telefono']) ?>" required>
            </div>
            
            <div class="button-group">
                <a href="<?= base_url('alumnos') ?>" class="btn btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</body>
</html>