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

<div class="mt-3 bg-light container">
    <form class="p-3" method="POST" action="/admin/posts/new">
        <div class="form-group pb-2">
            <label for="author">Auteur</label>
            <input name="author" type="text" class="form-control" placeholder="Auteur" value="<?= !empty($form['author']) ? $form['author'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="title">Titre</label>
            <input name="title" class="form-control" placeholder="Titre" required>
        </div>
        <div class="form-group pb-2">
            <label for="hat">chapeau introductif</label>
            <input name="hat" class="form-control" placeholder="chapeau introductif" required>
        </div>
        <div class="form-group pb-2">
            <label for="content">Contenu</label>
            <input name="content" class="form-control" placeholder="Contenu" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>