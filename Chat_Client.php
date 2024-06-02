<?php

session_start();

// Charger le contenu du fichier XML
$xml = simplexml_load_file('BDDmedicare.xml');

$personnel_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$specialite = isset($_GET['specialite']) ? htmlspecialchars($_GET['specialite']) : '';

$client_id = $_SESSION['client_id'];


// Fonction pour enregistrer un message
function saveMessageToXML($client_id, $personnel_id, $utilisateur, $contenu, $heure_envoie, $date_envoie) {
    global $xml;

    $messages = $xml->addChild('Messages');
    $messages->addChild('client_id', $client_id);
    $messages->addChild('personnel_id', $personnel_id);
    $messages->addChild('utilisateur', $utilisateur);
    $messages->addChild('contenu', $contenu);
    $messages->addChild('heure_envoie', $heure_envoie);
    $messages->addChild('date_envoie', $date_envoie);
    $messages->addChild('lu', 0); // Message non lu par défaut


    $xml->asXML('BDDmedicare.xml');

    // Retourner le contenu du message pour l'afficher dans le chat
    return $contenu;
}



// Enregistrer un nouveau message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
        // Appeler la fonction pour enregistrer le message et récupérer le contenu du message pour l'afficher dans le chat
        $response = saveMessageToXML($client_id, $personnel_id, 0, $message, date('H:i'), date('Y-m-d'));
        // Répondre avec le contenu du message pour l'affichage en temps réel dans le chat
        echo $response;
        exit();
    }
}

function loadPreviousMessages($client_id, $personnel_id) {
    global $xml;
    $messages = $xml->xpath("//Messages[client_id='$client_id' and personnel_id='$personnel_id']");
    $previousMessages = [];
    foreach ($messages as $message) {
        $utilisateur = (string)$message->utilisateur == '0' ? 'user' : 'doctor';
        $previousMessages[] = [
            'utilisateur' => $utilisateur,
            'contenu' => (string)$message->contenu
        ];
    }
    return $previousMessages;
}

// Charger les messages précédents avec ce médecin
$previousMessages = loadPreviousMessages($client_id, $personnel_id)

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
        .container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }
        .chat-container {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .chat-box {
            height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .chat-box .message {
            margin-bottom: 10px;
        }
        .chat-box .message.user {
            text-align: right;
            color: #007bff;
        }
        .chat-box .message.doctor {
            text-align: left;
            color: #28a745;
        }
        .chat-input-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #chat-input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        #chat-send {
            padding: 10px 20px;
            border-radius: 8px;
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
            <li><a href="Accueil_Client.php">Accueil</a></li>
            <li>
                <a href="Tout_Parcourir_Client.html">Tout Parcourir</a>
                <ul class="dropdown-menu">
                    <li><a href="Medecin_Generaliste_Client.php">Médecins Généralistes</a></li>
                    <li>
                        <a href="Medecins_specialistes_Client.php">Médecins Spécialistes</a>
                        <ul class="dropdown-submenu">
                            <li><a href="Addictologie_Client.php">Addictologie</a></li>
                            <li><a href="Andrologie_Client.php">Andrologie</a></li>
                            <li><a href="Cardiologie_Client.php">Cardiologie</a></li>
                            <li><a href="Dermatologie_Client.php">Dermatologie</a></li>
                            <li><a href="Gastro-Hépato-Entérologie_Client.php">Gastro-Hépato-Entérologie</a></li>
                            <li><a href="Gynécologie_Client.php">Gynécologie</a></li>
                            <li><a href="I.S.T._Client.php">I.S.T.</a></li>
                            <li><a href="Ostéopathie_Client.php">Ostéopathie</a></li>
                        </ul>
                    </li>
                    <li><a href="Test_Labo_Client.php">Test en Laboratoire</a></li>
                </ul>
            </li>
            <li><a href="Rechercher_Client.php">Recherche</a></li>
            <li><a href="Rendez_Vous_Client.php">Rendez-vous</a></li>
            <li><a href="Votre_Profil_Client.php">Votre Compte</a>
                <ul class="dropdown-menu">
                    <li><a href="Votre_Profil_Client.php">Votre Profil</a></li>
                    <li><a href="Accueil.php">Deconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<main>
    <div class="container">
        <h2>Discussion avec le Médecin <?php echo $nom ?></h2>
        <div class="chat-container">
            <div class="chat-box" id="chat-box">

            </div>
            <div class="chat-input-container">
                <input type="text" id="chat-input" placeholder="Écrire un message..." />
                <button id="chat-send" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
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

<script>
    document.getElementById('chat-send').addEventListener('click', function() {
        sendMessage();
    });

    document.getElementById('chat-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });


    // Charger les messages précédents
    document.addEventListener("DOMContentLoaded", function() {
        var previousMessages = <?php echo json_encode($previousMessages); ?>;
        previousMessages.forEach(function(message) {
            addMessageToChat(message.utilisateur, message.contenu);
        });
    });

    function sendMessage() {
        var input = document.getElementById('chat-input');
        var message = input.value.trim();
        if (message) {
            addMessageToChat('user', message);
            input.value = '';

            $.ajax({
                url: window.location.href,
                type: 'POST',
                data: {
                    message: message
                },

                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

            setTimeout(function () {
                addMessageToChat('doctor', 'Merci pour votre message. Comment puis-je vous aider?');
            }, 1000);
        }
    }


    function addMessageToChat(userType, message) {
        var chatBox = document.getElementById('chat-box');
        var messageElement = document.createElement('div');
        messageElement.classList.add('message', userType);
        messageElement.textContent = message;
        chatBox.appendChild(messageElement);
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
</body>

</html>
