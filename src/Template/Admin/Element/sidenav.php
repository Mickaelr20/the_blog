<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="h5 nav-link<?= $pageHelper->is_menu_link_active("admin") ? " active" : "" ?>" href="/admin">
                    <div class="sb-nav-link-icon"><i class="mb-0 h5 las la-home"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="h5 nav-link<?= $pageHelper->is_menu_link_active("posts") ? " active" : " inactive" ?>" href="/admin/posts">
                    <div class="sb-nav-link-icon"><i class="mb-0 h5 las la-newspaper"></i></div>
                    Publications
                </a>
                <a class="h5 nav-link<?= $pageHelper->is_menu_link_active("comments") ? " active" : " inactive" ?>" href="/admin/comments">
                    <div class="sb-nav-link-icon"><i class="mb-0 h5 las la-comments"></i></div>
                    Commentaires
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>