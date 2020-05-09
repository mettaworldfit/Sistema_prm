<div class="title contenedor">
  <h3><i class="fas fa-chalkboard-teacher"></i> Colegios electorales</h3>
</div>

<div class="table-title contenedor">

    <table id="table">
      <thead>

        <th>Colegio electoral</th>
        <th class="column-disabled">Recinto</th>
        <th>Ubicación</th>
        <th>Total inscritos</th>
        <th></th>
      </thead>

      <?php while ($dato = $datos->fetch_object()) : ?>

        <tbody>

          <td>00<?= $dato->colegio ?></td>
          <td class="column-disabled"><?= $dato->recinto ?></td>
          <td><?= $dato->ubicacion ?></td>
          <td><?= $dato->total ?></td>

         
            <td>
              <a href="?controller=colegios&action=view&mesa=<?= $dato->colegio ?>&pag=1"><i class="fas fa-sign-in-alt"></i></a>              
            </td>

        </tbody>

      <?php endwhile; ?>
    </table>
</div>