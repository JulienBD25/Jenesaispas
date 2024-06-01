<?php

// Charger le contenu du fichier XML
$xml = simplexml_load_file('BDDmedicare.xml');

// Récupérer les informations du médecin à partir de l'URL
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$specialite = isset($_GET['specialite']) ? htmlspecialchars($_GET['specialite']) : '';

// Fonction pour récupérer tous les rendez-vous du médecin
function getDoctorAppointments($xml, $doctor_id) {
    $appointments = [];
    foreach ($xml->Rendez_Vous as $rdv) {
        if ((int)$rdv->personnel_id == $doctor_id) {
            $appointment = [];
            $appointment['jour'] = (int)$rdv->jour;
            $appointment['heure'] = (string)$rdv->heure;
            $appointments[] = $appointment;
        }
    }
    return $appointments;
}

// Appeler la fonction pour obtenir tous les rendez-vous du médecin
$appointments = getDoctorAppointments($xml, $id);


// Définir les créneaux horaires disponibles pour chaque jour de la semaine
$availableSlots = [];

// Boucle pour chaque jour de la semaine
for ($day = 1; $day <= 5; $day++) {
    // Créneaux du matin (8h00 - 12h00)
    $availableSlots[$day]['AM'] = [];
    // Créneaux de l'après-midi (13h00 - 17h00)
    $availableSlots[$day]['PM'] = [];

    // Parcourir les disponibilités des médecins pour ce jour
    foreach ($xml->disponibilite as $dispo) {
        if ((int)$dispo->personnel_id == $id && (int)$dispo->jour == $day) {
            // Ajouter les créneaux disponibles en fonction de la disponibilité du médecin
            if ((int)$dispo->matin == 1) {
                for ($hour = 8; $hour < 12; $hour++) {
                    $time = sprintf("%02d:00", $hour);
                    $availableSlots[$day]['AM'][] = $time;
                }
            }
            if ((int)$dispo->apres_midi == 1) {
                for ($hour = 13; $hour < 17; $hour++) {
                    $time = sprintf("%02d:00", $hour);
                    $availableSlots[$day]['PM'][] = $time;
                }
            }
            break; // Sortir de la boucle dès que les disponibilités du médecin pour ce jour sont trouvées
        }
    }
}

