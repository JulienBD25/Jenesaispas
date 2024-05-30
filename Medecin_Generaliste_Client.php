<?php

$host = 'localhost:8889';
$db = 'Medicare';
$user = 'votre_utilisateur';
$pass = 'votre_mot_de_passe';

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
    <title>Nos Spécialistes</title>
    <style>
        .specialists-title {
            text-align: center;
            color: blue;
        }
        .button-container {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            color: blue;
            border: 2px solid blue;
            border-radius: 5px;
            margin: 10px 10px;
        }
        .btn:hover {
            background-color: blue;
            color: white;
        }
    </style>
</head>
<body>
<section>
    <h2 class="specialists-title">Nos Médecins Généralistes :</h2>
    <div class="button-container">
        <?php foreach ($generalistes as $generaliste): ?>
            <p><a href="personnel.php?id=<?= $generaliste['id'] ?>" class="btn"><?= htmlspecialchars($generaliste['nom'] . ' ' . $generaliste['prenom']) ?></a></p>
        <?php endforeach; ?>
    </div>
</section>
</body>
</html>
