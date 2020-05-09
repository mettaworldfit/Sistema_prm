<?php

require_once './models/usuarios.php';
require_once './models/colegios.php';

class UsuariosController
{

    public function index()
    {
        if (isset($_SESSION['identity']) || isset($_SESSION['admin'])) {

            $db = DataBase::connect();

            $pagina = isset($_GET['pag']) ? (int) $_GET['pag'] : 0;

            $por_pagina = 10; // Registros por página

            $inicio = ($pagina > 1) ? ($pagina * $por_pagina) - $por_pagina : 0;

            // Usuarios del sistema
            $registros = $db->query("SELECT SQL_CALC_FOUND_ROWS *FROM usuarios LIMIT $inicio,$por_pagina");

            $total_registros = $db->query("SELECT FOUND_ROWS() AS 'total'");
            $total_registros = $total_registros->fetch_object()->total;

            $num_pagina = ceil($total_registros / $por_pagina); // Número de páginas

            require_once "./views/usuarios/index.php";
        }
    }

    public function update()
    {
        if (isset($_SESSION['identity']) || isset($_SESSION['admin'])) {

            if (isset($_POST)) {

                $id = isset($_POST['id']) ? $_POST['id'] : false;

                $nombre1= isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $nombre = ucwords($nombre1); 
                $apellidos1 = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $apellidos = ucwords($apellidos1); 

                $username = isset($_POST['usuario']) ? $_POST['usuario'] : false;
                $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
                $acceso = isset($_POST['acceso']) ? $_POST['acceso'] : false;
                $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;

                if ($nombre && $perfil && $username) {
                    // Insertar datos

                    $usuarios = new Usuarios();

                    if($perfil == "admin"){
                        $usuarios->setAcceso("todo");
                    } else if ($perfil == "user") {
                        $usuarios->setAcceso($acceso);
                    }

                    $usuarios->setNombre($nombre);
                    $usuarios->setApellidos($apellidos);
                    $usuarios->setUsuario($username);
                    $usuarios->setPerfil($perfil);
                    $usuarios->setTelefono($telefono);
                   

                    $result = $usuarios->update($id);

                    if($result) {
                        header('Location:' . getenv('HTTP_REFERER'));

                    } else {

                        ?>
                        <div class="contenedor caption text-center">
                          <h3>El usuario ya existe</h3>
                          <a href="?controller=usuarios&action=view&id=<?= $id?>" class="btn btn-secondary">Volver</a>
                      </div>
                      <?php
                    }

                } else {
                   
                    ?>
                      <div class="contenedor caption text-center">
                        <h3>Ha ocurrido un error</h3>
                        <a href="?controller=usuarios&action=view&id=<?= $id?>" class="btn btn-secondary">Volver</a>
                    </div>
                    <?php
                }

            } else {
                echo '<script> window.location.href = "?controller=home&action=index"</script>';
            }
        }
    }

    public function save()
    {

        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {

            if (isset($_POST)) {

                $nombre1= isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $nombre = ucwords($nombre1); 
                $apellidos1 = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $apellidos = ucwords($apellidos1); 
            
                $username = isset($_POST['usuario']) ? $_POST['usuario'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
                $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
                $acceso = isset($_POST['acceso']) ? $_POST['acceso'] : false;
                $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;

                if ($nombre && $username && $password && $perfil) {

                    // Insertar datos
                    $usuario = new Usuarios();

                    if($perfil == "admin"){
                        $usuario->setAcceso("todo");
                    } else if ($perfil == "user") {
                        $usuario->setAcceso($acceso);
                    }

                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setUsuario($username);
                    $usuario->setPassword($password);
                    $usuario->setPerfil($perfil);
                    $usuario->setTelefono($telefono);

                    $result = $usuario->save();

                    if ($result) {
                        echo "<h3 class='contenedor caption text-center'><i class='far fa-smile-beam'></i> Registro exítoso</h3>";

                        // redirecionar 
                        echo '<script> function redirect(){ window.location="?controller=usuarios&action=add"';
                        echo '} setTimeout("redirect()",1500)';
                        echo '</script>';
                    } else {
                        echo "<h3 class='contenedor caption text-center'>Este usuario ya está ocupada</h3>";

                        // redirecionar 
                        echo '<script> function redirect(){ window.location="?controller=usuarios&action=add"';
                        echo '} setTimeout("redirect()",2500)';
                        echo '</script>';
                    }
                }
            }
        }
    }

    public function delete()
    {
        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {

            if (isset($_POST)) {

                $usuarios = new Usuarios();

                $id = isset($_POST['id']) ? $_POST['id'] : false;
                $usuarios->setId($id);

                $result = $usuarios->delete();

                if ($result) {
                    echo "<h3 class='contenedor caption text-center'>Su registro ha sido eliminado</h3>";

                    // redirecionar
                    echo '<script> function redirect(){ window.location="?controller=usuarios&action=index"';
                    echo '} setTimeout("redirect()",1300)';
                    echo '</script>';
                }
            } else {
                echo "<h3 class='contenedor caption text-center'>Ha ocurrido un error</h3>";

                    // redirecionar
                    echo '<script> function redirect(){ window.location="?controller=usuarios&action=index"';
                    echo '} setTimeout("redirect()",1300)';
                    echo '</script>';
            }
        }
    }

    public function view()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {


            $colegios = new Colegios();
            $datos2 = $colegios->showAll();

            require_once "./views/usuarios/view.php";
        } else {
            Help::unRegister();
        }
    }



    public function add()
    {
        if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

            $colegios = new Colegios();
            $datos = $colegios->getAll('mesas_electorales');

            require_once './views/usuarios/add.php';
        } else {
            Help::unRegister();
        }
    }

    public function login()
    {
        if (!isset($_SESSION['identity']) && !isset($_SESSION['admin'])) {

            require_once './views/login/admin.php';
        } else {
            Help::redirect();
        }

        // Recivir los datos

        $username = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;

        $usuario = new Usuarios();

        if ($username && $password) {

            $usuario->setUsuario($username);
            $usuario->setPassword($password);

            $identity = $usuario->login();

            if ($identity && is_object($identity)) {

                $perfil = $identity->perfil;
                $_SESSION['identity'] = $identity;

                if ($perfil == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['login'] = "failed";
            }
        } else {
            $_SESSION['login'] = "error";
        }
    }

    public function logout()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }

        echo '<script>window.location="' . base_url . '?controller=usuarios&action=login"</script>';
    }
}
