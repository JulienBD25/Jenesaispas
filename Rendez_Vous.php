<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de Rendez-vous - Medicare</title>
    <link rel="icon" href="Images/Logo_icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>


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
                        <a href="#">Médecins Spécialistes</a>
                        <ul class="dropdown-submenu">
                            <li><a href="#" onclick="showSpecialty('Addictologie')">Addictologie</a></li>
                            <li><a href="#" onclick="showSpecialty('Andrologie')">Andrologie</a></li>
                            <li><a href="#" onclick="showSpecialty('Cardiologie')">Cardiologie</a></li>
                            <li><a href="#" onclick="showSpecialty('Dermatologie')">Dermatologie</a></li>
                            <li><a href="#" onclick="showSpecialty('Gastro-Hépato-Entérologie')">Gastro-Hépato-Entérologie</a></li>
                            <li><a href="#" onclick="showSpecialty('Gynécologie')">Gynécologie</a></li>
                            <li><a href="#" onclick="showSpecialty('I.S.T.')">I.S.T.</a></li>
                            <li><a href="#" onclick="showSpecialty('Ostéopathie')">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="#" onclick="showLaboratoire()">Test en Labo</a></li>
                </ul>
            </li>
            <li><a href="Rechercher.php">Recherche</a></li>
            <li><a href="Rendez_Vous.php">Rendez-vous</a></li>
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

    <h3>Connectez-vous pour voir vos rendez-vous <a href="Votre_Compte.html">ici</a>.</h3>

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
