<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Serie 102</title>

    <link rel="shortcut icon" href="<?= base_url ?>/public/img/prm.ico" type="image/x-icon">
    <?php if (!isset($_SESSION['admin']) || !isset($_SESSION['identity'])) : ?>
        <link rel="stylesheet" href="<?= base_url ?>/public/login.css">
    <?php endif; ?>

    <?php if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) : ?>
        <link rel="stylesheet" href="<?= base_url ?>/public/style.css">
    <?php endif; ?>

    <script src="<?= base_url ?>/public/jquery/jquery.js" type="text/javascript"></script>
    <script src="<?= base_url ?>/public/scripts.js" text="text/javascript"></script>

    <!-- Font-Awesome -->

    <link rel="stylesheet" href="<?= base_url ?>/public/font-awesome/css/all.min.css">
    <script src="<?= base_url ?>/public/font-awesome/js/all.min.js" text="text/javascript"></script>

    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:400,700|PT+Sans:400,700|Cabin&display=swap" rel="stylesheet">

    <!-- jquery-vegas -->

    <?php if (!isset($_SESSION['admin']) && !isset($_SESSION['identity'])) : ?>

        <link rel="stylesheet" href="<?= base_url ?>public/jquery-vegas/css/vegas.min.css" type="text/css">
        <script src="<?= base_url ?>public/jquery-vegas/js/vegas.min.js" type="text/javascript"></script>
        <script src="<?= base_url ?>public/jquery-vegas/js/main.js" type="text/javascript"></script>

    <?php endif; ?>

    <!-- Bootstrap4 -->

    <script src="<?= base_url ?>/public/bootstrap4/js/popper.min.js" type="text/javascript"></script>
    <script src="<?= base_url ?>/public/bootstrap4/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?= base_url ?>/public/bootstrap4/css/bootstrap.min.css">

    <!-- Jquery form validator -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
</head>

<body>

    <?php if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) : ?>

        <div class="contenido">
            <header class="site-header contenedor clearfix ">
                <div class="logo">
                  <a href="<?=base_url?>"><h2><i class="fas fa-user"></i> <?= $_SESSION['identity']->nombre ?></h2></a>  
                </div>

                <div class="menu-movil">
                    <div class="menu">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                </div>

                <nav class="site-nav clearfix">
                    <ul>
                        <li><a href="?controller=home&action=index">Inicio</a></li>

                        <?php if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) : ?>
                            <li><a href="?controller=colegios&action=index">Colegios</a></li>
                        <?php endif; ?>

                        <?php $perfil = $_SESSION['identity']->perfil; if ($perfil == "user" && isset($_SESSION['identity'])) : ?>
                            <li><a href="?controller=colegios&action=acceso">Colegios</a></li>
                        <?php endif; ?>

                        <?php $perfil = $_SESSION['identity']->perfil; if ($perfil == "user" && isset($_SESSION['identity'])) : ?>
                            <li><a href="?controller=inscritos&action=add">Inscribir</a></li>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) : ?>
                        <li><a href="?controller=inscritos&action=index">Inscritos</a></li>
                        <?php endif; ?>

                        <li><a href="?controller=home&action=config">Configuración</a></li>
                        <li class="sesion text-success"><i class="fas fa-user"></i> <?= $_SESSION['identity']->nombre ?></li>
                        <li class="sesion"><a class="text-danger" href="?controller=usuarios&action=logout"><i class="fas fa-sign-in-alt"></i> Cerrar sesion</a></li>

                    </ul>
                </nav>

            </header>
            <!--site-header-->
        </div>



    <?php endif; ?>