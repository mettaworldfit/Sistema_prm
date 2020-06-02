<div class="title contenedor">
    <h3><i class="fas fa-vote-yea"></i> Resultados JCE</h3>
</div>

<div class="form">
    <div class="contenedor">
        <table>
            <tbody>

                <tr>
                    <?php $datos = Help::JCE_votos_partido("prm");
                    while ($dato = $datos->fetch_object()) : ?>
                        <td class="detail">PRM y Aliados</td>
                        <td class="important"><?= $dato->total  ?></td>
                    <?php endwhile; ?>
                </tr>

                <tr>
                    <?php $datos = Help::JCE_votos_partido("pld");
                    while ($dato = $datos->fetch_object()) : ?>
                        <td class="detail">PLD y Aliados</td>
                        <td class="important"><?= $dato->total ?></td>
                    <?php endwhile; ?>
                </tr>

                <tr>
                    <?php $datos = Help::JCE_votos_partido("prsc");
                    while ($dato = $datos->fetch_object()) : ?>
                        <td class="detail">PRSC</td>
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
                    <td class="detail">Total inscritos</td>
                    <td class="important"><?= $total_inscritos->id ?></td>
                </tr>

                <tr>
                    <?php $datos = Help::JCE_votos();
                    while ($dato = $datos->fetch_object()) : ?>
                        <td class="detail">Votos en total</td>
                        <td class="important"><?= $dato->total  ?></td>
                    <?php endwhile; ?>
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
    </div> 
</div>