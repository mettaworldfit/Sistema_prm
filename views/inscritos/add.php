<div class="title contenedor">
    <h3><i class="fas fa-user-plus"></i> Inscribir persona</h3>
</div>

<div class="form contenedor">
    <form method="post" action="?controller=inscritos&action=save">
        <div class="row">

            <div class="col-lg-12">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input class="form-control form-control-sm" type="text" id="nombre" name="nombre" maxlength="25" placeholder="Nombre" required>
                </div>


                <div class="form-group ">
                    <label for="apellidos">Apellidos</label>
                    <input class="form-control form-control-sm" type="text" name="apellidos" placeholder="Apellidos" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="cedula">Número de identidad</label>
                        <input class="form-control form-control-sm" type="number" name="cedula" id="cedula" max="99999999999" placeholder="Sin guión" required>
                        
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="partido">Colegio electoral</label>

                        <select class="form-control form-control-sm" name="colegio" required>


                            <?php $perfil = $_SESSION['identity']->perfil;
                            if ($perfil == "user" && isset($_SESSION['identity'])) : ?>
                                <?php $datos = Help::Colegio($_SESSION['identity']->acceso);
                                while ($dato = $datos->fetch_object()) : ?>
                                    <option value="<?= $dato->idmesa ?>">Colegio 00<?php echo $_SESSION['identity']->acceso ?></option>
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) : ?>
                                <?php while ($dato = $datos->fetch_object()) : ?>
                                    <option value="<?= $dato->idmesa ?>">Colegio 00<?= $dato->colegio_electoral ?> </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="cedula">Posición del padrón</label>
                        <input class="form-control form-control-sm" type="number" name="posicion" required>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="partido">Preferencia política</label>

                        <select class="form-control form-control-sm" name="partido">
                            <option value="" selected>Desconocida</option>
                            <option value="pld">PLD</option>
                            <option value="prm">PRM</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="telefono">Télefono</label>
                        <input class="form-control form-control-sm" type="number" name="telefono" placeholder="###" value="">
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="condicion">Condición</label>
                        <select class="form-control form-control-sm" name="condicion" id="">
                            <option value="" selected>Normal</option>
                            <option value="muerto">Fallecid@</option>
                            <option value="fuera">Fuera del país</option>
                            <option value="enferma">Enferm@</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="save">
                <input class="btn btn-primary" type="submit" value="Registrar">
               
            </div> <!-- Col-md-4 -->

        </div> <!-- Row -->
       
    </form>
</div> <!-- Form -->