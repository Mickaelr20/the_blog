<?php if (!empty($errors) && count($errors) > 0) { ?>
    <div class="m-auto container">
        <div class="text-center alert alert-danger" role="alert">
            <?php
            $title = count($errors) > 1 ? "Des problèmes ont été détectés." : "Un problème a été détecté.";
            ?>
            <h3><?= $title ?>:</h3>
            <?php foreach ($errors as $fieldName => $error) { ?>
                <p><?= $error ?></p>
            <?php } ?>
        </div>
    </div>
<?php } else { ?>
    <div class="m-auto container text-center">
        <div class="text-center alert alert-success" role="alert">
            <h3>Votre commentaire est envoyé, il est en demande de validation</h3>
        </div>

        <a href="/admin/comments/" class="btn btn-primary">Retour à la liste des commentaires</a>
    </div>

<?php } ?>