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
<?php } else { ?>

    <div class="p-3 bg-light container text-center">
        <h3 class="pb-2">Voulez - vous vraiment supprimé la publication "<?= empty($comment) ? "" : $comment['id'] ?>"? </h3>
        <form class="d-inline" method="POST" action="">
            <div class="d-none form-group pb-2">
                <input name="action" type="text" value="0">
            </div>
            <button type="submit" class="btn btn-secondary">Non, annuler</button>
        </form>
        <form class="d-inline" method="POST" action="">
            <div class="d-none form-group pb-2">
                <input name="action" type="text" value="1">
            </div>
            <button class="btn btn-danger" type="submit">Oui, supprimer !</button>
        </form>
    </div>
<?php } ?>