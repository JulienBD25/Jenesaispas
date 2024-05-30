<?php

$host = 'localhost:3306';
$db = 'Medicare';
$user = 'root@localhost';
$pass = '';

// Connexion à la base de données
$mysqli = new mysqli($host, $user, $pass, $db);

// Vérification de la connexion
if ($mysqli->connect_error) {
    die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Récupération des médecins généralistes
$query_generalistes = "SELECT * FROM Personnels_Sante WHERE specialite = 'généraliste'";
$result_generalistes = $mysqli->query($query_generalistes);

// Vérifier si la requête a réussi
if ($result_generalistes === false) {
    die('Erreur de requête : ' . $mysqli->error);
}

// Récupération des résultats
$generalistes = [];
while ($row = $result_generalistes->fetch_assoc()) {
    $generalistes[] = $row;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Médecins Généralistes</title>
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
            flex-direction: column;
            gap: 0.5rem;
        }
        .btn-cv {
            padding: 0.5rem 1rem;
            background-color: #0073b1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-cv:hover {
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
        <h2 class="specialists-title">Nos Médecins Généralistes :</h2>
        <div class="doctor-container">
            <?php foreach ($generalistes as $generaliste): ?>
                <div class="doctor">
                    <img src="<?= htmlspecialchars($generaliste['photo']) ?>" alt="Photo de <?= htmlspecialchars($generaliste['nom']) ?>">
                    <div class="doctor-info">
                        <h3><?= htmlspecialchars($generaliste['nom'] . ' ' . $generaliste['prenom']) ?></h3>
                        <p><?= htmlspecialchars($generaliste['specialite']) ?></p>
                        <button class="btn-cv" onclick="showCV('cv-<?= $generaliste['id'] ?>')">Voir CV</button>
                        <div class="cv-container" id="cv-<?= $generaliste['id'] ?>">
                            <iframe class="cv-frame" src="<?= htmlspecialchars($generaliste['cv']) ?>"></iframe>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<footer>
    <div class="footer-content text-center">
        <p>Contactez-nous: <a href="mailto:email@medicare.com">email@medicare.com</a> | Tel: +33 1 23 45 67 89 | Adresse: 16 rue Sextius Michel, Paris, France</p>
        <div id="map-container">
            <iframe src="https://maps.google.com/maps?q=16%20rue%20Sextius%20Michel,%20Paris,%20France&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
        </div>
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