<div class="container">
    <h1>Liste des actualités</h1>
    <div class="row">
        <?php
        foreach ($liste_posts as $post) {
            $renderer->element("posts/publication_card", ["post" => $post]);
        }
        ?>
    </div>
</div>