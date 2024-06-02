<?php

// Charger le contenu du fichier XML
$xml = simplexml_load_file('BDDmedicare.xml');

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

// Rechercher le personnel en fonction de son ID
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
                        <a href="Medecins_specialistes_Medecin.php">Médecins Spécialistes</a>
                        <ul class="dropdown-submenu">
                            <li><a href="Addictologie_Medecin.php">Addictologie</a></li>
                            <li><a href="Andrologie_Medecin.php">Andrologie</a></li>
                            <li><a href="Cardiologie_Medecin.php">Cardiologie</a></li>
                            <li><a href="Dermatologie_Medecin.php">Dermatologie</a></li>
                            <li><a href="Gastro-Hépato-Entérologie_Medecin.php">Gastro-Hépato-Entérologie</a></li>
                            <li><a href="Gynécologie_Medecin.php">Gynécologie</a></li>
                            <li><a href="I.S.T._Medecin.php">I.S.T.</a></li>
                            <li><a href="Ostéopathie_Medecin.php">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="Test_Labo_Medecin">Test en Laboratoire</a></li>
                </ul>
            </li>
            <li><a href="Rechercher_Medecin.php">Recherche</a></li>
            <li><a href="Rendez_Vous_Medecin.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte_Medecin.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Medecin_Se_Connecter.html">Votre Profil</a></li>
                    <li><a href="Accueil.php">Deconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<main>

    <!------------------------  A Remplir  ------------------------>

    <div class="container">
        <h2>Détails du Médecin</h2>
        <div>
            <p><strong>Nom:</strong> <?= htmlspecialchars($personnel->nom) ?></p>
            <p><strong>Prénom:</strong> <?= htmlspecialchars($personnel->prenom) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($personnel->email) ?></p>
            <p><strong>Spécialité:</strong> <?= htmlspecialchars($personnel->specialite) ?></p>
            <p><strong>Téléphone:</strong> <?= htmlspecialchars($personnel->telephone) ?></p>
            <p><strong>Disponibilité:</strong> <?= $personnel->est_disponible == 1 ? 'Disponible' : 'Non disponible' ?></p>
            <p><strong>Photo:</strong> <img src="<?= htmlspecialchars($personnel->photo) ?>" alt="Photo de <?= htmlspecialchars($personnel->nom) ?>" style="width:150px;height:auto;"></p>
            <p><strong>CV:</strong> <a href="<?= htmlspecialchars($personnel->cv) ?>" target="_blank">Voir le CV</a></p>
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

</footer>

<script src="scripts.js"></script>
</body>

</html>
