<div class="title contenedor">
  <h3><i class="fas fa-address-card"></i> Inscritos</h3>
</div>

<div class="contenedor">
  <div class="form-group">

    <form class="input-group" action="?controller=inscritos&action=search" method="post">
      <input type="text" name="search" placeholder="Buscar Por Nombre/ID" class="form-control" required />
      <input class="btn btn-primary" type="submit" value="Buscar">
    </form>

  </div>
</div>

<div class="d-flex justify-content-end mb-2 contenedor">
  <a class="btn btn-secondary btn-sm" href="?controller=inscritos&action=add">Inscribir</a>
</div>

<div class="table-title contenedor">

  <div class="scroll">
    <table id="table">

      <thead>

        <th>Nombre</th>
        <th>Cédula/ID</th>
        <th class="column-disabled">Colegio</th>
        <th class="column-disabled">Télefono</th>
        <th class="column-disabled">Partido</th>
        <th></th>

      </thead>

      <?php while ($dato = $datos->fetch_object()) : ?>

        <tbody>

          <td class="<?= $dato->ha_votado ?> <?=$dato->condicion?>"><?= $dato->nombre ?> <?= $dato->apellidos ?></td>
          <td class="<?= $dato->ha_votado ?> <?=$dato->condicion?>"><?= $dato->numero_de_identidad ?></td>
          <td class="column-disabled <?= $dato->ha_votado ?> <?=$dato->condicion?>"><?= $dato->colegio_electoral ?></td>
          <td class="column-disabled <?= $dato->ha_votado ?> <?=$dato->condicion?>"><?= $dato->telefono ?></td>
          <td class="column-disabled <?= $dato->ha_votado ?> <?=$dato->condicion?>"><?= $dato->partido_perteneciente ?></td>


          <td class="<?= $dato->ha_votado ?>">
            <form method="POST" action="?controller=inscritos&action=delete">
              <a href="?controller=inscritos&action=view&id=<?= $dato->idpersona ?>"><i class="fas fa-eye"></i></a>

              <?php if (isset($_SESSION['admin'])) : ?>
                <input type="hidden" name="id" value="<?= $dato->idpersona ?>" />
                <button class="btn-del" type="submit"><i class="far fa-trash-alt"></i></button>
              <?php endif; ?>
            </form>
          </td>


        </tbody>

      <?php endwhile; ?>

    </table>
  </div>
</div>