<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($alumnos as $alumno): ?>
        <tr>
            <td><?= $alumno['id'] ?></td>
            <td><?= $alumno['nombre'] ?></td>
            <td><?= $alumno['apellido'] ?></td>
            <td><?= $alumno['telefono'] ?></td>
            <td><a href="<?= base_url('alumnos/edit/' . $alumno['id']) ?>">Editar</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="<?= base_url('alumnos/create') ?>">
    <button>Crear alumno</button>
</a>