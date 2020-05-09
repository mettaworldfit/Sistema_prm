<div class="title contenedor">
  <h3><i class="fas fa-user"></i> Usuarios</h3>
</div>



<div class="table-title contenedor">

  <div class="scroll">
    <table id="table">

      <thead>

        <th>Nombre</th>
        <th>Usuario</th>
        <th class="column-disabled">télefono</th>
        <th>Acceso</th>
        <th></th>

      </thead>

      <?php while ($dato = $registros->fetch_object()) : ?>

        <tbody>

          <td><?= $dato->nombre ?> <?= $dato->apellidos ?></td>
          <td><?= $dato->usuario ?></td>
          <td class="column-disabled"><?= $dato->telefono ?></td>
          <td><?= $dato->acceso ?></td>

          <td>
            <form action="?controller=usuarios&action=delete" method="post">
              <a href="?controller=usuarios&action=view&id=<?= $dato->idusuario ?>"><i class="fas fa-user-edit"></i></a>

              <input type="hidden" name="id" value="<?= $dato->idusuario ?>" />
              <button class="btn-del" type="submit"><i class="far fa-trash-alt"></i></button>
            </form>
          </td>
        </tbody>

      <?php endwhile; ?>

    </table>
  </div>
</div>