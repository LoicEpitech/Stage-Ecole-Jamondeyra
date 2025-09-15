<!-- Navbar Start -->
<body>
    <div class="top_container">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.php">
                        <img  class="image_nav" src=" <?php echo Chemins::IMAGES . 'logo_ecole.jpg' ?> " alt="">
                        <span>
                            Jamondeyra
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php"> Accueil <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item ">

                                    <a class="nav-link" href="index.php#APropos">À propos</a>


                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link" href="index.php?controleur=Actualite&action=afficherActualite"> Actualités </a>
                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="index.php#Services"> Services </a>

                                </li>
                                
                                <li class="nav-item">

                                    <a class="nav-link" href="index.php?controleur=Photo&action=afficherPhoto"> Galerie </a>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#ContactNow">Nous Contacter</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?controleur=Admin&action=afficherIndex">Administration</a>
                                </li>

                            </ul>

                        </div>
                </nav>
            </div>
        </header>
        <!-- Navbar End -->



