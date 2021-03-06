<?php
if (!empty($requestData['deletedId']) && is_numeric($requestData['deletedId'])) {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>L'utilisateur numero <?= $requestData['deletedId'] ?> a été supprimé</h3>
        </div>
    </div>
<?php } ?>

<a href="/admin/users/new" class="btn btn-primary">Nouvel utilisateur</a>
<div class="listing">
    <div class="list-head">
        <div class="flex-basis-1">Id</div>
        <div>Nom</div>
        <div>Prénom</div>
        <div>Email</div>
        <div>Pseudo</div>
        <div>Est validé ? (admin)</div>
        <div>Actions</div>
    </div>
    <div class="list-body">
        <?php
        foreach ($listeUsers as $user) { ?>
            <?= $renderer->element("admin_user_row", ["vuser" => $user]) ?>
        <?php } ?>

    </div>
</div>
<?= $renderer->element("pagination", ['nbPageMax' => $nbPageMax, 'actualPage' => $actualPage, 'baseLink' => $baseLink]); ?>