<?php
if (!empty($_GET['deletedId']) && is_numeric($_GET['deletedId'])) {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>La publication numero <?= $_GET['deletedId'] ?> a été supprimé</h3>
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
        foreach ($liste_posts as $post) {
            echo $renderer->element("admin_post_row", ["post" => $post]);
        }
        ?>

    </div>
</div>
<?= $renderer->element("pagination", ['nb_page_max' => $nb_page_max, 'actual_page' => $actual_page, 'base_link' => $base_link]); ?>