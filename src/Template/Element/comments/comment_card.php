<div class="col-12 p-1">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="d-inline card-title"><?= $comment->author ?></h5><small class="m-1">Le <?= date_create($comment->created)->format("d/m/Y") ?></small>
            <p class="card-text"><?= $comment->content ?></p>
        </div>
    </div>
</div>