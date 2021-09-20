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
    <form class="p-3" method="POST" action="/users/login">
        <div class="form-group pb-2">
            <label for="email">Adresse email</label>
            <input name="email" type="email" class="form-control" placeholder="Entrer email" value="<?= !empty($form['email']) ? $form['email'] : "" ?>" required>
        </div>
        <div class="form-group pb-2">
            <label for="password">Mot de passe</label>
            <input name="password" type="password" class="form-control" placeholder="Entrer mot de passe" required>
        </div>
        <!-- <div class="form-check">
            <input type="checkbox" class="form-check-input">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>