<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="/css/stylesheet.css" rel="stylesheet" />
    <link href="/css/Admin/menu.css" rel="stylesheet" />
    <link href="/sb-admin/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/css/Admin/listing.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/vendors/line-awesome/css/line-awesome.min.css">

    <link rel="icon" href="/img/favicon_black.svg" />
</head>

<body class="sb-nav-fixed">
    <?= $renderer->element("topnav"); ?>
    <div id="layoutSidenav">
        <?= $renderer->element('sidenav'); ?>
        <div id="layoutSidenav_content">
            <div class="p-2 content-container">
                <?= $content ?>
            </div>
            <?= $renderer->element("footer"); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/sb-admin/js/scripts.js"></script>
</body>

</html>