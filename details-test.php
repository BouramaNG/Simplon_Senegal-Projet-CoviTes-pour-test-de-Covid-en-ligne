<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du test COVID-20</title>
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
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
            color: #666;
            margin-bottom: 10px;
        }

        .alert-success {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert-warning {
            background-color: #FFC107;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #FF5722;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-download {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-retour {
            background-color: green;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-historique {
            background-color: red;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-download:hover {
            background-color: #2980b9;
        }
         .btn-retour:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="container">
    <?php
session_start();


if (isset($_SESSION["nom"])) {
   
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $score = $_SESSION["score"];
    $dateTest = date("Y-m-d");
    $heureTest = date("H:i:s");

   
    $fichier = fopen("tests.csv", "a"); 
    fputcsv($fichier, [$dateTest, $heureTest, $nom, $prenom, $score]);
    fclose($fichier);

   




   
    
    echo "<h1>Résultats du test COVID-20 pour $prenom $nom</h1>";
    echo "<p>Score du test : $score%</p>";
    echo "<p>Date du test : $dateTest</p>";
    

$question_maux_tete = isset($_SESSION["question_maux_tete"]) ? $_SESSION["question_maux_tete"] : "";
$question_tousse = isset($_SESSION["question_tousse"]) ? $_SESSION["question_tousse"] : "";
$question_perte_odeur = isset($_SESSION["question_perte_odeur"]) ? $_SESSION["question_perte_odeur"] : "";
$question_diarrhee = isset($_SESSION["question_diarrhee"]) ? $_SESSION["question_diarrhee"] : "";
$question_tranche_age = isset($_SESSION["question_tranche_age"]) ? $_SESSION["question_tranche_age"] : "";


echo "<h2>Questions :</h2>";
if (!empty($question_maux_tete)) {
    echo "<p>Est-ce que vous avez des maux de tête ? Réponse : $question_maux_tete</p>";
}
if (!empty($question_tousse)) {
    echo "<p>Est-ce que vous toussez ? Réponse : $question_tousse</p>";
}
if (!empty($question_perte_odeur)) {
    echo "<p>Avez-vous une perte d'odorat ? Réponse : $question_perte_odeur</p>";
}
if (!empty($question_diarrhee)) {
    echo "<p>Avez-vous de la diarrhée ? Réponse : $question_diarrhee</p>";
}
if (!empty($question_tranche_age)) {
    echo "<p>Tranche d'âge : $question_tranche_age</p>";
}








    if ($score >= 80) {
        echo "<div class='alert-danger'>Malheureusement, vous avez un score élevé de $score%. Il est possible que vous ayez la COVID-20. Nous vous recommandons de vous isoler immédiatement, de contacter un professionnel de la santé et de suivre leurs instructions. Ne vous inquiétez pas, la plupart des personnes guérissent avec un traitement approprié.</div>";
    } elseif ($score >= 50) {
        echo "<div class='alert-warning'>Votre score est de $score%. Vous êtes susceptible d'être infecté par la COVID-20. Nous vous recommandons de consulter un professionnel de la santé pour un dépistage en personne. Prenez des précautions supplémentaires en attendant les résultats.</div>";
    } else {
        echo "<div class='alert-success'>Votre score est de $score%. Il est peu probable que vous ayez la COVID-20. Cependant, continuez à prendre des précautions, suivez les directives de santé publique et surveillez votre santé. Si vous développez des symptômes, consultez un professionnel de la santé.</div>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>

        <a class="btn-download" href="#">Télécharger les résultats</a>
        <a class="btn-retour" href="new-user-testing.php">Retour Espace Patient</a>
        <a class="btn-historique" href="historique.php">Voir Historiques</a>
    </div>
</body>

</html>





