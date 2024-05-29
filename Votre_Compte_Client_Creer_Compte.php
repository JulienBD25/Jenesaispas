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

        // Vérifier si le chargement a réussi
        if ($xml !== false) {
            // Créer un nouvel élément pour le membre
            $newMember = $xml->client->addChild('membre');
            $newMember->addChild('carte_vitale', $_POST['carte_vitale']);
            $newMember->addChild('Nom', $_POST['Nom']);
            $newMember->addChild('Prenom', $_POST['Prenom']);
            $newMember->addChild('email', $_POST['email']);
            $newMember->addChild('mot_de_passe', $_POST['password']);
            $newMember->addChild('Adresse', $_POST['Adresse']);
            $newMember->addChild('Ville', $_POST['Ville']);
            $newMember->addChild('Pays', $_POST['Pays']);
            $newMember->addChild('Code_Postal', $_POST['Code_Postal']);
            $newMember->addChild('Telephone', $_POST['Telephone']);
            $newMember->addChild('Type_CB', $_POST['Type_CB']);
            $newMember->addChild('Numero_CB', $_POST['Numero_CB']);
            $newMember->addChild('Date_Expiration_CB', $_POST['Date_Expiration_CB']);
            $newMember->addChild('Code_Securite_CB', $_POST['Code_Securite_CB']);

            // Sauvegarder les modifications dans le fichier XML
            if ($xml->asXML($xmlFile)) {
                // Afficher un message de succès
                echo "<p class='success'>Membre ajouté avec succès!</p>";
                header('Location: Accueil_Client.html');
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
    <title>Medicare - Ajouter un Membre</title>
    <link rel="icon" href="Images/Logo_icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            background-color: #0073b1;
            color: #fff;
            margin-bottom: 15px;
            padding: 10px 20px;
            border-radius: 3px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #0073b1;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            display: block;
            width: 100%;
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
            <li><a href="Tout_Parcourir.html">Tout Parcourir</a></li>
            <li><a href="Recherche.html">Recherche</a></li>
            <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Client_Se_Connecter.php">Client</a></li>
                    <li><a href="Votre_Compte_Medecin_Se_Connecter.php">Médecins</a></li>
                    <li><a href="Votre_Compte_Administrateur_Se_Connecter.php">Administrateur</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<div class="container">
    <h2>Ajouter un Membre</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="carte_vitale">Carte Vitale</label>
            <input type="number" id="carte_vitale" name="carte_vitale" required>
        </div>
        <div>
            <label for="Nom">Nom</label>
            <input type="text" id="Nom" name="Nom" required>
        </div>
        <div>
            <label for="Prenom">Prénom</label>
            <input type="text" id="Prenom" name="Prenom" required>
        </div>
        <div>
            <label for="email_member">Adresse Mail</label>
            <input type="email" id="email_member" name="email" required>
        </div>
        <div>
            <label for="password_member">Mot de Passe</label>
            <input type="password" id="password_member" name="password" required>
        </div>
        <div>
            <label for="Adresse">Adresse</label>
            <input type="text" id="Adresse" name="Adresse" required>
        </div>
        <div>
            <label for="Ville">Ville</label>
            <input type="text" id="Ville" name="Ville" required>
        </div>
        <div>
            <label for="Pays">Pays</label>
            <input type="text" id="Pays" name="Pays" required>
        </div>
        <div>
            <label for="Code_Postal">Code Postal</label>
            <input type="number" id="Code_Postal" name="Code_Postal" required>
        </div>
        <div>
            <label for="Telephone">Téléphone</label>
            <input type="text" id="Telephone" name="Telephone" required>
        </div>
        <div>
            <label for="Type_CB">Type de carte bancaire</label>
            <select id="Type_CB" name="Type_CB" required>
                <option value="">Sélectionnez un type de carte</option>
                <option value="Visa">Visa</option>
                <option value="Mastercard">MasterCard</option>
                <option value="American Express">American Express</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>
        <div>
            <label for="Numero_CB">Numéro CB</label>
            <input type="text" id="Numero_CB" name="Numero_CB" required>
        </div>
        <div>
            <label for="Date_Expiration_CB">Date d'Expiration CB</label>
            <input type="date" id="Date_Expiration_CB" name="Date_Expiration_CB" required>
        </div>
        <div>
            <label for="Code_Securite_CB">Code Sécurité CB</label>
            <input type="text" id="Code_Securite_CB" name="Code_Securite_CB" required>
        </div>
        <button type="submit" name="add_member">Ajouter Membre</button>
    </form>
</div>
</body>
</html>
