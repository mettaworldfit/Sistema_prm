<div class="title contenedor">
    <h3>
        <?php $partido = $_GET['group']; if($partido == "prm") { ?>
            <i class="fas fa-thumbs-up"></i> <?php echo "Partido revolucionario moderno"?>
        <?php $partido = $_GET['group']; } else if ($partido == "pld") { ?>
            <i class="fas fa-star"></i> <?php echo "Partido de la liberación dominicana"?>
        <?php } else { ?>
                <?php echo "Sin identificar"?>
        <?php }; ?>
    </h3>
</div>

<div class="table-title contenedor">

  <div class="scroll">
    <table id="table">

      <thead>

        <th>Nombre</th>
        <th class="column-disabled">Cédula/ID</th>
        <th>Colegio</th>
        <th class="column-disabled">Télefono</th>
        <th></th>

      </thead>

      <?php $datos = Help::partido($_GET['group']); while ($dato = $datos->fetch_object()) : ?>

        <tbody>

          <td class="<?= $dato->ha_votado ?>"><?= $dato->nombre ?> <?= $dato->apellidos ?></td>
          <td class="column-disabled <?= $dato->ha_votado ?>"><?= $dato->numero_de_identidad ?></td>
          <td class="<?= $dato->ha_votado ?>"><?= $dato->colegio_electoral ?></td>
          <td class="column-disabled <?= $dato->ha_votado ?>"><?= $dato->telefono ?></td>
     
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