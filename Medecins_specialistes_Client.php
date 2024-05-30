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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header-top {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #005f8c;
            color: white;
        }
        .header-top img.logo {
            width: 50px;
            height: 50px;
            margin-right: 20px;
        }
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
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        footer a {
            color: #61dafb;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
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
            <li><a href="Accueil.html">Accueil</a></li>
            <li><a href="Tout_Parcourir_Client.html">Tout Parcourir</a></li>
            <li><a href="Recherche.html">Recherche</a></li>
            <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte.html">Votre Compte</a></li>
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
    <div class="footer-content text-center">
        <p>Contactez-nous: <a href="mailto:email@medicare.com">email@medicare.com</a> | Tel: +33 1 23 45 67 89 | Adresse: 16 rue Sextius Michel, Paris, France</p>
    </div>
</footer>
</body>
</html>
