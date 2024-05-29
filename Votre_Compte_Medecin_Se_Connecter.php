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
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
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
            <li><a href="Accueil.html">Accueil</a></li>
            <li><a href="Tout_Parcourir.html">Tout Parcourir</a></li>
            <li><a href="Recherche.html">Recherche</a></li>
            <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Client_Se_Connecter.html">Client</a></li>
                    <li><a href="Votre_Compte_Medecin_Se_Connecter.html">Médecins</a></li>
                    <li><a href="Votre_Compte_Administrateur_Se_Connecter.html">Administrateur</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<body>
    <div class="container">
        <h2>Connexion Médecin</h2>

        <?php
        // Vérifiez si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Charger les données des médecins à partir du fichier XML
            $xmlFile = 'BDDmedicare.xml';
            $xml = simplexml_load_file($xmlFile);
            $medecins = $xml->personnels_sante;

            // Récupération des informations de connexion depuis le formulaire
            $email = $_POST['email'];
            $mot_de_passe = $_POST['password'];

            // Vérifier les identifiants dans les données des médecins
            $connexion_reussie = false;
            foreach ($medecins as $medecin) {
                if ($medecin->email == $email && $medecin->mot_de_passe == $mot_de_passe) {
                    $connexion_reussie = true;
                    break;
                }
            }

            if ($connexion_reussie) {
                // L'utilisateur est authentifié avec succès, rediriger vers la page d'accueil du médecin
                header('Location: Accueil_Medecin.html');
                exit;
            } else {
                // L'utilisateur n'existe pas ou les identifiants sont incorrects
                echo "<p class='error'>Email ou mot de passe incorrect</p>";
            }
        }
        ?>

        <form action="" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
