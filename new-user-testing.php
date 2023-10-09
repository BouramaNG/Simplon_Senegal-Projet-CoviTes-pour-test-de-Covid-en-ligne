<?php 
$score = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temperature = $_POST["temperature"];
    $maux_tete = $_POST["maux_tete"];
    $tousse = $_POST["tousse"];
    $perte_odeur = $_POST["perte_odeur"];
    $diarrhee = $_POST["diarrhee"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $poids = $_POST["poids"];
    $age = $_POST["age"];
    $tranche_age = $_POST["tranche_age"];


    if (empty($temperature) || empty($maux_tete) || empty($tousse) || empty($perte_odeur) || empty($diarrhee) || empty($nom) || empty($prenom) || empty($poids) || empty($age) || empty($tranche_age)) {
        echo "Tous les champs sont obligatoires. Veuillez remplir tous les champs.";
    } else {

        if (($temperature < 37) && ($temperature > 35)) { 
            $score += 10;
        }
        if ($maux_tete === "oui") {
            $score += 20;
        }
        if ($tousse === "oui") {
            $score += 10;
        }
        if ($perte_odeur === "oui") {
            $score += 10;
        }
        if ($diarrhee === "oui") {
            $score += 20;
        }
        if ($tranche_age === "2-10 ans") {
            $score += 20;
        } elseif ($tranche_age === "15-30 ans") {
            $score += 15;
        } elseif ($tranche_age === "45-100 ans") {
            $score += 10;
        }

        session_start();
        $_SESSION["nom"] = $nom;
        $_SESSION["prenom"] = $prenom;
        $_SESSION["poids"] = $poids;
        $_SESSION["age"] = $age;
        $_SESSION["temperature"] = $temperature;
        $_SESSION["maux_tete"] = $maux_tete;
        $_SESSION["tousse"] = $tousse;
        $_SESSION["perte_odeur"] = $perte_odeur;
        $_SESSION["diarrhee"] = $diarrhee;
        $_SESSION["tranche_age"] = $tranche_age;
        $_SESSION["score"] = $score;

$_SESSION["question_maux_tete"] = isset($_POST["maux_tete"]) ? $_POST["maux_tete"] : "";
$_SESSION["question_tousse"] = isset($_POST["tousse"]) ? $_POST["tousse"] : "";
$_SESSION["question_perte_odeur"] = isset($_POST["perte_odeur"]) ? $_POST["perte_odeur"] : "";
$_SESSION["question_diarrhee"] = isset($_POST["diarrhee"]) ? $_POST["diarrhee"] : "";
$_SESSION["question_tranche_age"] = isset($_POST["tranche_age"]) ? $_POST["tranche_age"] : "";



        header("Location: details-test.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simplon | Teste Covid-20 en Ligne</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style type="text/css">
label{
    font-size:16px;
    font-weight:bold;
    color:#000;
}

</style>
  <script>
function mobileAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'mobnumber='+$("#mobilenumber").val(),
type: "POST",
success:function(data){
$("#mobile-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php include_once('includes/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Teste Covid-20 En ligne</h1>
<form name="newtesting" method="post">
  <div class="row">

                        <div class="col-lg-6">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Consultation Patient</h6>
                                </div>
                                <div class="card-body">
                        <div class="form-group">
                            <label for="temperature">Température corporelle (°C) </label>
                            <input type="number" class="form-control" placeholder="Dites nous votre temperature" name="temperature" step="1" required min="20" pattern="\d+">
                                        </div>
                                      
                                        <div class="form-group">
                <label class="form-label">Est ce que vous avez des Maux Tete ? :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="maux_tete" value="oui" required>
                    <label class="form-check-label">Oui</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="maux_tete" value="non" required>
                    <label class="form-check-label">Non</label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Est ce que vous toussé ? :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tousse" value="oui" required>
                    <label class="form-check-label">Oui</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tousse" value="non" required>
                    <label class="form-check-label">Non</label>
                </div>
            </div>
                                        

                                        <div class="form-group">
                <label class="form-label">Perte d'odorat :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="perte_odeur" value="oui" required>
                    <label class="form-check-label">Oui</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="perte_odeur" value="non" required>
                    <label class="form-check-label">Non</label>
                </div>
            </div>
                          

            <div class="mb-3">
                <label class="form-label">Est ce que vous avez des Diarrhee :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="diarrhee" value="oui" required>
                    <label class="form-check-label">Oui</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="diarrhee" value="non" required>
                    <label class="form-check-label">Non</label>
                </div>
            </div>

            <div class="mb-3">
    <label class="form-label">Tranche d'âge :</label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="tranche_age" value="2-10 ans" required>
        <label class="form-check-label">2 à 10 ans</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="tranche_age" value="15-30 ans" required>
        <label class="form-check-label">15 à 30 ans</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="tranche_age" value="45-100 ans" required>
        <label class="form-check-label">45 à 100 ans</label>
    </div>
</div>


                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">

                           <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Information Patient</h6>
                                </div>
                                <div class="card-body">
                           

                                <div class="form-group">
                            <label>Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom"  placeholder="Entrer votre nom..." pattern="[A-Za-z ]+" title="letters only" required="true">
                                        </div>
                                        <div class="form-group">
                            <label>Prenom</label>
                                            <input type="text" class="form-control" id="prenom" name="prenom"  placeholder="Entrer votre prenom..." pattern="[A-Za-z ]+" title="letters only" required="true">
                                        </div>
                                        <div class="form-group">
                            <label>Votre Poids(Kg)</label>
                                            <input type="number" class="form-control" id="poids" name="poids"  placeholder="Entrer votre poids..."  required="true" min="8" pattern="\d+" step="1">
                                        </div>
                                        <div class="form-group">
                            <label>Votre Age </label>
                                            <input type="number" class="form-control" id="age" name="age"  placeholder="Entrer votre age..." required="true" min="2" pattern="\d+" step="1">
                                        </div>
                       <div class="form-group">
                                 <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" id="submit" value="Envoyer">                           
                             </div>

                                </div>
                            </div>
                       

                        </div>

                    </div>
</form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

   

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>