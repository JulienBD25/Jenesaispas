<?php
$error_message = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Load XML file
    $xmlFile = 'medicare.xml';
    $xml = simplexml_load_file($xmlFile);

    // Extract database credentials
    $servername = (string) $xml->servername;
    $username = (string) $xml->username;
    $password = (string) $xml->password;
    $dbname = (string) $xml->dbname;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query
    $sql = "SELECT * FROM personnels_sante WHERE email = ? AND mot_de_passe = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ss", $email, $mot_de_passe);

    // Execute statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // User authenticated, redirect to admin homepage
        header('Location: Accueil_Medecin.html');
        exit();
    } else {
        // Authentication failed, set error message
        $error_message = "Adresse e-mail ou mot de passe incorrect.";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
