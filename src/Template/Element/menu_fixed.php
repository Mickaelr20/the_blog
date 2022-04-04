<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark navbar-shrink" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/img/tb-icon-yellow.png" alt="icone the blog" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="/#about-me">Qui suis - je ?</a></li>
                <li class="nav-item"><a class="nav-link" href="/#portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link<?= !empty($active_link_name) && $active_link_name === "posts" ? " active" :"" ?>" href="/publications">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>