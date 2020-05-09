<?php if ($acceso != $_GET['mesa'] && $acceso != "todo") : Help::AccDenied() ?> <?php endif; ?>

<div class="title contenedor">
  <h3>Colegio electoral 00<?= $_GET['mesa'] ?> </h3>
</div>

<div class="contenedor">
  <div class="form-group">

    <form class="input-group" action="?controller=colegios&action=search" method="post">
      <input type="text" name="search" placeholder="Buscar por posición" class="form-control" required>
      <input type="hidden" name="mesa" value="<?php echo $_GET['mesa'] ?>">
      <input type="hidden" name="colegio" value="<?php echo $_GET['mesa'] ?>">
      <input type="hidden" name="buscar">

      <input class="btn btn-primary" type="submit" value="Buscar">
    </form>

  </div>
</div>

<div class="contenedor">
  <table>
    <tbody>

      <tr>
        <?php $result2 = Help::Total_de_partido('prm', $_GET['mesa']);
        while ($dato = $result2->fetch_object()) : ?>
          <td class="detail">Inscritos (PRM)</td>
          <td class="important"><?= $dato->total ?></td>
        <?php endwhile; ?>
      </tr>

      <tr>
        <?php $result2 = Help::Total_de_partido('pld', $_GET['mesa']);
        while ($dato = $result2->fetch_object()) : ?>
          <td class="detail">Inscritos (PLD)</td>
          <td class="important"><?= $dato->total ?></td>
        <?php endwhile; ?>
      </tr>
      <tr>
        <?php $result2 = Help::Total_de_partido('', $_GET['mesa']);
        while ($dato = $result2->fetch_object()) : ?>
          <td class="detail">Otros (Sin identificar)</td>
          <td class="important"><?= $dato->total ?></td>
        <?php endwhile; ?>
      </tr>

    </tbody>
  </table>
</div> <br>

<?php include 'pagination.php'; ?>

<div class="table-title contenedor">
  <!-- <div class="scroll"> -->
  <table id="table">
    <thead>

      <th>N°</th>
      <th>Nombre</th>
      <th class="column-disabled">Cédula/ID</th>
      <th class="column-disabled">Partido</th>
      <th></th>
    </thead>

    <?php while ($dato = $registros->fetch_object()) : ?>

      <tbody>

        <td class="<?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->posicion_colegio ?></td>
        <td class="<?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->nombre ?> <?= $dato->apellidos ?></td>
        <td class="column-disabled <?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->numero_de_identidad ?></td>
        <td class="column-disabled <?= $dato->ha_votado ?> <?= $dato->condicion ?>"><?= $dato->partido_perteneciente ?></td>

        <td class="<?= $dato->ha_votado ?> <?= $dato->condicion ?>">
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