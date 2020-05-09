<?php $datos = Help::Info_usuario($_GET['id']);
while ($dato = $datos->fetch_object()) : ?>

    <div class="title container">
        <h3><i class="far fa-address-card"></i> <?= $dato->nombre ?> <?= $dato->apellidos ?></h3>
    </div>

    <div class="form container">
        <form method="post" action="?controller=usuarios&action=update">
            <div class="row">

                <div class="col-lg-12">

                    <div class="form-group ">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control form-control-sm" id="nombre" type="text" name="nombre" maxlegnth="25" value="<?= $dato->nombre ?>" required>
                    </div>


                    <div class="form-group ">
                        <label for="apellidos">Apellidos:</label>
                        <input class="form-control form-control-sm" type="text" name="apellidos" maxlegnth="30" value="<?= $dato->apellidos ?>">
                    </div>

                    <div class="form-row">

                        <div class="form-group col-sm-3">
                            <label for="usuario">Usuario:</label>
                            <input class="form-control form-control-sm" type="number" name="usuario" value="<?= $dato->usuario ?>" required>
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="">Estado:</label>

                            <select class="form-control form-control-sm" name="estado">
                                <option value="<?= $dato->estado ?>" selected><?= $dato->estado ?></option>
                                <option value="disabled">Disabled</option>
                                <option value="enabled">Enabled</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="telefono">Télefono:</label>
                            <input class="form-control form-control-sm" type="number" value="<?= $dato->telefono?>" name="telefono">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-sm-6">
                            <label for="">Ocupación:</label>

                            <select class="form-control form-control-sm" name="perfil">
                                <option value="<?= $dato->perfil ?>" selected><?= $dato->perfil ?></option>
                                <option value="user">Usuario</option>
                                <option value="admin">Administrador</option>
                            </select>

                        </div>

                        

                        <div class="form-group col-sm-6">
                            <label for="acceso">Acceso limitado a:</label>
                            <select class="form-control form-control-sm" name="acceso" id="" required>
                               <option value="<?= $dato->acceso ?>" selected><?= $dato->acceso ?></option>
                            <?php endwhile; ?>
                            
                    
                                <?php while ($dato = $datos2->fetch_object()) : ?>
                                    <option value="<?= $dato->colegio_electoral  ?>">Mesa <?= $dato->colegio_electoral ?> <?= $dato->ubicacion ?> </option>
                                <?php endwhile; ?>

                            </select>

                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                    <button class="btn btn-primary" type="submit">Actualizar</button>

                </div> <!-- Col-md-4 -->

            </div> <!-- Row -->
        </form>
    </div> <!-- Form -->