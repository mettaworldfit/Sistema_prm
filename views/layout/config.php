<div class="title container">
    <h3><i class="fas fa-globe"></i> Configuraciones</h3>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-3 col-config">
            <h4><i class="fas fa-users-cog"></i> Usuarios</h4>
            <ul>
                <li><a class="text-danger" href="?controller=usuarios&action=logout"><i class="fas fa-sign-in-alt"></i> Cerrar sesion</a></li>

            </ul>
        </div>

        <?php if (isset($_SESSION['admin'])) : ?>
            <div class="col-sm-3 col-config">
                <h4><i class="fas fa-user-tie"></i> Administrador</h4>
                <ul>
                    <li><a href="?controller=usuarios&action=add">Agregar usuario</a></li>
                    <li><a href="?controller=usuarios&action=index&pag=1">Usuarios</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['admin'])) : ?>
            <div class="col-sm-3 col-config">
                <h4><i class="fas fa-poll"></i> Votaciones</h4>
                <ul>
                    <li><a href="?controller=resultados&action=index">Registro de actas</a></li>
                    <li><a href="?controller=resultados&action=result">Resultados JCE</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

</div>