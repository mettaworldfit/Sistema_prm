<div class="contenedor">
    <div class="form-group">

        <form class="input-group" action="<?= base_url ?>?controller=inscritos&action=search" method="post">
            <input type="text" name="search" placeholder="Buscar Por Nombre/ID" class="form-control" required />
            <input class="btn btn-primary" type="submit" value="Buscar">
        </form>

    </div>
</div> <br>

<div class="title contenedor">
    <h3><i class="fas fa-globe"></i> Panel de control</h3>
</div>

<div class="panel-nav contenedor control-panel d-flex">

    <div class="col-md-3">
        <div class="nav">
            <div class="icon" icon="orange"><a><i class="fas fa-users"></i></a></div>
            <div class="info">
                <a>Total inscritos</a>

                <?php
                $datos = Help::Total_inscritos();
                while ($dato = $datos->fetch_object()) : ?>

                    <strong><?= $dato->id ?></strong>

                <?php endwhile; ?>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="nav">
            <div class="icon" icon="blue"><a href="?controller=home&action=votos&group=prm"><i class="fas fa-thumbs-up"></i></a></div>
            <div class="info">
                <a href="?controller=home&action=votos&group=prm">PRM</a>

                <?php
                $datos = Help::Total_por_partidos("prm");
                while ($dato = $datos->fetch_object()) : ?>

                    <strong><?= $dato->id ?></strong>

                <?php endwhile; ?>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="nav">
            <div class="icon" icon="purple"><a href="?controller=home&action=votos&group=pld"><i class="fas fa-star"></i></a></div>
            <div class="info">
                <a href="?controller=home&action=votos&group=pld">PLD</a>

                <?php
                $datos = Help::Total_por_partidos("pld");
                while ($dato = $datos->fetch_object()) : ?>

                    <strong><?= $dato->id ?></strong>

                <?php endwhile; ?>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="nav">
            <div class="icon" icon="yellow"><a href="?controller=home&action=votos&group=unknow"><i class="fas fa-user-alt-slash"></i></a></div>
            <div class="info">
                <a href="?controller=home&action=votos&group=unknow">Sin identificar</a>

                <?php
                $datos = Help::Total_por_partidos("");
                while ($dato = $datos->fetch_object()) : ?>

                    <strong><?= $dato->id ?></strong>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<div class="contenedor">
    <table>
        <tbody>

            <tr>
                <?php while ($dato = $datos2->fetch_object()) : ?>
                    <td class="detail">Votos (PRM)</td>
                    <td class="important"><?= $dato->total ?></td>
                <?php endwhile; ?>
            </tr>

            <tr>
                <?php while ($dato = $datos3->fetch_object()) : ?>
                    <td class="detail">Votos (PLD)</td>
                    <td class="important"><?= $dato->total ?></td>
                <?php endwhile; ?>
            </tr>
            <tr>
                <?php while ($dato = $datos4->fetch_object()) : ?>
                    <td class="detail">Otros (Sin identificar)</td>
                    <td class="important"><?= $dato->total ?></td>
                <?php endwhile; ?>
            </tr>

        </tbody>

    </table>
</div> <br>

<div class="contenedor">
    <table>
        <tbody>

            <tr>

                <td class="detail">Votos en total</td>
                <td class="important"><?= $total_votos->total ?></td>

            </tr>

            <tr>
                <td class="detail">Han votado %</td>
                <td class="important"><?= $han_votado ?> %</td>
            </tr>

            <tr>
                <td class="detail">No han votado %</td>
                <td class="important"><?= $no_han_votado ?> %</td>
            </tr>

        </tbody>
    </table>
</div> <br>

<div class="table-title contenedor">

    <table id="table">
        <thead>

            <th>Colegio electoral</th>
            <th>Recinto</th>
            <th class="column-disabled">Ubicación</th>
            <th>Votos totales</th>
            <th></th>
        </thead>

        <?php $total = Help::Votos_totales('Si');
        while ($dato = $total->fetch_object()) : ?>

            <tbody>

                <td>00<?= $dato->colegio_electoral ?></td>
                <td><?= $dato->ubicacion ?></td>
                <td class="column-disabled"><?= $dato->recinto ?></td>
                <td><?= $dato->han_votado ?></td>

                <td>
                    <a href="?controller=colegios&action=votos&mesa=<?= $dato->colegio_electoral ?>&pag=1"><i class="fas fa-sign-in-alt"></i></a>
                </td>


            </tbody>
        <?php endwhile; ?>
    </table>

</div>