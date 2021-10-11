<div class="container">
    <h1><?= $post['title'] ?></h1>
    <p class="text-justify card-text"><?= $post['content'] ?></p>
    <p>Le <?= date_create($post['created'])->format("d/m/Y") ?> par <?= $post['author'] ?></p>
    <hr />
    <h1>Commentaires</h1>
    <div class="row">
        <?php
        if (!empty($post['comments']) && is_array($post['comments']) && count($post['comments']) > 0) {
            foreach ($post['comments'] as $comment) {
                $renderer->element("comments/comment_card", ["comment" => $comment]);
            }
        } else { ?>
            <h5>Aucun commentaires</h5>
        <?php } ?>
    </div>
</div>