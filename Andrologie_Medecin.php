<?php

// Charger les données des médecins à partir du fichier XML
$xmlFile = 'BDDmedicare.xml';
$xml = simplexml_load_file($xmlFile);

if ($xml === false) {
    die('Erreur de chargement du fichier XML.');
}

$andrologie = [];
foreach ($xml->personnels_sante as $personnel) {
    $specialite = (string) $personnel->specialite;
    $specialite_trimmed = trim($specialite);
    $specialite_lower = strtolower($specialite_trimmed);

    if ($specialite_lower == 'andrologie') {
        $andrologie[] = $personnel;
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
                    <li><a href="Votre_Profil_Medecin.php">Votre Profil</a></li>
                    <li><a href="Accueil.php">Deconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<main class="container">
    <section>
        <h2 class="specialists-title">Nos médecins spécialistes en andrologie :</h2>
        <div class="doctor-container">
            <?php if (!empty($andrologie)): ?>
                <?php foreach ($andrologie as $specialiste): ?>
                    <div class="doctor">
                        <img src="<?= htmlspecialchars($specialiste->photo) ?>" alt="Photo de <?= htmlspecialchars($specialiste->nom) ?>">
                        <div class="doctor-info">
                            <h3><?= htmlspecialchars($specialiste->nom . ' ' . $specialiste->prenom) ?></h3>
                            <p><?= htmlspecialchars($specialiste->specialite) ?></p>
                            <div class="actions">
                                <button class="btn" onclick="showCV('cv-<?= $specialiste->id ?>')">Voir CV</button>
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
    <div class="footer-content">
        <ul>
            <li><i class="fas fa-envelope"></i> <a href="mailto:email@medicare.com">email@medicare.com</a></li>
            <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
            <li><i class="fas fa-map-marker-alt"></i> 16 rue Sextius Michel, Paris, France</li>
        </ul>
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
