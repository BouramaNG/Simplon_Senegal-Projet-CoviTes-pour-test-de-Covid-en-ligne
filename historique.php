<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $date = $_GET['date'];
    $heure = $_GET['heure'];

    if ($action === 'supprimer') {
        $fichier = fopen("tests.csv", "r");
        if ($fichier !== false) {
            $nouveauContenu = [];

            while (($ligne = fgetcsv($fichier)) !== false) {
            
                if ($ligne[0] !== $date || $ligne[1] !== $heure) {
                    $nouveauContenu[] = $ligne;
                }
            }

            fclose($fichier);

          
            $fichier = fopen("tests.csv", "w");
            foreach ($nouveauContenu as $ligne) {
                fputcsv($fichier, $ligne);
            }
            fclose($fichier);
        }


        header("Location: historique.php");
        exit();
    }

   
    elseif ($action === 'reinitialiser') {
       
        header("Location: historique.php");
        exit();
    }
}
?>
<?php

$fichier = fopen("tests.csv", "r");


$covidPatients = [];
$susceptiblePatients = [];

if ($fichier !== false) {
    while (($ligne = fgetcsv($fichier)) !== false) {
        list($date, $heure, $nomPatient, $prenomPatient, $score) = $ligne;
        
       
        if ($score >= 80) {
            $covidPatients[] = [
                'date' => $date,
                'heure' => $heure,
                'nom' => $nomPatient,
                'prenom' => $prenomPatient,
                'score' => $score,
            ];
        } elseif ($score >= 50) {
            $susceptiblePatients[] = [
                'date' => $date,
                'heure' => $heure,
                'nom' => $nomPatient,
                'prenom' => $prenomPatient,
                'score' => $score,
            ];
        }
    }
    fclose($fichier);
}
?>
<!DOCTYPE html>
<html lang="fr">

    
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }
        .acovid{
            background-color: red;
            border-radius: 20px;
            color: white;
        }
        .apascovid{
            background-color: green;
            border-radius: 20px;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Historique des Tests</h1>
<h2 class="acovid">Patients avec la COVID-19</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Nom du Patient</th>
            <th>Score</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($covidPatients as $patient) {
            echo "<tr>";
            echo "<td>{$patient['date']}</td>";
            echo "<td>{$patient['heure']}</td>";
            echo "<td>{$patient['prenom']} {$patient['nom']}</td>";
            echo "<td>{$patient['score']}%</td>";
            echo "<td><a href='historique.php?action=supprimer&date={$patient['date']}&heure={$patient['heure']}'>Supprimer</a> | <a href='historique.php?action=reinitialiser&date={$patient['date']}&heure={$patient['heure']}'>Réinitialiser</a> | <a href='resume.php?date={$patient['date']}&heure={$patient['heure']}'>Resume</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<h2 class="apascovid">Patients susceptibles de la COVID-19</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Nom du Patient</th>
            <th>Score</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($susceptiblePatients as $patient) {
            echo "<tr>";
            echo "<td>{$patient['date']}</td>";
            echo "<td>{$patient['heure']}</td>";
            echo "<td>{$patient['prenom']} {$patient['nom']}</td>";
            echo "<td>{$patient['score']}%</td>";
            echo "<td><a href='historique.php?action=supprimer&date={$patient['date']}&heure={$patient['heure']}'>Supprimer</a> | <a href='historique.php?action=reinitialiser&date={$patient['date']}&heure={$patient['heure']}'>Réinitialiser</a> | <a href='resume.php?date={$patient['date']}&heure={$patient['heure']}'>Resume</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

    <a class="btn-retour" href="new-user-testing.php">Retour Espace Patient</a>
</body>
</html>




