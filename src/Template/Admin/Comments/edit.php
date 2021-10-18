<?php if (!empty($errors) && count($errors) > 0) { ?>
    <div class="m-auto container">
        <div class="text-center alert alert-danger" role="alert">
            <?php
            $title = count($errors) > 1 ? "Des problèmes ont été détectés." : "Un problème a été détecté.";
            echo "<h3>$title:</h3>";

            foreach ($errors as $field_name => $error) {
                echo "<p>$error</p>";
            }
            ?>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($_GET['editState']) && $_GET['editState'] === 'success') {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>Le commentaire a été mise à jour</h3>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($_GET['saveState']) && $_GET['saveState'] === 'success') {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>Le commentaire a été sauvegardé</h3>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($_GET['deletedId']) && is_numeric($_GET['deletedId'])) {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>Le commentaire <?= $_GET['deletedId'] ?> a été supprimé avec succès</h3>
        </div>
    </div>
<?php } ?>

<div class="mt-3 bg-light container">
    <form class="p-3" method="POST" action="">
        <div class="d-none form-group pb-2">
            <label for="id">Id</label>
            <input name="id" type="text" class="form-control" placeholder="Auteur" value="<?= !empty($form['id']) ? $form['id'] : "" ?>" required>
        </div>
        <div class="d-none form-group pb-2">
            <label for="post_id">Id de la publication</label>
            <input name="post_id" type="text" class="form-control" placeholder="Id de la publication" value="<?= !empty($form['post_id']) ? $form['post_id'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="author">Auteur</label>
            <input name="author" type="text" class="form-control" placeholder="Auteur" value="<?= !empty($form['author']) ? $form['author'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="content">Contenu</label>
            <textarea name="content" class="form-control" placeholder="Contenu" required><?= !empty($form['content']) ? $form['content'] : "" ?></textarea>
        </div>
        <div class="form-check">
            <input name="validated" class="form-check-input" type="checkbox" value="true" <?= !empty($form['validated']) ? "checked" : "" ?>>
            <label class="form-check-label" for="validated">
                Valider le commentaire
            </label>
            <small>(Les commentaires validés s'afficherons sur la publication)</small>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>