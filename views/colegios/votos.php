<?php if ($acceso != $_GET['mesa'] && $acceso != "todo") : Help::AccDenied() ?> <?php endif; ?>

<div class="title contenedor">
  <h3>Colegio electoral 00<?= $_GET['mesa'] ?> </h3>
</div>

<div class="contenedor">
  <table>
    <tbody>

      <tr>
        <?php $datos = Help::Total_partido_colegio('prm', $_GET['mesa']);
        while ($dato = $datos->fetch_object()) : ?>
          <td class="detail">Votos (PRM)</td>
          <td class="important"><?= $dato->total ?></td>
        <?php endwhile; ?>
      </tr>

      <tr>
        <?php $datos = Help::Total_partido_colegio('pld', $_GET['mesa']);
        while ($dato = $datos->fetch_object()) : ?>
          <td class="detail">Votos (PLD)</td>
          <td class="important"><?= $dato->total ?></td>
        <?php endwhile; ?>
      </tr>
      <tr>
        <?php $datos = Help::Total_partido_colegio('', $_GET['mesa']);
        while ($dato = $datos->fetch_object()) : ?>
          <td class="detail">Otros (Sin identificar)</td>
          <td class="important"><?= $dato->total ?></td>
        <?php endwhile; ?>
      </tr>

    </tbody>
  </table>
</div> <br>

<?php include 'pagination.php'; ?>
 

<div class="table-title contenedor">

  <table id="table">
    <thead>

      <th>N°</th>
      <th>Nombre</th>
      <th>Cédula/ID</th>
      <th>Partido</th>
      <th></th>
    </thead>

    <?php while ($dato = $registros->fetch_object()) : ?>

      <tbody>

        <td class="<?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->posicion_colegio ?> </td>
        <td class="<?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->nombre ?> <?= $dato->apellidos ?></td>
        <td class="column-disabled <?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->numero_de_identidad ?></td>
        <td class="column-disabled <?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->partido_perteneciente ?></td>

        <td class="<?= $dato->ha_votado ?>">
          <div class="row">

            <form class="pr-1 <?= $dato->ha_votado ?>" method="POST" action="?controller=inscritos&action=voto">
              <input type="hidden" name="votar" value="Si">
              <input type="hidden" name="id" value="<?= $dato->idpersona ?>">
              <button class="btn-voto" type="submit"><i class="fas fa-vote-yea"></i></button>

            </form>

            <form class="pr-1" method="POST" action="?controller=inscritos&action=voto">
              <input type="hidden" name="cancelar" value="No">
              <input type="hidden" name="id" value="<?= $dato->idpersona ?>">
              <button class="btn-del" type="submit"><i class="fas fa-vote-yea"></i></button>
            </form>

            <a class="pr-1" href="?controller=inscritos&action=view&id=<?= $dato->idpersona ?>"><i class="fas fa-eye"></i></a>

          </div>
        </td>

      </tbody>
    <?php endwhile; ?>

  </table>
  <br>

  <?php include 'pagination.php'; ?>
 
</div>