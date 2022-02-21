<?php
if (!empty($requestData['deletedId']) && is_numeric($requestData['deletedId'])) {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>Le commentaire numero <?= $requestData['deletedId'] ?> a été supprimé</h3>
        </div>
    </div>
<?php } ?>

<div class="listing">
    <div class="list-head">
        <div class="flex-basis-1">Id</div>
        <div>Autheur</div>
        <div>Contenu</div>
        <div>Validé ?</div>
        <div>Actions</div>
    </div>
    <div class="list-body">
        <?php
        if ($liste_comments) {
            foreach ($liste_comments as $comment) {
                echo $renderer->element("admin_comment_row", ["comment" => $comment]);
            }
        } else {
            echo "<div class=\"list-row\"><div>Aucunes données à afficher.</div></div>";
        }

        ?>

    </div>
</div>
<?= $renderer->element("pagination", ['nb_page_max' => $nb_page_max, 'actual_page' => $actual_page, 'base_link' => $base_link]); ?>