    <?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Démarrez la session
    session_start();

    // Charger les données des médecins à partir du fichier XML
    $xmlFile = 'BDDmedicare.xml';
    $xml = simplexml_load_file($xmlFile);
    $administrateurs = $xml->administrateur;

    // Récupération des informations de connexion depuis le formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    // Vérifier les identifiants dans les données des médecins
    $connexion_reussie = false;
    foreach ($administrateurs as $administrateur) {
        if ($administrateur->email == $email && $administrateur->mot_de_passe == $mot_de_passe) {
            $connexion_reussie = true;
            // Stockez l'ID de l'admin dans une variable de session
            $_SESSION['administrateur_id'] = (string)$administrateur->id;
            break;
        }
    }

    if ($connexion_reussie) {
        // L'utilisateur est authentifié avec succès, rediriger vers la page d'accueil du médecin
        header('Location: Accueil_Administrateur.html');
        exit;
    } else {
        // L'utilisateur n'existe pas ou les identifiants sont incorrects
        echo "<p class='error'>Email ou mot de passe incorrect</p>";
    }
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
        input[type="password"] {
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
            background-color: #0073b1   ;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
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
                            <li><a href="I.S.T..php">I.S.T.</a></li>
                            <li><a href="Ostéopathie.php">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="Test_Labo.html">Test en Labo</a></li>
                </ul>
            </li>
            <li><a href="Rechercher.php">Recherche</a></li>
            <li><a href="Rendez_Vous.php">Rendez-vous</a></li>
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
<body>
    <div class="container">
        <h2>Connexion Administrateur</h2>

        <form action="" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>


    <script src="scripts.js"></script>
</body>
</html>


