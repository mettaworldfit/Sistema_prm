<div class="title contenedor">
    <h3><i class="fas fa-sticky-note"></i> Agregar resultado</h3>
</div>

<div class="form contenedor">
    <form method="post" action="?controller=resultados&action=save">
        <div class="row">

            <div class="col-sm-12">
                <div class="form-row">

                    <div class="form-group col-sm-3">
                        <label for="partido">Partido</label>

                        <select class="form-control form-control-sm" name="partido">
                            <option value="" selected>Elegir</option>
                            <option value="pld">PLD</option>
                            <option value="prm">PRM</option>
                            <option value="prsc">PRSC</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="partido">Colegio electoral</label>

                        <select class="form-control form-control-sm" name="colegio" required>

                            <?php if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) : ?> 
                                <?php while ($dato = $datos->fetch_object()) : ?>
                                    <option value="<?= $dato->idmesa ?>">Colegio 00<?= $dato->colegio_electoral ?> </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="votos">Votos totales</label>
                        <input class="form-control form-control-sm" type="number" name="votos" placeholder="Votos totales" required>
                    </div>

                </div>
            </div>

        </div> <!-- Row -->
        <input class="btn btn-primary" type="submit" value="Registrar">
    </form>
</div> <!-- Form -->