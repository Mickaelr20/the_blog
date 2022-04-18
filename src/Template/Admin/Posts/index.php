<?php
if (!empty($requestData['deletedId']) && is_numeric($requestData['deletedId'])) {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>La publication numero <?= $requestData['deletedId'] ?> a été supprimé</h3>
        </div>
    </div>
<?php } ?>

<a href="/admin/posts/new" class="btn btn-primary">Nouvelle publication</a>
<div class="listing">
    <div class="list-head">
        <div class="flex-basis-1">Id</div>
        <div>Autheur</div>
        <div>Title</div>
        <div>Actions</div>
    </div>
    <div class="list-body">
        <?php
        foreach ($listePosts as $post) {
        ?>
            <?= $renderer->element("admin_post_row", ["post" => $post]); ?>
        <?php } ?>

    </div>
</div>
<?= $renderer->element("pagination", ['nbPageMax' => $nbPageMax, 'actualPage' => $actualPage, 'baseLink' => $baseLink]); ?>