<?php
// Démarrer la session
session_start();

// Vérifier si l'ID de l'utilisateur est défini dans la session
// if(isset($_SESSION['client_id'])) {
//     echo "ID de l'utilisateur : " . $_SESSION['client_id'];
// } else {
//     echo "ID de l'utilisateur non trouvé dans la session.";
// }

// Charger le contenu du fichier XML
$xml = simplexml_load_file('BDDmedicare.xml');

// Accéder aux informations stockées dans la session pour le client
$id = $_SESSION['medecin_id'];


// Rechercher le personnel de santé dans le fichier XML en fonction de son ID
$personnel = $xml->xpath("//personnels_sante[id='$id']")[0];


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare - Accueil</title>
    <link rel="icon" href="Images/Logo_icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <!------------------------  A Remplir avec son style ------------------------>

    <style>
        /* Style pour le contenu du profil */
        .container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .container p {
            font-size: 20px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .container p strong {
            color: #007bff;
            font-weight: bold;
        }
    </style>

    <!------------------------         Style Perso       ------------------------>

</head>

<body>
<header>
    <div class="header-top">
        <img src="Images/Logo_site.png" alt="Logo Medicare" class="logo">
        <h1>Medicare: Services Médicaux</h1>
    </div>
    <nav>
        <ul>
            <li><a href="Accueil_Medecin.html">Accueil</a></li>
            <li>
                <a href="Tout_Parcourir_Medecin.html">Tout Parcourir</a>
                <ul class="dropdown-menu">
                    <li><a href="Medecin_Generaliste_Medecin.php">Médecins Généralistes</a></li>
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
            <li><a href="Rechercher_Medecin.php">Recherche</a></li>
            <li><a href="Rendez_Vous_Medecin.php">Rendez-vous</a></li>
            <li><a href="Votre_Profil_Medecin.php">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Profil_Medecin.php">Votre Profil</a></li>
                    <li><a href="Accueil.php">Deconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<main>

    <!------------------------  A Remplir  ------------------------>

    <div class="container">
        <h2>Votre Profil</h2>
        <div>
            <p><strong>Nom:</strong> <?= $personnel->nom ?></p>
            <p><strong>Prénom:</strong> <?= $personnel->prenom ?></p>
            <p><strong>Email:</strong> <?= $personnel->email ?></p>
            <p><strong>Mot de Passe:</strong> <?= $personnel->mot_de_passe ?></p>
            <p><strong>Spécialité:</strong> <?= $personnel->specialite ?></p>
            <p><strong>Téléphone:</strong> <?= $personnel->telephone ?></p>
        </div>
    </div>

    <!------------------------             ------------------------>

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
