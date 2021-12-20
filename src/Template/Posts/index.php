<section class="page-section" id="publications">
    <div class="container">
        <h2 class="section-heading text-uppercase">Publications</h2>
        <div class="row">
            <?php
            foreach ($liste_posts as $post) {
                $renderer->element("posts/publication_card", ["post" => $post]);
            }
            ?>
        </div>

        <?= $renderer->element("pagination", ['nb_page_max' => $nb_page_max, 'actual_page' => $actual_page, 'base_link' => $base_link]); ?>

    </div>
</section>

<?= $pageHelper->addStyle('posts_liste.css', 'bottom'); ?>