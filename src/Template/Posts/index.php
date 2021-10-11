<div class="container">
    <h1>Liste des actualités</h1>
    <div class="row">
        <?php
        foreach ($liste_posts as $post) {
            $renderer->element("posts/publication_card", ["post" => $post]);
        }
        ?>
    </div>

    <?= $renderer->element("pagination", ['nb_page_max' => $nb_page_max, 'actual_page' => $actual_page, 'base_link' => $base_link]); ?>

</div>