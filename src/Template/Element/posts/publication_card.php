<div class="col-12 pb-2">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <p class="card-text"><?= $post['hat'] ?></p>
            <p>Le <?= date_create($post['created'])->format("d/m/Y") ?> par <?= $post['author'] ?></p>
            <a href="/publication/<?= $post['id'] ?>" class="btn btn-primary">Voir la publication</a>
        </div>
    </div>
</div>