<!DOCTYPE html>
<html>
<head>
    <title>Gebruikersbeheer</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .container {
            width: 80%;
            max-width: 800px;
            background-color: #f2f2f2;
            padding: 20px;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            margin-right: 8px;
        }
        
        button:hover {
            background-color: #45a049;
        }
        
        .notification {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Stage opdracht</h2> <!-- Title added -->

    <?php
    // connectie met de database maken
    $server = "mariadb-test";
    $user = "root";
    $password = "root";
    $dbname = "test";

    $dbconn = new mysqli($server, $user, $password, $dbname);

    // controleren of de connectie is gelukt
    if ($dbconn->connect_error) {
        die("Connectie mislukt: " . $dbconn->connect_error);
    }

    // verwerken van het toevoegings-, verwijderings- en bewerkingsformulier
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // controleer of er geselecteerde gebruikers zijn om te verwijderen
        if (isset($_POST["delete_employee"])) {
            // loop door de geselecteerde gebruikers en verwijder ze
            foreach ($_POST["delete_employee"] as $employeeID) {
                $deleteQuery = "DELETE FROM gebruiker WHERE id = '$employeeID'";
                if ($dbconn->query($deleteQuery) === TRUE) {
                    echo "Gebruiker met ID $employeeID succesvol verwijderd.<br>";
                } else {
                    echo "Fout bij het verwijderen van gebruiker met ID $employeeID: " . $dbconn->error . "<br>";
                }
            }
        } else {
            echo "Geen gebruikers geselecteerd om te verwijderen.<br>";
        }

        // controleer of er bewerkingen zijn ingediend
        if (isset($_POST["edit_email_submit"])) {
            // controleer of er geselecteerde gebruikers zijn om de e-mails te bewerken
            if (isset($_POST["edit_email_employee"])) {
                // loop door de geselecteerde gebruikers en update de e-mails
                foreach ($_POST["edit_email_employee"] as $employeeID => $newEmail) {
                    // Check if the email already exists for another user
                    $duplicateCheckQuery = "SELECT id FROM gebruiker WHERE email = '$newEmail' AND id != '$employeeID'";
                    $duplicateCheckResult = $dbconn->query($duplicateCheckQuery);
                    if ($duplicateCheckResult->num_rows > 0) {
                        echo "<div class='notification'>Fout: E-mailadres $newEmail is al in gebruik voor een andere gebruiker.</div>";
                    } else {
                        $updateQuery = "UPDATE gebruiker SET email = '$newEmail' WHERE id = '$employeeID'";
                        if ($dbconn->query($updateQuery) === TRUE) {
                            echo "E-mailadres voor gebruiker met ID $employeeID succesvol bijgewerkt.<br>";
                        } else {
                            echo "Fout bij het bijwerken van e-mailadres voor gebruiker met ID $employeeID: " . $dbconn->error . "<br>";
                        }
                    }
                }
            } else {
                echo "Geen gebruikers geselecteerd om e-mails te bewerken.<br>";
            }
        }
    }

    // query voor het ophalen van alle gebruikers uit de tabel
    $sql = "SELECT * FROM gebruiker";

    // uitvoeren van de query
    $result = $dbconn->query($sql);

    // controleren of er resultaten zijn
    if ($result->num_rows > 0) {
        // formulier voor het verwijderen en bewerken van gebruikers
        echo "<form method='post' action=''>";
        echo "<table><tr><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>E-mail</th><th>Postcode</th><th>Verwijderen</th></tr>";

        // gegevens van alle gebruikers weergeven in de tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["voornaam"] . "</td>";
            echo "<td>" . $row["tussenvoegsel"] . "</td>";
            echo "<td>" . $row["achternaam"] . "</td>";
            echo "<td><input type='text' name='edit_email_employee[" . $row["id"] . "]' value='" . $row["email"] . "'></td>";
            echo "<td>" . $row["postcode"] . "</td>";
            echo "<td><input type='checkbox' name='delete_employee[]' value='" . $row["id"] . "'></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<button type='submit' name='delete'>Verwijderen</button>";
        echo "<button type='submit' name='edit_email_submit'>E-mail bewerken</button>";
        echo "</div>";
        echo "</form>";
    } else {
        echo "Geen gebruikers gevonden.";
    }

    // verbinding met de database sluiten
    $dbconn->close();
    ?>

</div>

</body>
</html>
