<?php

/**
 * Web SPA - Sistema de concurrencia electoral
 *
 * @author   Wilmin José Sánchez <wjose260@gmail.com>
 */

require_once './models/inscritos.php';
require_once './models/colegios.php';

class InscritosController
{

    public function index()
    {

        if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) {

            $db = DataBase::connect(); // Conexión DB

            $controller = $_GET['controller'];
            $method = $_GET['action'];

            $pagina = isset($_GET['pag']) ? (int) $_GET['pag'] : 0;

            $por_pagina = 1200; // Registros por página

            $inicio = ($pagina > 1) ? ($pagina * $por_pagina) - $por_pagina : 0;

            // Personas inscritas en un colegio
            $registros = $db->query("SELECT SQL_CALC_FOUND_ROWS *FROM personas_inscritas p INNER JOIN  
            mesas_electorales m ON p.idmesa = m.idmesa ORDER BY p.apellidos ASC LIMIT $inicio,$por_pagina");

            $total_registros = $db->query("SELECT FOUND_ROWS() AS 'total'");
            $total_registros = $total_registros->fetch_object()->total;

            $num_pagina = ceil($total_registros / $por_pagina); // Número de páginas

            require_once './views/inscritos/index.php';
        } else {
            Help::unRegister();
        }
    }

