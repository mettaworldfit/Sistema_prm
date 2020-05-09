<div class="title contenedor">
    <h3><i class="fas fa-vote-yea"></i> Actas JCE</h3>
</div>

<div class="d-flex justify-content-end mb-2 contenedor">
  <a class="btn btn-secondary btn-sm" href="?controller=resultados&action=add">Agregar acta</a>
</div>

<div class="table-title contenedor">
    <div class="scroll">
        <table id="table">
            <thead>

                <th>Colegio</th>
                <th>Partido</th>
                <th class="column-disabled">Votos totales</th>
                <th>fecha</th>
                <th></th>

            </thead>

            <?php while ($dato = $datos->fetch_object()) : ?>
                <tbody>
                    <td>00<?= $dato->colegio ?></td>
                    <td><?= $dato->partido ?></td>
                    <td class="column-disabled"><?= $dato->votos ?></td>
                    <td><?= $dato->fecha ?></td>
                    <td>
                        <form method="POST" action="?controller=resultados&action=delete">
                            <a href="?controller=resultados&action=view&id=<?= $dato->idresultado ?>"><i class="fas fa-eye"></i></a>

                            <input type="hidden" name="id" value="<?= $dato->idresultado ?>" />
                            <button class="btn-del" type="submit"><i class="far fa-trash-alt"></i></button>

                        </form>
                    </td>
                </tbody>

            <?php endwhile; ?>
        </table>
    </div>

</div>