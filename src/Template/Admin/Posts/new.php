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

<div class="mt-3 bg-light container">
    <form class="p-3 row" method="POST" action="/admin/posts/new" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= App\Helper\SessionHelper::get('csrf_token') ?>">

        <div class="p-3 col-md-9 col-12">
            <div class="form-group pb-2">
                <label for="image[display_name]">Nom de l'image</label>
                <input required name="image[display_name]" type="text" class="form-control" placeholder="Nom de l'image" value="<?= !empty($form['image']['display_name']) ? $form['image']['display_name'] : "" ?>">
            </div>
            <div class="form-group pb-2">
                <label for="image">Image</label>
                <input required id="postImageInput" name="image" type="file" class="form-control" placeholder="Image">
            </div>
        </div>
        <div id="postImagePreview" class="col-md-3 col-12 d-flex">
            <?php if (!empty($form['image']['path']) && !empty($form['image']['file_name']) && !empty($form['image']['type'])) { ?>
                <img class="image-preview" src="<?= $form['image']['path'] ?><?= $form['image']['file_name'] ?>.<?= $form['image']['type'] ?>" alt="test">
            <?php } else { ?>
                <img class="image-preview" src="/img/empty_image.jpg" alt="aucune image">
            <?php } ?>
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
            <textarea name="content" id="postTrumbowyg" class="form-control" placeholder="Contenu" required><?= !empty($form['content']) ? $form['content'] : "" ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?= $pageHelper->addScript('posts.js', 'bottom'); ?>
<?= $pageHelper->addStyle('../vendors/trumbowyg/dist/ui/trumbowyg.min.css', 'bottom'); ?>
<?= $pageHelper->addStyle('Admin/posts.css', 'bottom'); ?>
<?= $pageHelper->addScript('../vendors/Trumbowyg/dist/trumbowyg.min.js', 'bottom'); ?>