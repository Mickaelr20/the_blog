<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/vendors/themes/agency/css/styles.css" rel="stylesheet" />
    <title><?= $title ?></title>
    <meta name="description" content="Portfolio de Rivière Mickaël" />
    <meta name="author" content="Rivière Mickael" />
    <meta name="keywords" content="Portfolio, cv, curriculum, vitae, developpeur, php, bootstrap 5" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/stylesheet.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/vendors/line-awesome/css/line-awesome.min.css">
    <?= $pageHelper->printStyles('bottom'); ?>
    <link rel="icon" href="/img/favicon_black.svg" />

</head>

<body id="page-top">
    <?= $renderer->element("menu", ["user" => $user]); ?>

    <?= $content ?>

    <?= $renderer->element("footer") ?>

    <?= $renderer->element("modals") ?>

    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Core theme JS-->
    <!-- <script src="/vendors/themes/agency/js/scripts.js"></script> -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->
    <?= $pageHelper->printScripts('bottom'); ?>
</body>

</html>