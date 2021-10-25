<?php
if (!empty($_GET['deletedId']) && is_numeric($_GET['deletedId'])) {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>L'utilisateur numero <?= $_GET['deletedId'] ?> a été supprimé</h3>
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
        <!-- < ?= var_dump($liste_users) ? > -->
        <?php
        foreach ($liste_users as $user) {
            // echo json_encode($user);
            echo $renderer->element("admin_user_row", ["vuser" => $user]);
        }
        ?>

    </div>
</div>
<?= $renderer->element("pagination", ['nb_page_max' => $nb_page_max, 'actual_page' => $actual_page, 'base_link' => $base_link]); ?>