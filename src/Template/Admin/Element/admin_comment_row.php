<div class="list-row">
    <div class="flex-basis-1"><?= $comment['id'] ?></div>
    <div><?= $comment['author'] ?></div>
    <div><?= $comment['content'] ?></div>
    <div><?= empty($comment['validated']) ? "Non" : "Oui" ?></div>
    <div>
        <a type="button" href="/admin/comments/edit/<?= $comment['id'] ?>" class="btn btn-primary" title="Modifier"><i class="la la-pencil"></i></a>
        <a type="button" href="/admin/comments/delete/<?= $comment['id'] ?>" class="btn btn-danger" title="Supprimer"><i class="la la-trash"></i></a>

    </div>
</div>