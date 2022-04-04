<?= $pageHelper->addStyle('home.css', 'bottom'); ?>

<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <!-- <div class="parallax-container">
            <div class="foreground">
                
            </div>
        </div> -->
        <div class="mb-5">
            <div class="masthead-heading text-uppercase mb-0">Rivière Mickaël</div>
            <div class="masthead-subheading">Développeur php</div>
        </div>
        <!-- <div class="masthead-subheading">Bienvenue sur mon site portfolio</div> -->
        <a class="btn btn-primary btn-xl text-uppercase" href="#about-me">Qui suis - je ?</a>
    </div>
</header>
<!-- Services-->
<section class="page-section" id="about-me">
    <div class="container">
        <div class="py-3 text-center">
            <h2 class="section-heading text-uppercase">Qui suis - je ?</h2>

            <div class="row page-subsection p-4">
                <div class="col-md-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="/img/PP_3.jpg" alt="..." />
                        <h4>Rivière Mickael</h4>
                        <p class="text-muted">Développeur php</p>

                        <div class="mt-4">
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="la la-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="la la-facebook"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="la la-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mx-auto text-center pt-3">
                    <div class="d-flex flex-row h-100">
                        <p class="large text-muted m-auto">
                            Dévelppeur PHP en freelance depuis peu, j'ai créer ce site pour montrer le travail que j'ai pu effectuer jusqu'a présent.

                        </p>
                    </div>

                </div>
            </div>

            <div class="row page-subsection">
                <h2 class="section-heading text-uppercase">Mes compétences</h2>

                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Logiciels</h4>
                    <p class="text-muted">
                        Netbeans, Eclipse, visual studio, Git bash, Gitkraken, Github desktop, Bitnami WampServer, FileZila
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Languages</h4>
                    <p class="text-muted">
                        Programation: PHP, Javascript, SQL, HTML5, CSS3, Java
                        <br />
                        Langue parlé: Français, Anglais
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Technologies</h4>
                    <p class="text-muted">
                        Framework maitrisé: Cakephp<br />
                        Technologies REST et SOAP
                    </p>
                </div>
            </div>

            <div class="page-subsection">
                <h2 class="section-heading text-uppercase">Mon cursus</h2>
                <h3 class="section-subheading text-muted">Diplomé en développement d'applications PHP chez OpenClassrooms.</h3>

                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="/img/timeline_formation.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2020 - 2022</h4>
                                <h4 class="subheading">Formation OpenClassrooms</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Développeur d'applications PHP - Symfony
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="/vendors/themes/agency/assets/img/about/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2019 - 2020</h4>
                                <h4 class="subheading"></h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Formation en autodidacte (java), Recherche d’emplois et recherche de formation
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="/img/timeline_universite.webp" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2016 - 2018</h4>
                                <h4 class="subheading">Formation universitaire</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    étude en IEEA
                                    (informatique, électronique, énergie électrique et Automatique)
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="/img/timeline_terminale_s.png" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2015 - 2016</h4>
                                <h4 class="subheading">Terminale S</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Spécialité Physique / Chimie au Lycée Boisjoly - Pottier
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Portfolio</h2>
            <h3 class="section-subheading text-muted">Projets</h3>
        </div>
        <div class="row">
            <div class="col-12 offset-md-1 col-md-4 mb-4">
                <!-- Portfolio item 1-->
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="/img/java_fs_mickae_riviere.png" alt="..." />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">FightSession</div>
                        <div class="portfolio-caption-subheading text-muted">Plugin en Java pour le jeu "minecraft".</div>
                    </div>
                </div>
            </div>
            <div class="col-12 offset-md-2 col-md-4 mb-4">
                <!-- Portfolio item 2-->
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="/img/html_mickae_riviere.png" alt="..." />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Site web - UR</div>
                        <div class="portfolio-caption-subheading text-muted">Site web, projet WEB - université de la réunion</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Me contacter</h2>
            <h3 class="section-subheading text-muted">Un projet ou une demande de devis ? contactez - moi via ce formulaire.</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">Veuillez entrer un nom.</div>
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                        <div class="invalid-feedback" data-sb-feedback="email:required">Veuillez entrer un adresse email.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Adresse email invalide</div>
                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">Veuillez entrer un numéro de téléphone.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">Veuillez entrer un message.</div>
                    </div>
                </div>
            </div>
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center text-white mb-3">
                    <div class="fw-bolder">Soumission du formulaire réussie !</div>
                    To activate this form, sign up at
                    <br />
                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage">
                <div class="text-center text-danger mb-3">Erreur lors de l'envoie du message.</div>
            </div>
            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Envoyer</button></div>
        </form>
    </div>
</section>