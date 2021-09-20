<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="fw-bold d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="img-fluid" src="/img/favicon_black.svg" alt="Logo" width="100rem">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link link-dark"><i class="la la-home"></i> Accueil</a></li>
                <li><a href="/publications" class="nav-link link-secondary"><i class="la la-newspaper"></i> Publications</a></li>
            </ul>
            <?php if (!empty($user)) { ?>
                <div class="m-2 dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="/users/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/users/logout">Se déconnecter</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="m-2 dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="m-0 h3 align-middle la la-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="/users/login">Se connecter</a></li>
                        <li><a class="dropdown-item" href="/users/signup">S'inscrire</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</header>