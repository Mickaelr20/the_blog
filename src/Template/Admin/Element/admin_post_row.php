<div class="list-row">
    <div class="flex-basis-1"><?= $post['id'] ?></div>
    <div><?= $post['author'] ?></div>
    <div><?= $post['title'] ?></div>
    <div>
        <a type="button" href="/admin/posts/edit/<?= $post['id'] ?>" class="btn btn-primary" title="Modifier"><i class="la la-pencil"></i></a>
        <a type="button" href="/admin/posts/delete/<?= $post['id'] ?>" class="btn btn-danger" title="Supprimer"><i class="la la-trash"></i></a>

    </div>
</div>