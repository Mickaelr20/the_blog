<div class="col-12 pb-2">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-3">
                    <img src="/<?= $post->image->getFullPath() ?>" class="img-fluid img-post-preview" alt="<?= $post->image->display_name ?>" />
                </div>
                <div class="d-flex flex-column col-12 col-sm-8 col-md-9">
                    <h5 class="card-title"><?= $post->title ?></h5>
                    <p class="card-text"><?= $post->hat ?> <a href="/publication/<?= $post->id ?>">... lire la suite</a></p>
                    <div class="mt-auto">Le <?= date_create($post->created)->format("d/m/Y") ?> par <?= $post->author ?></div>
                </div>
            </div>
        </div>
    </div>
</div>