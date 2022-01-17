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
if (!empty($_GET['editState'])) {
    $alert_edit_state_class = "success";
    $alert_edit_state_text = "La publication a été mise à jour";

    switch ($_GET['editState']) {
        case "wrong_type":
            $alert_edit_state_class = "danger";
            $alert_edit_state_text = "Erreur: Le fichier doit être une image";
    }
?>
    <div class="m-auto container">
        <div class="text-center alert alert-<?= $alert_edit_state_class ?>" role="alert">
            <h3><?= $alert_edit_state_text ?></h3>
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
    <div class="row">
        <form class="p-3 col-md-9 col-12" method="POST" action="/admin/posts/edit_image" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= App\Helper\SessionHelper::get('csrf_token') ?>">

            <div class="p-2">
                <div class="d-none form-group pb-2">
                    <label for="id">Id</label>
                    <input name="id" type="text" class="form-control" placeholder="Id" value="<?= !empty($form->image->id) ? $form->image->id : "" ?>">
                </div>
                <div class="d-none form-group pb-2">
                    <label for="post_id">Id</label>
                    <input name="post_id" type="text" class="form-control" placeholder="Id" value="<?= !empty($form->id) ? $form->id : "" ?>">
                </div>
                <div class="form-group pb-2">
                    <label for="display_name">Nom de l'image</label>
                    <input name="display_name" type="text" class="form-control" placeholder="Nom de l'image" value="<?= !empty($form->image->display_name) ? $form->image->display_name : "" ?>" required>
                </div>
                <div class="form-group pb-2">
                    <label for="image">Image</label>
                    <input id="postImageInput" name="image" type="file" class="form-control" placeholder="Image" required>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
        <div id="postImagePreview" class="col-md-3 col-12 d-flex">
            <?php if (!empty($form->image->id)) { ?>
                <img class="image-preview" src="/<?= $form->image->path ?><?= $form->image->file_name ?>" alt="Preview image">
            <?php } else { ?>
                <img class="image-preview" src="/img/empty_image.jpg" alt="aucune image">
            <?php } ?>
        </div>
    </div>
</div>

<div class="mt-3 bg-light container">
    <form class="p-3" method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?= App\Helper\SessionHelper::get('csrf_token') ?>">

        <div class="d-none form-group pb-2">
            <label for="id">Id</label>
            <input name="id" type="text" class="form-control" placeholder="Id" value="<?= !empty($form->id) ? $form->id : "" ?>" required>
        </div>
        <div class="d-none form-group pb-2">
            <label for="image_id">Id</label>
            <input name="image_id" type="text" class="form-control" placeholder="Id image" value="<?= !empty($form->image_id) ? $form->image_id : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="author">Auteur</label>
            <input name="author" type="text" class="form-control" placeholder="Auteur" value="<?= !empty($form->author) ? $form->author : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="title">Titre</label>
            <input name="title" class="form-control" placeholder="Titre" value="<?= !empty($form->title) ? $form->title : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="hat">chapeau introductif</label>
            <input name="hat" class="form-control" placeholder="chapeau introductif" value="<?= !empty($form->hat) ? $form->hat : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="content">Contenu</label>
            <textarea name="content" id="postTrumbowyg" class="form-control" placeholder="Contenu" required><?= !empty($form->content) ? $form->content : "" ?></textarea>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a type="button" href="/admin/posts/delete/<?= $form->id ?>" class="btn btn-danger">Supprimer</a>
        </div>
    </form>
</div>

<?= $pageHelper->addScript('posts.js', 'bottom'); ?>
<?= $pageHelper->addStyle('../vendors/trumbowyg/dist/ui/trumbowyg.min.css', 'bottom'); ?>
<?= $pageHelper->addStyle('Admin/posts.css', 'bottom'); ?>
<?= $pageHelper->addScript('../vendors/Trumbowyg/dist/trumbowyg.min.js', 'bottom'); ?>