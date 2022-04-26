<div class="list-row">
    <div class="flex-basis-1"><?= $comment->id ?></div>
    <div><?= $comment->author ?></div>
    <div><?= substr($comment->content, 0, 255) . (strlen($comment->content) > 255 ? ' ... [tronqué]' : "") ?></div>
    <div><?= empty($comment->is_validated) ? "Non" : "Oui" ?></div>
    <div>
        <a type="button" href="/admin/comments/edit/<?= $comment->id ?>" class="btn btn-primary" title="Modifier"><i class="la la-pencil"></i></a>
        <a type="button" href="/admin/comments/delete/<?= $comment->id ?>" class="btn btn-danger" title="Supprimer"><i class="la la-trash"></i></a>

    </div>
</div>