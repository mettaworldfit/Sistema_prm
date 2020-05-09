

<?php if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) : ?>

<footer class="site-footer">
  <div class="movil-option">
  <?php if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) : ?>
          <a class="divisor" href="?controller=inscritos&action=index"><i class="fas fa-address-book"></i></a>
          <?php endif; ?>

          <?php $perfil = $_SESSION['identity']->perfil; if ($perfil == "user" && isset($_SESSION['identity'])) : ?>
               <a class="divisor" href="?controller=colegios&action=acceso"><i class="fas fa-chalkboard-teacher"></i></a>
          <?php endif; ?>

          <?php if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) : ?>
          <a class="divisor" href="?controller=colegios&action=index"><i class="fas fa-chalkboard-teacher"></i></a>
          <?php endif; ?>
          
          <a class="divisor" href="?controller=home&action=index"><i class="fas fa-home"></i></a>
          <?php if (isset($_SESSION['admin']) && isset($_SESSION['identity'])) : ?>
          <a class="divisor" href="?controller=resultados&action=result"><i class="fas fa-vote-yea"></i></a>   
          <?php endif; ?>
             
          <a class="divisor" href="?controller=inscritos&action=add"><i class="fas fa-user-plus"></i></a>
      
  </div>
</footer>

<?php endif; ?>

</body>
</html>


