<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Test COVID-20</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .alert {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #ff6b6b;
            color: #fff;
        }

        .alert-warning {
            background-color: #ffc107;
            color: #000;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php

$date = $_GET['date'];
$heure = $_GET['heure'];


$fichier = fopen("tests.csv", "r");
if ($fichier !== false) {
    while (($ligne = fgetcsv($fichier)) !== false) {
        if ($ligne[0] === $date && $ligne[1] === $heure) {
            $nom = $ligne[2];
            $prenom = $ligne[3];
            $score = $ligne[4];

            echo "<h1>Détails du test COVID-20 pour $prenom $nom</h1>";
            echo "<p>Date du test : $date</p>";
            echo "<p>Heure du test : $heure</p>";
            echo "<p>Score du test : $score%</p>";

            if ($score >= 80) {
                echo "<div class='alert alert-danger'>Malheureusement, vous avez un score élevé de $score%. Il est possible que vous ayez la COVID-20. Nous vous recommandons de vous isoler immédiatement, de contacter un professionnel de la santé et de suivre leurs instructions. Ne vous inquiétez pas, la plupart des personnes guérissent avec un traitement approprié.</div>";
            } elseif ($score >= 50) {
                echo "<div class='alert alert-warning'>Votre score est de $score%. Vous êtes susceptible d'être infecté par la COVID-20. Nous vous recommandons de consulter un professionnel de la santé pour un dépistage en personne. Prenez des précautions supplémentaires en attendant les résultats.</div>";
            } else {
                echo "<div class='alert alert-success'>Votre score est de $score%. Il est peu probable que vous ayez la COVID-20. Cependant, continuez à prendre des précautions, suivez les directives de santé publique et surveillez votre santé. Si vous développez des symptômes, consultez un professionnel de la santé.</div>";
            }

            echo "<a class='btn' href='generate_pdf_covid.php?nom=$nom&prenom=$prenom&score=$score&date=$date&heure=$heure'>Télécharger les résultats (PDF)</a>";
            echo "<a class='btn' href='new-user-testing.php'>Retour Espace Patient</a>";
            echo "<a class='btn' href='historique.php'>Voir Historiques</a>";
            echo "<a class='btn' href='C:\xampp\htdocs\mon_fichier.pdf' download>Télécharger les résultats (PDF)</a>";

            fclose($fichier);
            break; 
        }
    }
} else {
    echo "Le fichier de tests n'a pas pu être ouvert.";
}
?>

    </div>
</body>
</html>
