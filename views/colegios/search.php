<div class="title contenedor">
    <h3><i class="fas fa-search"></i> Resultado</h3>
</div>

<div class="d-flex justify-content-end mb-2 contenedor">
    <a href="?controller=colegios&action=view&mesa=<?= $mesa ?>" class="btn-sm btn-secondary">Volver</a>
</div>

<div class="table-title container">
    <div class="scroll">
        <table id="table">

            <thead>
                <th>N°</th>
                <th>Nombre</th>
                <th class="column-disabled">Cédula/ID</th>
                <th class="column-disabled">Partido</th>
                <th></th>
            </thead>

            <?php while ($dato = $result->fetch_object()) : ?>

                <tbody>
                    <td class="<?= $dato->ha_votado ?>"><?= $dato->posicion_colegio ?></td>
                    <td class="<?= $dato->ha_votado ?>"><?= $dato->nombre ?> <?= $dato->apellidos ?></td>
                    <td class="column-disabled <?= $dato->ha_votado ?>"><?= $dato->numero_de_identidad ?></td>
                    <td class="column-disabled <?= $dato->ha_votado ?>"><?= $dato->partido_perteneciente ?></td>


                    <td class="<?= $dato->ha_votado ?>">
                        <div class="row">
                            <form class="pr-1 <?= $dato->ha_votado ?>" method="POST" action="?controller=colegios&action=search">
                                <input type="hidden" name="votacion">
                                <input type="hidden" name="votar" value="Si">
                                <input type="hidden" name="id" value="<?= $dato->idpersona ?>">
                                <button class="btn-voto" type="submit"><i class="fas fa-vote-yea"></i></button>

                            </form>

                            <form class="pr-1" method="POST" action="?controller=colegios&action=search">
                                <input type="hidden" name="votacion">
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
    </div>
</div>


<div class="contenedor caption text-center">
    <h3>El nombre o documento que buscas no existe</h3>
    <a href="?controller=colegios&action=view&mesa=<?php echo $mesa ?>" class="btn btn-secondary">Volver</a>
</div>