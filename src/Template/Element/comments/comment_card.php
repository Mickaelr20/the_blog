<div class="col-12 p-1">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title">Le <?= date_create($comment['created'])->format("d/m/Y") ?> par <?= $comment['author'] ?></h5>
            <p class="card-text"><?= $comment['content'] ?></p>
        </div>
    </div>
</div>