// Vérifie si un rendez-vous est envoyé en POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['day']) && isset($_POST['slot'])) {
    $day = $_POST['day'];
    $slot = $_POST['slot'];
    $patientID = uniqid(); // Générer un ID unique pour le patient (peut être amélioré)

    // Trouver le plus grand ID existant
    $maxID = 0;
    foreach ($xml->Rendez_Vous as $rdv) {
        $idrdv = (int)$rdv->id;
        if ($idrdv > $maxID) {
            $maxID = $idrdv;
        }
    }

    // Incrémenter l'ID pour obtenir le nouvel ID
    $newID = $maxID + 1;

    // Ajouter le rendez-vous au XML avec le nouvel ID
    $newAppointment = $xml->addChild('Rendez_Vous');
    $newAppointment->addChild('id', $newID); // Utiliser le nouvel ID
    $newAppointment->addChild('client_id', $patientID); // ID du patient
    $newAppointment->addChild('personnel_id', $id); // ID du médecin
    $newAppointment->addChild('jour', $day); // Jour du rendez-vous
    $newAppointment->addChild('heure', $slot); // Heure du rendez-vous
    $newAppointment->addChild('status', '1'); // Statut du rendez-vous (peut être modifié selon les besoins)

    // Convertir le SimpleXMLElement en chaîne XML formatée
    $xmlString = $xml->asXML();

    // Créer un nouveau document DOM à partir de la chaîne XML
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xmlString);

    // Sauvegarder les modifications dans le fichier XML
    $dom->save('BDDmedicare.xml');
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
    <script>
        $(document).ready(function() {
            $(".time-slot.available").click(function() {
                var slot = $(this).text().trim(); // Récupérer l'heure du créneau
                var day = $(this).closest("td").index() - 1; // Récupérer l'indice du jour
                var doctorID = "<?php echo $id; ?>"; // Récupérer l'ID du médecin
                var patientID = "<?php echo uniqid(); ?>"; // Générer un ID unique pour le patient (peut être amélioré)
                // Envoyer les données à un script PHP pour enregistrer le rendez-vous
                $.post("", { day: day, slot: slot, doctor_id: doctorID, patient_id: patientID }, function(data) {

                    alert("Rendez-vous pris avec succès à " + slot + " !");
                    // Recharger la page pour afficher les mises à jour
                    location.reload();

                });
            });
        });
    </script>
    <style>
        /* Style général des boutons */
        .time-slot {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Style des boutons disponibles */
        .time-slot.available {
            background-color: #4CAF50;
            color: white;
        }

        /* Style des boutons non disponibles */
        .time-slot.unavailable {
            background-color: #f44336;
            color: white;
        }

        /* Effet au survol */
        .time-slot:hover {
            opacity: 0.8;
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
            <li>
                <a href="Tout_Parcourir.html">Tout Parcourir</a>
                <ul class="dropdown-menu">
                    <li><a href="Medecin_Generaliste_Client.php">Médecins Généralistes</a></li>
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
            <li><a href="Recherche.html">Recherche</a></li>
            <li><a href="Rendez_Vous.html">Rendez-vous</a></li>
            <li><a href="Accueil.html">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Compte_Client_Se_Connecter.html">Client</a></li>
                    <li><a href="Votre_Compte_Medecin_Se_Connecter.html">Médecins</a></li>
                    <li><a href="Votre_Compte_Administrateur_Se_Connecter.html">Administrateur</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>


<main>
    <div class="container">
        <h2>Prendre rendez-vous</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Specialité</th>
                <th>Médecin</th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
            </tr>
            </thead>
            <tbody>

            <?php
            // Afficher les informations du médecin
            echo "<tr>
                <td>$specialite</td>
                <td>$nom</td>";

            // Parcourir les jours de la semaine et générer les créneaux disponibles
            foreach ($availableSlots as $day => $slots) {
                echo "<td>";

                // Créneaux du matin
                echo "<div class='time-slots-morning'>";
                if (empty($slots['AM'])) {
                    echo "Indisponible<br>";
                } else {
                    foreach ($slots['AM'] as $slot) {
                        $slotIsAvailable = true;
                        foreach ($appointments as $appointment) {
                            if ($appointment['jour'] == $day && $appointment['heure'] == $slot) {
                                $slotIsAvailable = false;
                                break;
                            }
                        }
                        if ($slotIsAvailable) {
                            echo "<button class=\"time-slot available\" data-slot=\"$slot\">$slot</button><br>";
                        } else {
                            echo "<button class=\"time-slot unavailable\" disabled data-slot=\"$slot\">$slot (Pris)</button><br>";
                        }
                    }
                }
                echo "</div>";


                // Ajout d'une ligne horizontale entre les créneaux du matin et de l'après-midi
                echo "<hr>";

                // Créneaux de l'après-midi
                echo "<div class='time-slots-afternoon'>";
                if (empty($slots['PM'])) {
                    echo "Indisponible<br>";
                } else {
                    foreach ($slots['PM'] as $slot) {
                        $slotIsAvailable = true;
                        foreach ($appointments as $appointment) {
                            if ($appointment['jour'] == $day && $appointment['heure'] == $slot) {
                                $slotIsAvailable = false;
                                break;
                            }
                        }
                        if ($slotIsAvailable) {
                            echo "<button class=\"time-slot available\" data-slot=\"$slot\">$slot</button><br>";
                        } else {
                            echo "<button class=\"time-slot unavailable\" disabled data-slot=\"$slot\">$slot (Pris)</button><br>";
                        }
                    }
                }
                echo "</div>";


                echo "</td>";
            }
            ?>



            </tbody>
        </table>
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

<script src="scripts.js"></style>
</body>
</html>

