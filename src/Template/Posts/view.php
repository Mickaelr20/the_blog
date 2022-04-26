<div class="container my-2">
    <center>
        <img src="../<?= $post->image->getFullPath() ?>" class="img-fluid p-4" alt="<?= $post->image->display_name ?>" />
    </center>
    <h1 class="text-center"><?= $post->title ?></h1>
    <p class="text-justify card-text"><?= $post->content ?></p>
    <p>Le <?= date_create($post->created)->format("d/m/Y") ?> par <?= $post->author ?></p>
    <hr />

    <?php
    if (!empty($requestData['saveState']) && $requestData['saveState'] === "success") {
    ?>
        <div class="m-auto container">
            <div class="text-center alert alert-success" role="alert">
                <h3>Demande d'ajout de commentaire envoyé!</h3>
            </div>
        </div>
    <?php } ?>

    <h1>Laisse un commentaire:</h1>
    <form class="" method="POST" action="/comments/new/">
        <input type="hidden" name="csrfToken" value="<?= $sessionHelper->get('csrfToken') ?>">
        <div class="d-none form-group pb-2">
            <label for="post_id">Id de la publication</label>
            <input name="post_id" type="text" class="form-control" placeholder="Id de la publication" value="<?= !empty($post->id) ? $post->id : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="author">Auteur</label>
            <input name="author" type="text" class="form-control" placeholder="Auteur" value="<?= !empty($comment->author) ? $comment->author : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="content">Contenu</label>
            <textarea name="content" class="form-control" placeholder="Contenu" required><?= !empty($comment->content) ? $comment->content : "" ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <hr />
    <h1>Commentaires</h1>
    <div class="row">
        <?php
        if (!empty($post->comments) && is_array($post->comments) && count($post->comments) > 0) {
            foreach ($post->comments as $comment) {
                $renderer->element("comments/comment_card", ["comment" => $comment]);
            }
        } else { ?>
            <h5>Aucun commentaires</h5>
        <?php } ?>
    </div>

    <?= $renderer->element("pagination", ['nbPageMax' => $nbPageCommentsMax, 'actualPage' => $actualCommentsPage, 'baseLink' => $baseCommentsLink]); ?>
</div>