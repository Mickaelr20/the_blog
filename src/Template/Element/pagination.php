<?php if ($nb_page_max > 1) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            <?php
            $previous_disabled = false;
            $next_disabled = false;

            if ($actual_page < 1) {
                $previous_disabled = true;
            }

            if ($actual_page >= ($nb_page_max - 1)) {
                $next_disabled = true;
            }

            echo '<li class="page-item' . ($previous_disabled ? " disabled" : "") . '"><a class="page-link" href="' . $base_link . ($actual_page - 1) . '">Précédent</a></li>';

            for ($i = 0; $i < $nb_page_max; $i++) {
                $is_active = $i == $actual_page;
                echo '<li class="page-item' . ($is_active ? ' active' : '') . '"><a class="page-link" href="' . $base_link . $i  . '">' . ($i + 1) . '</a></li>';
            }

            echo '<li class="page-item' . ($next_disabled ? " disabled" : "") . '"><a class="page-link" href="' . $base_link . ($actual_page + 1) . '">Suivant</a></li>';
            ?>
        </ul>
    </nav>
<?php } ?>