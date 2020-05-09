<?php

/**
 * Web SPA - Sistema de concurrencia electoral
 *
 * @author   Wilmin José Sánchez <wjose260@gmail.com>
 */

require_once './models/home.php';
require_once './models/colegios.php';

class HomeController
{

  public function index()
  {

    if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

      $colegio = new Colegios();

      $datos = $colegio->Han_votado();
      $datos2 = $colegio->Total_votos_por_partido('prm');
      $datos3 = $colegio->Total_votos_por_partido('pld');
      $datos4 = $colegio->Total_votos_por_partido('');

      // Porcentaje de personas que votaron

      $inscritos = Help::Total_inscritos();
      $votos = Help::Cantidad_votos("si");

      $total_inscritos = $inscritos->fetch_object();
      $total_votos = $votos->fetch_object();

      $porc = (int) $total_votos->total / (int) $total_inscritos->id * 100;
      $han_votado = round($porc, 2);

      $porc2 = (1 - (int) $total_votos->total / (int) $total_inscritos->id) * 100;
      $no_han_votado = round($porc2, 2);


      require_once './views/layout/home.php';
    } else {
      Help::unRegister();
    }
  }

  public function config()
  {
    if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

      require_once './views/layout/config.php';
    } else {
      Help::unRegister();
    }
  }

  public function votos()
  {
    if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

      require_once './views/inscritos/partido.php';
    } else {
      Help::unRegister();
    }
  }

  public function denied()
  {
    if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {

      ?>
        <h3 class='contenedor caption text-center'>
          <i class='fas fa-exclamation-circle'></i> Acceso Denegado
        </h3>
      <?php
      
      include "./includes/redirect.php";                // Volver atrás

    } else {
      Help::unRegister();
    }
  }
}
