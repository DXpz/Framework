<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
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
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border: 1px solid #ddd;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }
        
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
        }
        
        .info {
            color: #666;
            font-size: 14px;
        }
        
        .btn {
            background: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            background: #555;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th {
            background: #333;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: normal;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        
        tr:hover {
            background-color: #f9f9f9;
        }
        
        .btn-edit {
            background: #666;
            color: white;
            padding: 6px 15px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-edit:hover {
            background: #888;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Alumnos</h1>
        
        <div class="header-actions">
            <div class="info">
                Total: <?= count($alumnos) ?> alumnos
            </div>
            <a href="<?= base_url('alumnos/create') ?>" class="btn">
                Agregar Nuevo Alumno
            </a>
        </div>
        
        <?php if (empty($alumnos)): ?>
            <div class="empty-state">
                <h3>No hay alumnos registrados</h3>
                <p>Comienza agregando tu primer alumno</p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?= $alumno['id'] ?></td>
                            <td><?= esc($alumno['nombre']) ?></td>
                            <td><?= esc($alumno['apellido']) ?></td>
                            <td><?= esc($alumno['telefono']) ?></td>
                            <td>
                                <a href="<?= base_url('alumnos/edit/' . $alumno['id']) ?>" class="btn-edit">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>