<?php

require_once './models/colegios.php';
require_once './models/inscritos.php';

class ColegiosController
{

    public function index()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {

            $colegio = new Colegios();
            $datos = $colegio->Total_inscritos_colegio();

            require_once './views/colegios/index.php';
        } else {
            Help::unRegister();
        }
    }

    public function acceso()
    {

        $perfil = $_SESSION['identity']->perfil;
        $acceso = $_SESSION['identity']->acceso;

        if ($perfil = "user" && isset($_SESSION['identity'])) {

            $colegio = new Colegios();
            $datos = $colegio->Restriccion_colegio($acceso);

            require_once './views/colegios/index.php';
        } else {
            Help::unRegister();
        }
    }

    public function delete()
    {
        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {

            if (isset($_POST)) {

                $id = isset($_POST['id']) ? $_POST['id'] : false;

                $colegio = new Colegios();
                $colegio->setId($id);

                $result = $colegio->delete();

                if ($result) {
                    echo "<h3 class='contenedor caption text-center'>Su registro ha sido eliminado</h3>";

                    // redirecionar 
                    echo '<script> function redirect(){ window.location="?controller=colegios&action=index"';
                    echo '} setTimeout("redirect()",1000)';
                    echo '</script>';
                } else {
                    echo "<h3 class='contenedor caption text-center'>Exísten registros, error al eliminar datos</h3>";

                    // redirecionar 
                    echo '<script> function redirect(){ window.location="?controller=colegios&action=index"';
                    echo '} setTimeout("redirect()",1500)';
                    echo '</script>';
                }
            } else {
                echo '<script> window.location.href = "?controller=&action=index"</script>';
            }
        }
    }

    public function search()
    {

        if (isset($_SESSION['identity']) || isset($_SESSION['admin'])) {


            // votaciones
            if (isset($_POST['votacion'])) {


                $inscritos = new Inscritos();

                if (isset($_POST['votar'])) {

                    $id = $_POST['id'];
                    $request = $_POST['votar'];

                    $inscritos->votar($request, $id);
                } else {

                    $id = $_POST['id'];
                    $request = $_POST['cancelar'];

                    $inscritos->votar($request, $id);
                }

                echo "<h3 class='contenedor caption text-center'>Actualización completa</h3>";

                // redirecionar 
                echo "<script> function redirect(){ window.history.back(-4)";
                echo '} setTimeout("redirect()",1400)';
                echo '</script>';
            }

            if (isset($_POST['buscar'])) {

                // Busqueda
                $search = new Colegios();

                $colegio = isset($_POST['colegio']) ? $_POST['colegio'] : false;
                $mesa = isset($_POST['mesa']) ? $_POST['mesa'] : false;
                $query = isset($_POST['search']) ? $_POST['search'] : false;

                $result =  $search->search($query, $mesa);

                if ($result && $result->num_rows > 0) {
                    require_once "./views/colegios/search.php";
                } else {
?>

                    <div class="contenedor caption text-center">
                        <h3>El documento que buscas no existe</h3>
                        <a href="?controller=colegios&action=view&mesa=<?= $colegio ?>" class="btn btn-secondary">Volver</a>
                    </div>
<?php
                }
            }
        }
    }

    public function view()
    {
        $acceso = $_SESSION['identity']->acceso;

        if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

            $db = DataBase::connect(); // Conexión DB

            $colegio = $_GET['mesa'];
            $method = $_GET['action'];

            $pagina = isset($_GET['pag']) ? (int) $_GET['pag'] : 0;

            $por_pagina = 100; // Registros por página

            $inicio = ($pagina > 1) ? ($pagina * $por_pagina) - $por_pagina : 0;

            // Personas inscritas en un colegio
            $registros = $db->query("SELECT SQL_CALC_FOUND_ROWS *FROM personas_inscritas p INNER JOIN  
            mesas_electorales m ON p.idmesa = m.idmesa HAVING m.colegio_electoral = '$colegio' 
            AND p.ha_votado = 'No' ORDER BY p.apellidos LIMIT $inicio,$por_pagina");

            $total_registros = $db->query("SELECT FOUND_ROWS() AS 'total'");
            $total_registros = $total_registros->fetch_object()->total;

            $num_pagina = ceil($total_registros / $por_pagina); // Número de páginas

            require_once './views/colegios/view.php'; // Ventana
        } else {
            Help::unRegister();
        }
    }

    public function votos()
    {
        $acceso = $_SESSION['identity']->acceso;

        if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

            $db = DataBase::connect(); // Conexión DB

            $colegio = $_GET['mesa'];
            $method = $_GET['action'];

            $pagina = isset($_GET['pag']) ? (int) $_GET['pag'] : 0;

            $por_pagina = 50; // Registros por página

            $inicio = ($pagina > 1) ? ($pagina * $por_pagina) - $por_pagina : 0;

            // Personas que han votado en una mesa
            $registros = $db->query("SELECT SQL_CALC_FOUND_ROWS *FROM personas_inscritas p inner join mesas_electorales m on p.idmesa = m.idmesa
            WHERE p.ha_votado = 'Si' AND m.colegio_electoral = '$colegio' LIMIT $inicio,$por_pagina");

            $total_registros = $db->query("SELECT FOUND_ROWS() AS 'total'");
            $total_registros = $total_registros->fetch_object()->total;

            $num_pagina = ceil($total_registros / $por_pagina); // Número de páginas

            require_once './views/colegios/votos.php';
        } else {
            Help::unRegister();
        }
    }
}
