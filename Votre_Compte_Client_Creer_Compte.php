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
            $newMember = $xml->addChild('client');
            $newMember->addChild('nom', $_POST['nom']);
            $newMember->addChild('prenom', $_POST['prenom']);
            $newMember->addChild('adresse', $_POST['adresse']);
            $newMember->addChild('ville', $_POST['ville']);
            $newMember->addChild('code_postal', $_POST['code_postal']);
            $newMember->addChild('pays', $_POST['pays']);
            $newMember->addChild('telephone', $_POST['telephone']);
            $newMember->addChild('email', $_POST['email']);
            $newMember->addChild('mot_de_passe', $_POST['mot_de_passe']);
            $newMember->addChild('carte_vitale', $_POST['carte_vitale']);
            $newMember->addChild('type_carte_paiement', $_POST['type_carte_paiement']);
            $newMember->addChild('numero_carte', $_POST['numero_carte']);
            $newMember->addChild('nom_carte', $_POST['nom_carte']);
            $newMember->addChild('date_expiration_carte', $_POST['date_expiration_carte']);
            $newMember->addChild('code_securite_carte', $_POST['code_securite_carte']);


            // Convertir le SimpleXMLElement en chaîne XML formatée
            $xmlString = $xml->asXML();

            // Créer un nouveau document DOM à partir de la chaîne XML
            $dom = new DOMDocument;
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xmlString);

            // Sauvegarder les modifications dans le fichier XML
            $dom->save('BDDmedicare.xml');

            header('Location: Accueil_Client.php');
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
            <li><a href="Accueil.php">Accueil</a></li>
            <li>
                <a href="Tout_Parcourir.html">Tout Parcourir</a>
                <ul class="dropdown-menu">
                    <li><a href="Medecin_Generaliste.php">Médecins Généralistes</a></li>
                    <li>
                        <a href="Medecins_specialistes.php">Médecins Spécialistes</a>
                        <ul class="dropdown-submenu">
                            <li><a href="Addictologie.php">Addictologie</a></li>
                            <li><a href="Andrologie.php">Andrologie</a></li>
                            <li><a href="Cardiologie.php">Cardiologie</a></li>
                            <li><a href="Dermatologie.php">Dermatologie</a></li>
                            <li><a href="Gastro-Hépato-Entérologie.php">Gastro-Hépato-Entérologie</a></li>
                            <li><a href="Gynécologie.php">Gynécologie</a></li>
                            <li><a href="I.S.T.php">I.S.T.</a></li>
                            <li><a href="Ostéopathie.php">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="Test_Labo.php">Test en Labo</a></li>
                </ul>
            </li>
            <li><a href="Rechercher.php">Recherche</a></li>
            <li><a href="Rendez_Vous.php">Rendez-vous</a></li>
            <li><a href="Votre_Compte_Client.html">Votre Compte</a>
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
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" required>
        </div>
        <div>
            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" required>
        </div>
        <div>
            <label for="code_postal">Code Postal</label>
            <input type="number" id="code_postal" name="code_postal" required>
        </div>
        <div>
            <label for="pays">Pays</label>
            <input type="text" id="pays" name="pays" required>
        </div>
        <div>
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" required>
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
            <label for="carte_vitale">Carte Vitale</label>
            <input type="number" id="carte_vitale" name="carte_vitale" required>
        </div>
        <div>
            <label for="type_carte_paiement">Type de carte bancaire</label>
            <select id="type_carte_paiement" name="type_carte_paiement" required>
                <option value="">Sélectionnez un type de carte</option>
                <option value="Visa">Visa</option>
                <option value="Mastercard">MasterCard</option>
                <option value="American Express">American Express</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>
        <div>
            <label for="numero_carte">Numéro CB</label>
            <input type="text" id="numero_carte" name="numero_carte" required>
        </div>
        <div>
            <label for="nom_carte">Nom sur la carte</label>
            <input type="text" id="nom_carte" name="nom_carte" required>
        </div>
        <div>
            <label for="date_expiration_carte">Date d'Expiration CB</label>
            <input type="date" id="date_expiration_carte" name="date_expiration_carte" required>
        </div>
        <div>
            <label for="code_securite_carte">Code Sécurité CB</label>
            <input type="text" id="code_securite_carte" name="code_securite_carte" required>
        </div>
        <button type="submit" name="add_member">Ajouter Membre</button>
    </form>
</div>

</body>
</html>
