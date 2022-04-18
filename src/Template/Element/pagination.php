<?php if ($nbPageMax > 1) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            $previousDisabled = false;
            $nextDisabled = false;

            if ($actualPage < 1) {
                $previousDisabled = true;
            }

            if ($actualPage >= ($nbPageMax - 1)) {
                $$nextDisabled = true;
            }
            ?>
            <li class="page-item <?= $previousDisabled ? " disabled" : "" ?>"><a class="page-link" href="<?= $baseLink ?><?= $actualPage - 1 ?>">Précédent</a></li>
            <?php
            for ($i = 0; $i < $nbPageMax; $i++) {
                $isActive = $i == $actualPage;
            ?>
                <li class="page-item <?= $isActive ? ' active' : '' ?>"><a class="page-link" href="<?= $baseLink ?><?= $i ?>"> <?= $i + 1 ?></a></li>
            <?php } ?>
            <li class="page-item <?= $$nextDisabled ? " disabled" : "" ?>"><a class="page-link" href="<?= $baseLink ?><?= $actualPage + 1 ?>">Suivant</a></li>
        </ul>
    </nav>
<?php } ?>