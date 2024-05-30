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
if ($xml !== false) {
    // Si une recherche a été effectuée
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $results = searchEntries($xml, $keyword);

        // Afficher les résultats de la recherche pour les membres du personnel de santé
        if (!empty($results['members'])) {
            echo "<h2>Résultats de la recherche pour le personnel de santé :</h2>";
            foreach ($results['members'] as $member) {
                echo "<div class='client'>";
                echo "<p>Nom: " . htmlspecialchars($member->nom) . "</p>";
                echo "<p>Prénom: " . htmlspecialchars($member->prenom) . "</p>";
                echo "<p>Email: " . htmlspecialchars($member->email) . "</p>";
                echo "<p>Spécialité: " . htmlspecialchars($member->specialite) . "</p>";
                echo "<p>Téléphone: " . htmlspecialchars($member->telephone) . "</p>";
                echo "<p>Photo: <img src='" . htmlspecialchars($member->photo) . "' alt='Photo de " . htmlspecialchars($member->nom) . "' /></p>";
                echo "<p>CV: <a href='" . htmlspecialchars($member->cv) . "'>Télécharger le CV</a></p>";
                echo "</div>";
            }
        }

        // Afficher les résultats de la recherche pour les services de laboratoire
        if (!empty($results['services'])) {
            echo "<h2>Résultats de la recherche pour les services de laboratoire :</h2>";
            foreach ($results['services'] as $service) {
                echo "<div class='nom_service'>";
                echo "<p>ID: " . htmlspecialchars($service->id) . "</p>";
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
            <li><a href="Tout_Parcourir_Client.html">Tout Parcourir</a></li>
            <li><a href="Rechercher_Client.php">Recherche</a></li>
            <li><a href="Rendez_Vous_Client.html">Rendez-vous</a></li>
            <li><a href="Accueil_Client.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Client_Se_Connecter.php">Votre Profil</a></li>
                    <li><a href="Accueil.html">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<main>

    <!------------------------  A Remplir  ------------------------>

    <section class="search-container">
        <div class="search-box">
            <form method="get" action="">
                <input type="text" placeholder="Nom ou Spécialité ou Etablissement" name="keyword" required>
                <button type="submit" name="research">Rechercher</button>
            </form>
        </div>
    </section>

    <!------------------------             ------------------------>

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
