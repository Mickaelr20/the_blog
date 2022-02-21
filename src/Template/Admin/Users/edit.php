<?php if (!empty($errors) && count($errors) > 0) { ?>
    <div class="m-auto container">
        <div class="text-center alert alert-danger" role="alert">
            <?php
            $title = count($errors) > 1 ? "Des problèmes ont été détectés." : "Un problème a été détecté.";
            ?>
            <h3><?= $title ?>:</h3>
            <?php foreach ($errors as $field_name => $error) { ?>
                <p><?= $error ?></p>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($requestData['editState']) && $requestData['editState'] === 'success') {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>L'utilisateur a été mise à jour</h3>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($requestData['saveState']) && $requestData['saveState'] === 'success') {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>L'utilisateur a été sauvegardé</h3>
        </div>
    </div>
<?php } ?>

<div class="mt-3 bg-light container">
    <form class="p-3" method="POST" action="">
        <div class="d-none form-group pb-2">
            <label for="id">Id</label>
            <input name="id" type="text" class="form-control" placeholder="iD" value="<?= !empty($form['id']) ? $form['id'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="last_name">Nom</label>
            <input name="last_name" type="text" class="form-control" placeholder="Nom" value="<?= !empty($form['last_name']) ? $form['last_name'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="first_name">Prénom</label>
            <input name="first_name" type="text" class="form-control" placeholder="Prénom" value="<?= !empty($form['first_name']) ? $form['first_name'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="nickname">Pseudo</label>
            <input name="nickname" type="text" class="form-control" placeholder="Pseudo" value="<?= !empty($form['nickname']) ? $form['nickname'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="email">Email</label>
            <input name="email" type="text" class="form-control" placeholder="Pseudo" value="<?= !empty($form['email']) ? $form['email'] : "" ?>" required>
        </div>
        <div class="form-check">
            <input name="is_validated" class="form-check-input" type="checkbox" value="true" <?= !empty($form['is_validated']) ? "checked" : "" ?>>
            <label class="form-check-label" for="is_validated">
                Valider l'utilisateur
            </label>
            <small>(Donner l'accès admin)</small>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a type="button" href="/admin/users/delete/<?= $form['id'] ?>" class="btn btn-danger">Supprimer</a>
        </div>
    </form>
</div>