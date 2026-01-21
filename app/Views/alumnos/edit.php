<form action="<?= base_url('alumnos/edit/' . $alumno['id']) ?>" method="post">
    <input type="text" name="nombre" placeholder="Nombre" value="<?= $alumno['nombre'] ?>">
    <input type="text" name="apellido" placeholder="Apellido" value="<?= $alumno['apellido'] ?>">
    <input type="text" name="telefono" placeholder="Teléfono" value="<?= $alumno['telefono'] ?>">
    <button type="submit">Guardar</button>
</form>