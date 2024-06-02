<?php

// Démarrer la session
session_start();

// Vérifier si l'ID de l'utilisateur est défini dans la session
// if(isset($_SESSION['client_id'])) {
//     echo "ID de l'utilisateur : " . $_SESSION['client_id'];
// } else {
//     echo "ID de l'utilisateur non trouvé dans la session.";
// }

// Charger le contenu du fichier XML
$xml = simplexml_load_file('BDDmedicare.xml');

// Accéder aux informations stockées dans la session pour le client
$id = $_SESSION['client_id'];

// Fonction pour récupérer les rendez-vous du client
function getPatientAppointments($xml, $patient_id) {
    $appointments = [];
    foreach ($xml->Rendez_Vous as $rdv) {
        if ((int)$rdv->client_id == $patient_id) {
            $appointment = [];
            $appointment['id'] = (int)$rdv->id;
            $appointment['personnel_id'] = (int)$rdv->personnel_id;
            $appointment['jour'] = (int)$rdv->jour;
            $appointment['heure'] = (string)$rdv->heure;
            $appointment['status'] = (int)$rdv->status;

            // Rechercher les informations du personnel
            foreach ($xml->personnels_sante as $personnel) {
                if ((int)$personnel->id == $appointment['personnel_id']) {
                    $appointment['personnel_nom'] = (string)$personnel->nom;
                    $appointment['personnel_prenom'] = (string)$personnel->prenom;
                    $appointment['personnel_specialite'] = (string)$personnel->specialite;
                    break;
                }
            }

            $appointments[] = $appointment;
        }
    }
    return $appointments;
}

// Traitement de l'annulation du rendez-vous
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_appointment'])) {
    $appointment_id = (int)$_POST['appointment_id'];

    foreach ($xml->Rendez_Vous as $rdv) {
        if ((int)$rdv->id == $appointment_id && (int)$rdv->client_id == $id) {
            $rdv->status = 0; // Mettre à jour le statut à "0" pour annuler le rendez-vous
            break;
        }
    }

    // Sauvegarder les modifications dans le fichier XML
    $xml->asXML('BDDmedicare.xml');

    // Rediriger pour éviter le rechargement du formulaire
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Appeler la fonction pour obtenir les rendez-vous du client
$appointments = getPatientAppointments($xml, $id);

// Fonction pour traduire les noms des jours de l'anglais au français
function translateDay($english_day) {
    $english_days = array(
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
        'Sunday' => 'Dimanche'
    );

    return $english_days[$english_day];
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de Rendez-vous - Medicare</title>
    <link rel="icon" href="Images/Logo_icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

        main {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 20px;
        }

        main h2 {
            font-size: 40px;
            margin-bottom: 20px;
            color: #333;
        }
        .cancel-btn {
            font-size: 15px; /* ou toute autre taille de police souhaitée */
        }

        .list-group-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            padding: 15px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
            border-color: #ccc;
        }

        .list-group-item strong {
            color: #007bff;
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
                    <li><a href="Médecine_générale_Client.php">Médecins Généralistes</a></li>
                    <li>
                        <a href="#">Médecins Spécialistes</a>
                        <ul class="dropdown-submenu">
                            <li><a href="Addictologie_Client.php">Addictologie</a></li>
                            <li><a href="Andrologie_Client.php">Andrologie</a></li>
                            <li><a href="Cardiologie_Client.php">Cardiologie</a></li>
                            <li><a href="Dermatologie_Client.php">Dermatologie</a></li>
                            <li><a href="Gastro-Hépato-Entérologie_Client.php">Gastro-Hépato-Entérologie</a></li>
                            <li><a href="Gynécologie_Client.php">Gynécologie</a></li>
                            <li><a href="IST_Client.php">I.S.T.</a></li>
                            <li><a href="Ostéopathie_Client.php">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="Test_Labo_Client.php">Test en Labo</a></li>
                </ul>
            </li>
            <li><a href="Recherche.html">Recherche</a></li>
            <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
            <li><a href="Votre_Compte.html">Votre Compte</a></li>
        </ul>
    </nav>
</header>


<main>
    <div class="container">
        <h2>Vos rendez-vous</h2>
        <?php if (!empty($appointments)): ?>
            <ul class="list-group">
                <?php foreach ($appointments as $appointment): ?>
                    <li class="list-group-item">
                        <strong>Personnel et Spécialité :</strong> <?= $appointment['personnel_nom'] . " " . $appointment['personnel_prenom'] . " - " . $appointment['personnel_specialite'] ?>,
                        <strong>Jour :</strong> <?= translateDay(date('l', strtotime("Sunday +{$appointment['jour']} days"))) ?>,
                        <strong>Heure :</strong> <?= $appointment['heure'] ?>,
                        <strong>Statut :</strong> <?= ($appointment['status'] == 1) ? "Confirmé" : "Annulé" ?>

                        <?php if ($appointment['status'] == 1): // Afficher le bouton "Annuler" seulement si le rendez-vous est confirmé ?>
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                                <button type="submit" name="cancel_appointment" class="btn btn-danger btn-sm cancel-btn">Annuler</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun rendez-vous trouvé.</p>
        <?php endif; ?>
    </div>
</main>




<footer>
    <div class="footer-content">
        <ul>
            <li><i class="fas fa-envelope"></i> <a href="mailto:email@medicare.com">email@medicare.com</a></li>
            <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
            <li><i class="fas fa-map-marker-alt"></i> 16 rue Sextius Michel, Paris, France</li>
        </ul>
        <div id="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5250.742223981441!2d2.285609375121745!3d48.85113330121908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b49fa6195%3A0x7e3a16fc394bc943!2s16%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1716811550264!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</footer>

<script src="scripts.js"></script>
</body>
</html>
