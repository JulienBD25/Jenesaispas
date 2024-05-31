<?php

// Charger les données des médecins à partir du fichier XML
$xmlFile = 'BDDmedicare.xml';
$xml = simplexml_load_file($xmlFile);

if ($xml === false) {
    die('Erreur de chargement du fichier XML.');
}

// Récupérer les spécialités autres que "Médecine Générale"
$specialites = [];
foreach ($xml->personnels_sante as $personnel) {
    $specialite = (string) $personnel->specialite;
    $specialite_trimmed = trim($specialite);
    $specialite_lower = strtolower($specialite_trimmed);

    if ($specialite_lower !== 'médecine générale' && !in_array($specialite_trimmed, $specialites)) {
        $specialites[] = $specialite_trimmed;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Spécialités Médicales</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="icon" href="Images/Logo_icone.ico" type="image/x-icon">

    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 0 15px;
        }
        .specialists-title {
            text-align: center;
            color: #005f8c;
            margin-bottom: 30px;
        }
        .specialty-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .specialty {
            border: 1px solid #ccc;
            padding: 1rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .btn {
            padding: 0.5rem 1rem;
            background-color: #0073b1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 0.5rem;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #005f8c;
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
            <li><a href="Accueil_Client.html">Accueil</a></li>
            <li>
                <a href="Tout_Parcourir_Client.html">Tout Parcourir</a>
                <ul class="dropdown-menu">
                    <li><a href="Medecin_Generaliste_Client.php">Médecins Généralistes</a></li>
                    <li>
                        <a href="Medecins_specialistes_Client.php">Médecins Spécialistes</a>
                        <ul class="dropdown-submenu">
                            <li><a href="Addictologie_Client.php">Addictologie</a></li>
                            <li><a href="Andrologie_Client.php">Andrologie</a></li>
                            <li><a href="Cardiologie_Client.php">Cardiologie</a></li>
                            <li><a href="Dermatologie_Client.php">Dermatologie</a></li>
                            <li><a href="Gastro-Hépato-Entérologie_Client.php">Gastro-Hépato-Entérologie</a></li>
                            <li><a href="Gynécologie_Client.php">Gynécologie</a></li>
                            <li><a href="I.S.T._Client.php">I.S.T.</a></li>
                            <li><a href="Ostéopathie_Client.php">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="Test_Labo_Client">Test en Labo</a></li>
                </ul>
            </li>
            <li><a href="Rechercher_Client.php">Recherche</a></li>
            <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte_Client.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Client_Se_Connecter.html">Votre Profil</a></li>
                    <li><a href="Accueil.html">Deconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<main class="container">
    <section>
        <h2 class="specialists-title">Nos Spécialités Médicales :</h2>
        <div class="specialty-container">
            <?php if (!empty($specialites)): ?>
                <?php foreach ($specialites as $specialite): ?>
                    <div class="specialty">
                        <span><?= htmlspecialchars($specialite) ?></span>
                        <a href="<?= htmlspecialchars($specialite) ?>_Client.php" class="btn">Voir les spécialistes</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune spécialité trouvée.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<footer>
    <div class="footer-content">
        <ul>
            <li><i class="fas fa-envelope"></i> <a href="mailto:email@medicare.com">email@medicare.com</a></li>
            <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
            <li><i class="fas fa-map-marker-alt"></i> 16 rue Sextius Michel, Paris, France</li>
        </ul>
    </div>
</footer>
</body>
</html>
