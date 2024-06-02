<?php

session_destroy();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare - Accueil</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="icon" href="Images/Logo_icone.ico" type="image/x-icon">

    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .carousel-container {
            max-width: 600px;
            margin: auto;
        }

        .carousel-inner img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .carousel-inner .item img {
            height: 300px;
            width: 100%;
            object-fit: cover;
        }


        .welcome-text, .health-bulletin {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-text h2, .health-bulletin h2 {
            margin-bottom: 10px;
        }

        .welcome-text p, .health-bulletin p {
            font-size: 16px;
            color: black;
        }

        .news-photo {
            width: 100%;
            height: auto;
            max-width: 500px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .news-item {
            margin-bottom: 20px;
        }

        .health-bulletin {
            background-color: #0073b1;
            color: white;
        }

        .health-bulletin h3 {
            color: white;
        }
    </style>
</head>

<body>
<header>
    <div class="header-top">
        <img src="Images/Logo_site.png" alt="Logo Medicare" class="logo">
        <h1>Medicare: Services Médicaux</h1>
    </div>
    <nav>
        <ul>
            <li><a href="Accueil.php">Accueil</a></li>
            <li>
                <a href="Tout_Parcourir.html">Tout Parcourir</a>
                <ul class="dropdown-menu">
                    <li><a href="Medecin_Generaliste.php">Médecins Généralistes</a></li>
                    <li>
                        <a href="Medecins_specialistes.php">Médecins Spécialistes</a>
                        <ul class="dropdown-submenu">
                            <li><a href="Addictologie.php">Addictologie</a></li>
                            <li><a href="Andrologie.php">Andrologie</a></li>
                            <li><a href="Cardiologie.php">Cardiologie</a></li>
                            <li><a href="Dermatologie.php">Dermatologie</a></li>
                            <li><a href="Gastro-Hépato-Entérologie.php">Gastro-Hépato-Entérologie</a></li>
                            <li><a href="Gynécologie.php">Gynécologie</a></li>
                            <li><a href="I.S.T.php">I.S.T.</a></li>
                            <li><a href="Ostéopathie.php">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="Test_Labo.php">Test en Laboratoire</a></li>
                </ul>
            </li>
            <li><a href="Rechercher.php">Recherche</a></li>
            <li><a href="Votre_Compte.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Client_Se_Connecter.php">Client</a></li>
                    <li><a href="Votre_Compte_Medecin_Se_Connecter.php">Médecins</a></li>
                    <li><a href="Votre_Compte_Administrateur_Se_Connecter.php">Administrateur</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<main>
    <div class="welcome-text">
        <h2>Bienvenue sur Medicare</h2>
        <p>Votre plateforme de services médicaux en ligne. Prenez rendez-vous avec nos spécialistes de santé, accédez à vos dossiers médicaux et explorez nos services pour une meilleure prise en charge de votre santé.</p>
    </div>
    <div class="health-bulletin">
        <h2>Bulletin santé de la semaine</h2>
        <div class="news-item">
            <h3>COVID-19 : Nouvelles Mesures Sanitaires</h3>
            <p>Découvrez les dernières mesures sanitaires mises en place pour lutter contre la pandémie de COVID-19.</p>
            <img src="Images/covid.jpeg" alt="COVID-19" class="news-photo">
        </div>
        <div class="news-item">
            <h3>Collecte de Sang</h3>
            <p>Participez à notre collecte de sang cette semaine pour sauver des vies. Votre don est précieux.</p>
            <img src="Images/sang.png" alt="Collecte de Sang" class="news-photo">
        </div>
        <div class="news-item">
            <h3>Campagne de Vaccination</h3>
            <p>Informez-vous sur notre nouvelle campagne de vaccination et les lieux de vaccination près de chez vous.</p>
            <img src="Images/vaccination.png" alt="Vaccination" class="news-photo">
        </div>
    </div>

    <div class="carroussel">
        <h2 style="text-align: center;">Nos Spécialistes de Santé</h2>

        <div id="myCarousel" class="carousel slide carousel-container" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
                <li data-target="#myCarousel" data-slide-to="5"></li>
                <li data-target="#myCarousel" data-slide-to="6"></li>
                <li data-target="#myCarousel" data-slide-to="7"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <a href="Addictologie.php">
                        <img src="Images/medecin1.jpg" alt="Addictologie">
                    </a>
                    <div class="carousel-caption">
                        <h3>Addictologie</h3>
                    </div>
                </div>

                <div class="item">
                    <a href="Andrologie.php">
                        <img src="Images/medecin2.jpg" alt="Andrologie">
                    </a>
                    <div class="carousel-caption">
                        <h3>Andrologie</h3>
                    </div>
                </div>

                <div class="item">
                    <a href="Cardiologie.php">
                        <img src="Images/medecin3.jpg" alt="Cardiologie">
                    </a>
                    <div class="carousel-caption">
                        <h3>Cardiologie</h3>
                    </div>
                </div>

                <div class="item">
                    <a href="Dermatologie.php">
                        <img src="Images/medecin4.jpg" alt="Dermatologie">
                    </a>
                    <div class="carousel-caption">
                        <h3>Dermatologie</h3>
                    </div>
                </div>

                <div class="item">
                    <a href="Gastro-Hépato-Entérologie.php">
                        <img src="Images/medecin5.jpg" alt="Gastro-Hépato-Entérologie">
                    </a>
                    <div class="carousel-caption">
                        <h3>Gastro-Hépato-Entérologie</h3>
                    </div>
                </div>

                <div class="item">
                    <a href="Gynécologie.php">
                        <img src="Images/medecin6.jpg" alt="Gynécologie">
                    </a>
                    <div class="carousel-caption">
                        <h3>Gynécologie</h3>
                    </div>
                </div>

                <div class="item">
                    <a href="I.S.T.php">
                        <img src="Images/medecin7.jpg" alt="IST">
                    </a>
                    <div class="carousel-caption">
                        <h3>I.S.T.</h3>
                    </div>
                </div>

                <div class="item">
                    <a href="Ostéopathie.php">
                        <img src="Images/medecin8.jpg" alt="Ostéopathie">
                    </a>
                    <div class="carousel-caption">
                        <h3>Ostéopathie</h3>
                    </div>
                </div>
            </div>

            <!-- Controles à gauche et à droite -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Précédent</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Suivant</span>
            </a>
        </div>
    </div>
</main>

<footer>
    <div class="footer-content">
        <ul>
            <li><i class="fas fa-envelope"></i> <a href="mailto:email@medicare.com">email@medicare.com</a></li>
            <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
            <li><i class="fas fa-map-marker-alt"></i> 16 rue Sextius Michel, Paris, France</li>
        </ul>
        <div id="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5250.742223981441!2d2.285609375121745!3d48.85113330121908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b49fa6195%3A0x7e3a16fc394bc943!2s16%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1716811550264!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</footer>

<script src="scripts.js"></script>
</body>

</html>
