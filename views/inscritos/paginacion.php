<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm justify-content-center">

    <?php if ($pagina != 1) : ?>

      <li class="page-item ">
        <a class="page-link" href="?controller=<?= $controller ?>&action=<?= $method ?>&pag=<?= $pagina - 1 ?>" tabindex="-1" aria-disabled="true">&laquo;</a>
      </li>

    <?php else : ?>

      <li class="page-item disabled">
        <a class="page-link" href="?controller=<?= $controller ?>&action=<?= $method ?>&pag=<?= $pagina - 1 ?>" tabindex="-1" aria-disabled="true">&laquo;</a>
      </li>

    <?php endif; ?>

    <?php for ($i = 1; $i <= $num_pagina; $i++) {

      if ($i == $pagina) {
        echo ' <li class="page-item active"><a class="page-link" href="?controller='. $controller .'&action='. $method .'&pag=' . $i . '">' . $i . '</a></li>';
      } else {
        echo ' <li class="page-item"><a class="page-link" href="?controller='. $controller .'&action='. $method .'&pag=' . $i . '">' . $i . '</a></li>';
      }
    } ?>

    <?php if ($pagina != $num_pagina) : ?>
        <li class="page-item">
          <a class="page-link" href="?controller=<?= $controller ?>&action=<?= $method ?>&pag=<?= $pagina + 1 ?>">&raquo;</a>
        </li>
      <?php else : ?>

        <li class="page-item disabled">
          <a class="page-link" href="?controller=<?= $controller ?>&action=<?= $method ?>&pag=<?= $pagina + 1 ?>">&raquo;</a>
        </li>
      <?php endif; ?>
  </ul>
</nav>