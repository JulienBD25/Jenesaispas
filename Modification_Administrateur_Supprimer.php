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

// Si le formulaire pour supprimer un membre a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_member'])) {
    // Charger le fichier XML
    $xml = loadXMLFile($xmlFile);
    if ($xml !== false) {
        $nomToDelete = $_POST['nom'];
        $prenomToDelete = $_POST['prenom'];
        $emailToDelete = $_POST['email'];
        $found = false;

        // Rechercher et supprimer le membre
        foreach ($xml->personnels_sante as $index => $member) {
            if ((string)$member->Nom == $nomToDelete &&
                (string)$member->Prenom == $prenomToDelete &&
                (string)$member->email == $emailToDelete) {
                unset($xml->personnels_sante[$index]);
                $found = true;
                break;
            }
        }

        // Sauvegarder les modifications dans le fichier XML
        if ($found && $xml->asXML($xmlFile)) {
            // Afficher un message de succès
            echo "<p class='success'>Membre supprimé avec succès!</p>";
            header('Location: Accueil_Administrateur.html');
            exit();
        } else {
            if ($found) {
                echo "<p class='error'>Erreur lors de la sauvegarde du fichier XML.</p>";
            } else {
                echo "<p class='error'>Membre non trouvé.</p>";
            }
        }
    } else {
        echo "<p class='error'>Erreur lors du chargement du fichier XML.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare - Gérer le Personnel de Santé</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="icon" href="Images/Logo_icone.ico" type="image/x-icon">

    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            background-color: #0073b1;
            color: #fff;
            margin-bottom: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="email"],
        input[type="number"],
        input[type="text"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: all 0.3s ease-in-out;
        }

        input[type="email"]:focus,
        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus {
            border-color: #0073b1;
            box-shadow: 0 0 8px rgba(0, 115, 177, 0.2);
        }

        button[type="submit"] {
            background-color: #0073b1;
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #005f8c;
        }

        .success {
            color: green;
            margin-top: 10px;
            text-align: center;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .button-container {
            text-align: center;
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
            <li><a href="Accueil_Administrateur.html">Accueil</a></li>
            <li class="dropdown-menu">
            <li><a href="Tout_Parcourir.html">Tout Parcourir</a>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="showSpecialty('Médecine générale')">Médecins Généralistes</a></li>
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
            </li>
                <li><a href="Recherche.html">Recherche</a></li>
                <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
                <li><a href="Votre_Compte.html">Votre Compte</a>
                    <ul class="dropdown-menu">
                        <li><a href="Votre_Compte_Client_Se_Connecter.html">Votre profil</a></li>
                        <li><a href="Modification_Administrateur_Ajout.php">Ajouter un personnel de santé</a></li>
                          <li><a href="Modification_Administrateur_Supprimer.php">Supprimer un personnel de santé</a></li>
                        <li><a href="Accueil.php">Déconnexion</a></li>
                    </ul>
                </li>
            </li>
        </ul>
    </nav>
</header>

<main>
    <section>
        <div class="container">
            <h2>Supprimer un Personnel de Santé</h2>
            <form action="" method="post">
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div>
                    <label for="email">Adresse Mail</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="button-container">
                    <button type="submit" name="delete_member">Supprimer</button>
                </div>
            </form>
        </div>
    </section>

</main>

<footer>
    <div class="footer-content text-center">
        <p>Contactez-nous: <a href="mailto:email@medicare.com">email@medicare.com</a> | Tel: +33 1 23 45 67 89 | Adresse: 16 rue Sextius Michel, Paris, France</p>
    </div>
</footer>

<script src="scripts.js"></script>

</body>

</html>

