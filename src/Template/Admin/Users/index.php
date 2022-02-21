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
        foreach ($liste_users as $user) {
            echo $renderer->element("admin_user_row", ["vuser" => $user]);
        }
        ?>

    </div>
</div>
<?= $renderer->element("pagination", ['nb_page_max' => $nb_page_max, 'actual_page' => $actual_page, 'base_link' => $base_link]); ?>