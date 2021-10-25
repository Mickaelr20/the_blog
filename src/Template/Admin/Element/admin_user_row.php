<div class="list-row">
    <div class="flex-basis-1"><?= $vuser['id'] ?></div>
    <div><?= $vuser['last_name'] ?></div>
    <div><?= $vuser['first_name'] ?></div>
    <div><?= $vuser['email'] ?></div>
    <div><?= $vuser['nickname'] ?></div>
    <div><?= empty($vuser['is_validated']) ? "Non" : "Oui" ?></div>
    <div>
        <a type="button" href="/admin/users/edit/<?= $vuser['id'] ?>" class="btn btn-primary" title="Modifier"><i class="la la-pencil"></i></a>
        <a type="button" href="/admin/users/delete/<?= $vuser['id'] ?>" class="btn btn-danger" title="Supprimer"><i class="la la-trash"></i></a>

    </div>
</div>