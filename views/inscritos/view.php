<?php $datos = Help::Info_persona($_GET['id']);
while ($dato = $datos->fetch_object()) : ?>

    <div class="title container">
        <h3><i class="far fa-address-card"></i> <?= $dato->nombre ?> <?= $dato->apellidos ?></h3>
    </div>

    <div class="form container">
        <form method="post" action="?controller=inscritos&action=update">
            <div class="row">

                <div class="col-lg-12">

                    <div class="form-group ">
                        <label for="nombre">Nombre</label>
                        <input class="form-control form-control-sm" id="nombre" type="text" name="nombre" maxlegnth="25" value="<?= $dato->nombre ?>" required>
                    </div>


                    <div class="form-group ">
                        <label for="apellidos">Apellidos</label>
                        <input class="form-control form-control-sm" type="text" name="apellidos" maxlegnth="30" value="<?= $dato->apellidos ?>">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="cedula">Número de identidad</label>
                            <input class="form-control form-control-sm" type="text" name="cedula" max="99999999999" value="<?= $dato->numero_de_identidad ?>" required>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="partido">Colegio electoral</label>

                            <select class="form-control form-control-sm" name="colegio" required>
                                <option value="<?= $dato->idmesa ?>" selected><?= $dato->colegio_electoral ?></option>

                                <?php while ($dato1 = $datos2->fetch_object()) { ?>
                                    <option value="<?= $dato1->idmesa ?>"><?= $dato1->colegio_electoral ?> </option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="cedula">Posición del padrón</label>
                            <input class="form-control form-control-sm" type="number" name="posicion" value="<?= $dato->posicion_colegio ?>" required>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="partido">Preferencia política</label>

                            <select class="form-control form-control-sm" name="partido">
                                <option value="<?= $dato->partido_perteneciente ?>"><?= $dato->partido_perteneciente ?></option>
                                <option value="pld">PLD</option>
                                <option value="prm">PRM</option>
                                <option value="">Sin identificar</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="telefono">Télefono</label>
                            <input class="form-control form-control-sm" type="number" name="telefono" value="<?= $dato->telefono ?>">
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="condicion">Condición</label>

                            <select class="form-control form-control-sm" name="condicion" id="">
                                <option value="" selected><?= $dato->condicion ?></option>
                                <option value="">Normal</option>
                                <option value="muerto">Fallecid@</option>
                                <option value="fuera">Fuera del país</option>
                                <option value="enferma">Enferm@</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $dato->idpersona ?>">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                  
                </div> <!-- Col-md-4 -->

            </div> <!-- Row -->
        <?php endwhile; ?>
        </form>
    </div> <!-- Form -->