<div class="title contenedor">
    <h3><i class="fas fa-user"></i> Agregar nuevo usuario</h3>
</div>

<div class="form"> 
<form method="post" action="?controller=usuarios&action=save" class="contenedor">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input class="form-control form-control-sm" type="text" name="nombre" required>
    </div>


    <div class="form-group ">
        <label for="Apellidos">Apellidos:</label>
        <input class="form-control form-control-sm" type="text" name="apellidos">
    </div>

    <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input class="form-control form-control-sm" type="text" name="usuario" placeholder="Número de identidad" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input class="form-control form-control-sm" type="password" maxlength="15" name="password" required>
    </div>

    <div class="form-group">
        <label for="perfil">Ocupación:</label>
        <select class="form-control form-control-sm" name="perfil" id="" required>
            <option value="" selected>Elegir</option>
            <option value="admin">Administrador</option>
            <option value="user">Usuario</option>
        </select>
    </div>

    <div class="form-group">
        <label for="acceso">Acceso limitado a:</label>
        <select class="form-control form-control-sm" name="acceso" id="">
            <option value="" selected>Elegir</option>
            
            <?php while ($dato = $datos->fetch_object()) : ?>
                <option value="<?= $dato->colegio_electoral  ?>">Mesa <?= $dato->colegio_electoral ?> <?= $dato->ubicacion ?> </option>
            <?php endwhile; ?>

        </select>
    </div>

    <input class="btn btn-primary" type="submit" value="Registrar">
</form>
</div>  