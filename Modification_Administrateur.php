<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Si le formulaire pour ajouter un membre a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_member'])) {
    // Définir le fichier XML
    $xmlFile = 'BDDmedicare.xml';

    // Vérifier si le fichier XML existe
    if (file_exists($xmlFile)) {
        // Charger le fichier XML
        $xml = simplexml_load_file($xmlFile);
        if ($xml !== false) {
            // Créer un nouvel élément pour le membre
            $newMember = $xml->addChild('personnels_sante');
            $newMember->addChild('Nom', $_POST['Nom']);
            $newMember->addChild('Prenom', $_POST['Prenom']);
            $newMember->addChild('email', $_POST['email']);
            $newMember->addChild('mot_de_passe', $_POST['password']);
            $newMember->addChild('specialite', $_POST['specialite']);
            $newMember->addChild('photo', $_POST['photo']);
            $newMember->addChild('cv', $_POST['cv']);
            $newMember->addChild('telephone', $_POST['telephone']);


            // Sauvegarder les modifications dans le fichier XML
            if ($xml->asXML($xmlFile)) {
                // Afficher un message de succès
                echo "<p class='success'>Membre ajouté avec succès!</p>";
                header('Location: Accueil_Administrateur.html');
                exit();
            } else {
                echo "<p class='error'>Erreur lors de la sauvegarde du fichier XML.</p>";
            }
        } else {
            echo "<p class='error'>Erreur lors du chargement du fichier XML.</p>";
        }
    } else {
        echo "<p class='error'>Le fichier XML n'existe pas.</p>";
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
            <li class="dropdown-menu">
            <li><a href="Tout_Parcourir.html">Tout Parcourir</a></li>
            <li><a href="Recherche.html">Recherche</a></li>
            <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Client_Se_Connecter.html">Client</a></li>
                    <li><a href="Votre_Compte_Medecin_Se_Connecter.html">Médecins</a></li>
                    <li><a href="Votre_Compte_Administrateur_Se_Connecter.html">Administrateur</a></li>
                    <li><a href="Modification_Administrateur.php">Ajouter ou supprimer un personnel de santé</a></li>
                </ul>
            </li>
            </li>
        </ul>
    </nav>
</header>

<main>
    <section>
        <h1>Ajouter un Personnel de Santé</h1>
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
            <div>
                <label for="mot_de_passe">Mot de Passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <div>
                <label for="specialite">Spécialité</label>
                <input type="text" id="specialite" name="specialite" required>
            </div>
            <div>
                <label for="photo">Photo (nom du fichier)</label>
                <input type="file" id="photo" name="photo" required>
            </div>
            <div>
                <label for="cv">CV (nom du fichier)</label>
                <input type="file" id="cv" name="cv" required>
            </div>
            <div class="button-container">
                <input type="submit" name="ajouter" value="Ajouter">
            </div>
        </form>
    </section>

    <section>
        <h1>Supprimer un Personnel de Santé</h1>
        <form action="" method="post">
            <div>
                <label for="email_supp">Adresse Mail du Personnel à Supprimer</label>
                <input type="email" id="email_supp" name="email_supp" required>
            </div>
            <div class="button-container">
                <input type="submit" name="supprimer" value="Supprimer">
            </div>
        </form>
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

<script src="scripts.js"></script>


</body>

</html>
