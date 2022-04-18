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
        if ($listeComments) {
            foreach ($listeComments as $comment) {
        ?>
                <?= $renderer->element("admin_comment_row", ["comment" => $comment]); ?>
            <?php
            }
        } else { ?>
            <div class="list-row">
                <div>Aucunes données à afficher.</div>
            </div>
        <?php } ?>

    </div>
</div>
<?= $renderer->element("pagination", ['nbPageMax' => $nbPageMax, 'actualPage' => $actualPage, 'baseLink' => $baseLink]); ?>