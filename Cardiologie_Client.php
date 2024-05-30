<?php

// Charger les données des médecins à partir du fichier XML
$xmlFile = 'BDDmedicare.xml';
$xml = simplexml_load_file($xmlFile);

if ($xml === false) {
    die('Erreur de chargement du fichier XML.');
}

// Récupérer les médecins spécialistes en addictologie
$cardiologie = [];
foreach ($xml->personnels_sante as $personnel) {
    $specialite = (string) $personnel->specialite;
    $specialite_trimmed = trim($specialite);
    $specialite_lower = strtolower($specialite_trimmed);

    if ($specialite_lower == 'cardiologie') {
        $cardiologie[] = $personnel;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Médecins Spécialistes en Addictologie</title>
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
        .doctor-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .doctor {
            border: 1px solid #ccc;
            padding: 1rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .doctor img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 1rem;
        }
        .doctor-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .doctor-info h3 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }
        .doctor-info p {
            margin: 0.2rem 0;
        }
        .actions {
            display: flex;
            flex-direction: row;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            background-color: #0073b1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #005f8c;
        }
        .cv-container {
            display: none;
            margin-top: 1rem;
            text-align: left;
        }
        .cv-frame {
            width: 100%;
            height: 400px;
            border: none;
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
        <h2 class="specialists-title">Nos médecins spécialistes en Cardiologie :</h2>
        <div class="doctor-container">
            <?php if (!empty($cardiologie)): ?>
                <?php foreach ($cardiologie as $specialiste): ?>
                    <div class="doctor">
                        <img src="<?= htmlspecialchars($specialiste->photo) ?>" alt="Photo de <?= htmlspecialchars($specialiste->nom) ?>">
                        <div class="doctor-info">
                            <h3><?= htmlspecialchars($specialiste->nom . ' ' . $specialiste->prenom) ?></h3>
                            <p><?= htmlspecialchars($specialiste->specialite) ?></p>
                            <div class="actions">
                                <button class="btn" onclick="showCV('cv-<?= $specialiste->id ?>')">Voir CV</button>
                                <a href="Rendez_Vous_Client.php?id=<?= $specialiste->id ?>" class="btn">Prendre Rendez-vous</a>
                                <a href="Chat.php?id=<?= $specialiste->id ?>" class="btn">Chattez</a>
                            </div>
                            <div class="cv-container" id="cv-<?= $specialiste->id ?>">
                                <iframe class="cv-frame" src="<?= htmlspecialchars($specialiste->cv) ?>"></iframe>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun spécialiste en addictologie trouvé.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<footer>
    <div class="footer-content text-center">
        <p>Contactez-nous: <a href="mailto:email@medicare.com">email@medicare.com</a> | Tel: +33 1 23 45 67 89 | Adresse: 16 rue Sextius Michel, Paris, France</p>
    </div>
</footer>
<script>
    function showCV(id) {
        var cvContainer = document.getElementById(id);
        if (cvContainer.style.display === "none" || cvContainer.style.display === "") {
            cvContainer.style.display = "block";
        } else {
            cvContainer.style.display = "none";
        }
    }
</script>
</body>
</html>