    public function add()
    {
        if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

            $colegios = new Colegios();
            $datos = $colegios->showAll();

            require_once './views/inscritos/add.php';
        } else {
            Help::unRegister();
        }
    }

    public function update()
    {
        if (isset($_SESSION['identity']) || isset($_SESSION['admin'])) {

            if (isset($_POST)) {

                $nombre1 = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $nombre = ucwords($nombre1);
                $apellidos1 = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $apellidos = ucwords($apellidos1);

                $id = isset($_POST['id']) ? $_POST['id'] : false;
                $posicion = isset($_POST['posicion']) ? $_POST['posicion'] : false;
                $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : false;
                $colegio = isset($_POST['colegio']) ? $_POST['colegio'] : false;
                $partido = isset($_POST['partido']) ? $_POST['partido'] : false;
                $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
                $condicion = isset($_POST['condicion']) ? $_POST['condicion'] : false;

                if ($nombre && $apellidos && $cedula && $colegio && $posicion) {
                    // Insertar datos

                    $method = new Inscritos();

                    $method->setPosicion($_POST['posicion']);
                    $method->setNombre(ucwords($_POST['nombre']));
                    $method->setApellidos(ucwords($_POST['apellidos']));
                    $method->setCedula($_POST['cedula']);
                    $method->setMesa($_POST['colegio']);
                    $method->setPartido($_POST['partido']);
                    $method->setTelefono($_POST['telefono']);
                    $method->setCondicion($_POST['condicion']);

                    $result = $method->update($id);

                    if ($result) {
                        header('Location:' . getenv('HTTP_REFERER'));
                    } else {
                      ?>
                        <div class="contenedor caption text-center">
                        <h3> <i class='fas fa-exclamation-circle text-danger'></i> El número de identidad ya existe</h3>
                        </div>
                    <?php

                    include "./includes/redirect.php";         // Volver atrás
                    }
                } else {
                    ?>
                    <div class="contenedor caption text-center">
                        <h3>Ha ocurrido un error</h3>
                        <a href="?controller=inscritos&action=view&id=<?= $id ?>" class="btn btn-secondary">Volver</a>
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

        if (isset($_SESSION['identity']) || isset($_SESSION['admin'])) {

            if (isset($_POST['save'])) {

                $result1 = Help::Verificar_cedula($_POST['cedula']);
                $datos1 = $result1->fetch_object();
                $identity_verify = $datos1->total;

            if ($identity_verify == 0) {                   // Verificar si el número de identidad existe

                $result = Help::Verificar_posicion($_POST['colegio'], $_POST['posicion']);
                $datos = $result->fetch_object();
                $position_verify = $datos->total;

                if($position_verify == 0) :                // Verificar si la posición existe en la mesa 
                    if($_POST['posicion'] != 0):
                       
                            $method = new Inscritos();

                            $method->setPosicion($_POST['posicion']);
                            $method->setNombre(ucwords($_POST['nombre']));
                            $method->setApellidos(ucwords($_POST['apellidos']));
                            $method->setCedula($_POST['cedula']);
                            $method->setMesa($_POST['colegio']);
                            $method->setPartido($_POST['partido']);
                            $method->setTelefono($_POST['telefono']);
                            $method->setCondicion($_POST['condicion']);
    
                            $result = $method->save();
    
                            if ($result) {
                               
                                ?> <div class='contenedor text-center caption'><h3><i class='far fa-smile-beam text-success'></i> Registro exítoso</h3></div> <?php
                            };

                            include "./includes/redirect.php";         // Volver atrás
                        
                    else:
                        ?>
                        <div class='contenedor text-center caption'>
                        <h3><i class='fas fa-exclamation-circle text-danger'></i> Posición no permitida</h3>
                        <p>Verificar que la posición no contega un valor nulo</p>
                        </div>
                        <?php

                         include "./includes/redirect.php";         // Volver atrás
                    endif;
                else:
                 
                   ?> <h3 class='contenedor caption text-center'><i class='fas fa-exclamation-circle text-danger'></i>  Posición de padrón ocupada</h3> <?php
                 
                    include "./includes/redirect.php";         // Volver atrás

                endif;

            } else {
                 
                ?><h3 class='contenedor caption text-center'><i class='fas fa-exclamation-circle text-danger'></i> El número de identidad electoral ya existe !</h3><?php
                                        
                include "./includes/redirect.php";            // Volver atrás
            }

            }         
       } 

    }

    public function delete()
    {
        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {

            if (isset($_POST['id'])) {

                $method = new Inscritos();

                $id = isset($_POST['id']) ? $_POST['id'] : false;
                $method->setId($id);

                $result = $method->delete();

                if ($result) {
                    ?> <h3 class='contenedor caption text-center'>Su registro ha sido eliminado</h3> <?

                    // redirecionar
                    echo '<script> function redirect(){ window.location="?controller=home&action=index } setTimeout("redirect()",1300) </script>';
                }

            } 
        }
    }

    public function search()
    {
        if (isset($_SESSION['identity']) || isset($_SESSION['admin'])) {

            if (isset($_POST['search'])) {

                $search = new Inscritos();
                $search->setQuery($_POST['search']);

                $result = $search->search();

                if ($result && $result->num_rows > 0) {

                ?>
                    <div class="title contenedor">
                        <h3><i class="fas fa-search"></i> Resultado</h3>
                    </div>

                    <div class="d-flex justify-content-end mb-2 container">
                        <a href="?controller=inscritos&action=index" class="btn-sm btn-secondary">Volver</a>
                    </div>

                    <div class="table-title contenedor">
                        <div class="scroll">
                            <table id="table">
                                <thead>

                                    <th>Nombre</th>
                                    <th>Cédula/ID</th>
                                    <th>Colegio</th>
                                    <th class="column-disabled">Partido</th>
                                    <th></th>
                                </thead>

                                <?php while ($dato = $result->fetch_object()) : ?>

                                    <tbody>

                                        <td class="<?= $dato->ha_votado ?>"><?= $dato->nombre ?> <?= $dato->apellidos ?></td>
                                        <td class="<?= $dato->ha_votado ?>"><?= $dato->numero_de_identidad ?></td>
                                        <td class="<?= $dato->ha_votado ?>"><?= $dato->colegio_electoral ?></td>
                                        <td class="column-disabled <?= $dato->ha_votado ?>"><?= $dato->partido_perteneciente ?></td>


                                        <td class="<?= $dato->ha_votado ?>">
                                            <form method="POST" action="?controller=inscritos&action=delete">
                                                <a href="?controller=inscritos&action=view&id=<?= $dato->idpersona ?>"><i class="fas fa-eye"></i></a>

                                                <?php if (isset($_SESSION['admin'])) : ?>
                                                    <input type="hidden" name="id" id="id" value="<?= $dato->idpersona ?>" />
                                                    <button class="btn-del" type="submit"><i class="far fa-trash-alt"></i></button>
                                                <?php endif; ?>
                                            </form>
                                        </td>

                                    </tbody>

                                <?php endwhile; ?>

                            </table>
                        </div>
                    </div>

                <?php
                } else {

                ?>

                    <div class="contenedor caption text-center">
                        <h3>El nombre o documento que buscas no existe</h3>
                        <a href="?controller=inscritos&action=index" class="btn btn-secondary">Volver</a>
                    </div>
<?php
                }
            }
        }
    }

    public function view()
    {
        if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

            $colegios = new Colegios();
            $datos2 = $colegios->getAll('mesas_electorales');

            require_once "./views/inscritos/view.php";
        } else {
            Help::unRegister();
        }
    }

    public function voto()
    {
        if (isset($_SESSION['identity']) || isset($_SESSION['admin'])) {

            if (isset($_POST)) {

                $inscritos = new Inscritos();

                if (isset($_POST['votar'])) {

                    $id = $_POST['id'];
                    $request = $_POST['votar'];

                    $inscritos->votar($request, $id);

                    ?> <div class='contenedor text-center caption'><h3><i class='far fa-smile-beam text-success'></i> Voto registado</h3></div> <?php
                    include "./includes/redirect.php";            // Volver atrás

                } else {

                    $id = $_POST['id'];
                    $request = $_POST['cancelar'];

                    $inscritos->votar($request, $id);

                    ?> <div class='contenedor text-center caption'><h3><i class='far fa-smile-beam text-danger'></i> Voto Anulado</h3></div> <?php
                    include "./includes/redirect.php";            // Volver atrás
                }
             
               
            }
        }
    }
}
