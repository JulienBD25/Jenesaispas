<!DOCTYPE html>
<html>
<head>
    <title>Gestion de la bibliothèque</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #dff0d8;
            border: 1px solid #3c763d;
            color: #3c763d;
            border-radius: 3px;
        }
        .error {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
    </style>
</head>
<body>
<h1>Bibliothèque</h1>

<?php
$database = "livres";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    if(isset($_POST['button1'])) { // Recherche
        $titre = mysqli_real_escape_string($db_handle, $_POST['Titre']);
        $auteur = mysqli_real_escape_string($db_handle, $_POST['Auteur']);
        $annee = mysqli_real_escape_string($db_handle, $_POST['Annee']);
        $editeur = mysqli_real_escape_string($db_handle, $_POST['Editeur']);

        $sql = "SELECT * FROM books WHERE 1=1";
        if (!empty($titre)) $sql .= " AND Titre LIKE '%$titre%'";
        if (!empty($auteur)) $sql .= " AND Auteur LIKE '%$auteur%'";
        if (!empty($annee)) $sql .= " AND Annee LIKE '%$annee%'";
        if (!empty($editeur)) $sql .= " AND Editeur LIKE '%$editeur%'";
    } elseif(isset($_POST['button2'])) { // Ajout
        $titre = mysqli_real_escape_string($db_handle, $_POST['Titre']);
        $auteur = mysqli_real_escape_string($db_handle, $_POST['Auteur']);
        $annee = mysqli_real_escape_string($db_handle, $_POST['Annee']);
        $editeur = mysqli_real_escape_string($db_handle, $_POST['Editeur']);
        $couverture = mysqli_real_escape_string($db_handle, $_POST['Couverture']);

        if (empty($titre)) {
            echo "<div class='message error'>Veuillez saisir le titre du livre.</div>";
        } else {
            // Vérification si le livre existe déjà
            $sql_check_duplicate = "SELECT * FROM books WHERE Titre = '$titre'";
            $result_check_duplicate = mysqli_query($db_handle, $sql_check_duplicate);

            if (mysqli_num_rows($result_check_duplicate) > 0) {
                // Livre déjà existant
                echo "<div class='message error'>Impossible d'ajouter. Ce livre existe déjà.</div>";
            } else {
                // Ajouter le livre à la base de données
                if (!empty($annee)) {
                    $sql_add_book = "INSERT INTO books (Titre, Auteur, Annee, Editeur, Couverture) VALUES ('$titre', '$auteur', '$annee', '$editeur', '$couverture')";
                } else {
                    $sql_add_book = "INSERT INTO books (Titre, Auteur, Editeur, Couverture) VALUES ('$titre', '$auteur', '$editeur', '$couverture')";
                }

                $result_add_book = mysqli_query($db_handle, $sql_add_book);
                if ($result_add_book) {
                    echo "<div class='message'>Livre ajouté avec succès.</div>";

                    // Affichage du livre ajouté
                    $last_insert_id = mysqli_insert_id($db_handle);
                    $sql_show_book = "SELECT * FROM books WHERE ID = $last_insert_id";
                    $result_show_book = mysqli_query($db_handle, $sql_show_book);
                    if ($result_show_book && mysqli_num_rows($result_show_book) > 0) {
                        $data = mysqli_fetch_assoc($result_show_book);
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Année</th><th>Editeur</th><th>Couverture</th></tr>";
                        echo "<tr>";
                        echo "<td>" . $data['ID'] . "</td>";
                        echo "<td>" . $data['Titre'] . "</td>";
                        echo "<td>" . $data['Auteur'] . "</td>";
                        echo "<td>" . $data['Annee'] . "</td>";
                        echo "<td>" . $data['Editeur'] . "</td>";
                        echo "<td><img src='" . $data['Couverture'] . "' height='80' width='100'></td>";
                        echo "</tr>";
                        echo "</table>";
                    }
                } else {
                    echo "<div class='message error'>Erreur lors de l'ajout du livre : " . mysqli_error($db_handle) . "</div>";
                }
            }
        }
    } elseif(isset($_POST['button3'])) { // Suppression
        $titre = mysqli_real_escape_string($db_handle, $_POST['Titre']);

        if (empty($titre)) {
            echo "<div class='message error'>Veuillez fournir le titre du livre à supprimer.</div>";
        } else {
            $sql_check_existence = "SELECT * FROM books WHERE Titre = '$titre'";
            $result_check_existence = mysqli_query($db_handle, $sql_check_existence);

            if (mysqli_num_rows($result_check_existence) > 0) {
                // Le livre existe et donc on le supprime
                $sql_delete_book = "DELETE FROM books WHERE Titre = '$titre'";
                $result_delete_book = mysqli_query($db_handle, $sql_delete_book);
                if ($result_delete_book) {
                    echo "<div class='message'>Livre supprimé avec succès.</div>";

                    // Affichage des livres
                    $sql_remaining_books = "SELECT * FROM books";
                    $result_remaining_books = mysqli_query($db_handle, $sql_remaining_books);
                    if ($result_remaining_books && mysqli_num_rows($result_remaining_books) > 0) {
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Année</th><th>Editeur</th><th>Couverture</th></tr>";
                        while ($data = mysqli_fetch_assoc($result_remaining_books)) {
                            echo "<tr>";
                            echo "<td>" . $data['ID'] . "</td>";
                            echo "<td>" . $data['Titre'] . "</td>";
                            echo "<td>" . $data['Auteur'] . "</td>";
                            echo "<td>" . $data['Annee'] . "</td>";
                            echo "<td>" . $data['Editeur'] . "</td>";
                            echo "<td><img src='" . $data['Couverture'] . "' height='80' width='100'></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<div class='message'>Aucun livre trouvé.</div>";
                    }
                } else {
                    echo "<div class='message error'>Erreur lors de la suppression du livre : " . mysqli_error($db_handle) . "</div>";
                }
            } else {
                // Livre existe pas
                echo "<div class='message error'>Le livre que vous essayez de supprimer n'existe pas.</div>";
            }
        }
    }

    // Affichage des livres
    if (isset($sql)) {
        $result = mysqli_query($db_handle, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Année</th><th>Editeur</th><th>Couverture</th></tr>";
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['ID'] . "</td>";
                echo "<td>" . $data['Titre'] . "</td>";
                echo "<td>" . $data['Auteur'] . "</td>";
                echo "<td>" . $data['Annee'] . "</td>";
                echo "<td>" . $data['Editeur'] . "</td>";
                echo "<td><img src='" . $data['Couverture'] . "' height='80' width='100'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } elseif (isset($_POST['button1'])) {
            echo "<div class='message'>Aucun livre trouvé.</div>";
        }
    }
} else {
    echo "<div class='message error'>Base de données non trouvée.</div>";
}

mysqli_close($db_handle);
?>
</body>
</html>
