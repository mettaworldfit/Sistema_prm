
    <section id="sesion">
    
        <form method="post" action="?controller=usuarios&action=login" id="login">
        <h3>Iniciar sesión</h3> <br>

        <img class="logo-login" src="<?=base_url?>public/img/prm.ico" width="120" height="120" alt="">

            <div class="form-group">
                <input class="form-control" type="text" name="usuario" placeholder="Número de identidad">
                </div>

                <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Contraseña">
                </div>

            <button class="btn btn-primary">Inicial sesion</button>
        </form>        

    </section>
