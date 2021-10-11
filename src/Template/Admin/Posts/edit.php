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
            <h3>La publication a été mise à jour</h3>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($_GET['saveState']) && $_GET['saveState'] === 'success') {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>La publication a été sauvegardé</h3>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($_GET['deletedId']) && is_numeric($_GET['deletedId'])) {
?>
    <div class="m-auto container">
        <div class="text-center alert alert-success" role="alert">
            <h3>La publication <?= $_GET['deletedId'] ?> a été supprimé avec succès</h3>
        </div>
    </div>
<?php } ?>

<div class="mt-3 bg-light container">
    <form class="p-3" method="POST" action="">
        <div class="d-none form-group pb-2">
            <label for="id">Id</label>
            <input name="id" type="text" class="form-control" placeholder="Auteur" value="<?= !empty($form['id']) ? $form['id'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="author">Auteur</label>
            <input name="author" type="text" class="form-control" placeholder="Auteur" value="<?= !empty($form['author']) ? $form['author'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="title">Titre</label>
            <input name="title" class="form-control" placeholder="Titre" value="<?= !empty($form['title']) ? $form['title'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="hat">chapeau introductif</label>
            <input name="hat" class="form-control" placeholder="chapeau introductif" value="<?= !empty($form['hat']) ? $form['hat'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="content">Contenu</label>
            <textarea name="content" class="form-control" placeholder="Contenu" required><?= !empty($form['content']) ? $form['content'] : "" ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>