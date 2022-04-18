<section class="page-section" id="publications">
    <div class="container">
        <h2 class="section-heading text-uppercase">Publications</h2>
        <div class="row">
            <?php
            foreach ($listePosts as $post) {
                $renderer->element("posts/publication_card", ["post" => $post]);
            }
            ?>
        </div>

        <?= $renderer->element("pagination", ['nbPageMax' => $nbPageMax, 'actualPage' => $actualPage, 'baseLink' => $baseLink]); ?>

    </div>
</section>

<?= $pageHelper->addStyle('posts_liste.css', 'bottom'); ?>