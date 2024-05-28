<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM clients WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, redirect to existing user page
        header("Location: Accueil_Client.html");
    } else {
        // User does not exist, redirect to new account creation page
        header("Location: Votre_Compte_Client_Creer_Compte.html");
    }

    $stmt->close();
}

$conn->close();
?>
