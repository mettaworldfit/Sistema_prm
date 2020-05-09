<?php

require_once "./models/resultados.php";
require_once "./models/colegios.php";

class ResultadosController
{
    public function index()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {
            $resultado = new Resultados();
            $datos = $resultado->showAll();

            require_once './views/resultados/index.php';
        } else {
            Help::AccDenied();
        }
    }

    public function add()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {

            $colegios = new Colegios();
            $datos = $colegios->showAll();

            require_once './views/resultados/add.php';
        } else {
            Help::AccDenied();
        }
    }

    public function save()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {

            if (isset($_POST)) {

                $partido = isset($_POST['partido']) ? $_POST['partido'] : false;
                $colegio = isset($_POST['colegio']) ? $_POST['colegio'] : false;
                $votos = isset($_POST['votos']) ? $_POST['votos'] : false;
              
                if ($partido && $votos && $colegio) {
                    // Insertar datos
                    $resultado = new Resultados();

                    $resultado->setPartido($partido);
                    $resultado->setMesa($colegio);
                    $resultado->setVotos($votos);
                

                    $result = $resultado->save();

                    if ($result) {
                        echo "<h3 class='contenedor caption text-center'><i class='far fa-smile-beam'></i> Registro exítoso</h3>";

                        // redirecionar 
                        echo '<script> function redirect(){ window.location="?controller=resultados&action=add"';
                        echo '} setTimeout("redirect()",1500)';
                        echo '</script>';
                    }
                }
            } else {
                echo '<script> window.location.href = "?controller=home&action=index"</script>';
            }
        } else {
            Help::AccDenied();
        }
    }

    public function delete()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {

            if (isset($_POST)) {

                $id = isset($_POST['id']) ? $_POST['id'] : false;

                $resultado = new Resultados();

                $resultado->setId($id);

                $result = $resultado->delete();

                if ($result) {
                    echo "<h3 class='contenedor caption text-center'>Su registro ha sido eliminado</h3>";

                    // redirecionar
                    echo '<script> function redirect(){ window.location="?controller=resultados&action=index"';
                    echo '} setTimeout("redirect()",1300)';
                    echo '</script>';
                }
            } else {
                echo '<script> window.location.href = "?controller=home&action=index"</script>';
            }
        } else {
            Help::AccDenied();
        }
    }

    public function update()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {
        } else {
            Help::AccDenied();
        }
    }

    public function result()
    {
        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {

            $colegio = new Colegios();

            $datos = $colegio->Han_votado();
            $datos2 = $colegio->Total_votos_por_partido('prm');
            $datos3 = $colegio->Total_votos_por_partido('pld');

            // Porcentaje de personas que votaron JCE [Primer boletín]

            $inscritos = Help::Total_inscritos();
            $votos = Help::JCE_votos();

            $total_inscritos = $inscritos->fetch_object();
            $total_votos = $votos->fetch_object();

            $porc = (int) $total_votos->total / (int) $total_inscritos->id * 100;
            $han_votado = round($porc, 2);

            $porc2 = (1 - (int) $total_votos->total / (int) $total_inscritos->id) * 100;
            $no_han_votado = round($porc2, 2);


            require_once "./views/resultados/result.php";
        } else {
            Help::AccDenied();
        }
    }
}
