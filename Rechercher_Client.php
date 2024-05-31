<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Définir le fichier XML
$xmlFile = 'BDDmedicare.xml';

// Fonction pour charger le fichier XML
function loadXMLFile($xmlFile) {
    if (file_exists($xmlFile)) {
        return simplexml_load_file($xmlFile);
    }
    return false;
}

// Fonction pour rechercher des membres et des services dans le fichier XML
function searchEntries($xml, $keyword) {
    $results = ['members' => [], 'services' => []];

    // Recherche dans les membres du personnel de santé
    foreach ($xml->personnels_sante as $member) {
        if (stripos($member->nom, $keyword) !== false ||
            stripos($member->specialite, $keyword) !== false) {
            $results['members'][] = $member;
        }
    }

    // Recherche dans les services de laboratoire
    foreach ($xml->Service_Laboratoire as $service) {
        if (stripos($service->nom_service, $keyword) !== false) {
            $results['services'][] = $service;
        }
    }

    return $results;
}

// Charger le fichier XML
$xml = loadXMLFile($xmlFile);
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
    <style>
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            background-color: #f4f4f4;
        }

        .search-box {
            display: flex;
            align-items: center;
            border: 2px solid #ccc;
            border-radius: 50px;
            overflow: hidden;
            background-color: white;
            width: 40%;
        }

        .search-box input {
            border: none;
            outline: none;
            padding: 10px 20px;
            font-size: 1.5rem;
            border-radius: 50px;
        }

        .search-box button {
            background-color: #0073b1;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 50px;
            font-size: 1.5rem;
            margin-left: 205px;
        }

        .search-box button:hover {
            background-color: #005f8c;
        }

        main {
            width: 90%;
            margin: 75px;
            margin-top: 50px;
            margin-bottom: 145px;
        }

        .client, .nom_service {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .client img {
            max-width: 100px;
            border-radius: 50%;
        }

        .client p, .nom_service p {
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .error {
            color: red;
            font-weight: bold;
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
<main>

    <section class="search-container">
        <div class="search-box">
            <form method="get" action="">
                <input type="text" placeholder="Nom ou Spécialité ou Etablissement" name="keyword" required>
                <button type="submit" name="research">Rechercher</button>
            </form>
        </div>
    </section>

    <?php
    if ($xml !== false) {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
            $keyword = htmlspecialchars($_GET['keyword']);
            $results = searchEntries($xml, $keyword);

            // Afficher les résultats de la recherche pour les membres du personnel de santé
            if (!empty($results['members'])) {
                echo "<h2>Résultats de la recherche pour le Personnel de Santé :</h2>";
                foreach ($results['members'] as $member) {
                    echo "<div class='client'>";
                    echo "<p>Nom: " . htmlspecialchars($member->nom) . "</p>";
                    echo "<p>Prénom: " . htmlspecialchars($member->prenom) . "</p>";
                    echo "<p>Email: " . htmlspecialchars($member->email) . "</p>";
                    echo "<p>Spécialité: " . htmlspecialchars($member->specialite) . "</p>";
                    echo "<p>Téléphone: " . htmlspecialchars($member->telephone) . "</p>";
                    echo "<p>Photo: <img src='" . htmlspecialchars($member->photo) . "' alt='Photo de " . htmlspecialchars($member->nom) . "' /></p>";
                    echo "<p>CV: <a href='" . htmlspecialchars($member->cv) . "'>Afficher le CV</a></p>";
                    echo "</div>";
                }
            }

            // Afficher les résultats de la recherche pour les services de laboratoire
            if (!empty($results['services'])) {
                echo "<h2>Résultats de la recherche pour les Services de Laboratoire :</h2>";
                foreach ($results['services'] as $service) {
                    echo "<div class='nom_service'>";
                    echo "<p>Nom du service: " . htmlspecialchars($service->nom_service) . "</p>";
                    echo "<p>Description: " . htmlspecialchars($service->description) . "</p>";
                    echo "</div>";
                }
            }

            if (empty($results['members']) && empty($results['services'])) {
                echo "<p>Aucun résultat trouvé pour '$keyword'.</p>";
            }
        }
    } else {
        echo "<p class='error'>Erreur lors du chargement du fichier XML.</p>";
    }
    ?>

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

<script src="scripts.js"></script>
</body>

</html>
