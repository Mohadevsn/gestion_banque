<?php
    define("TITLE", "Creation de compte client");
    session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION["prenom"]) || !isset($_SESSION["nom"])) {
    header("Location: index.php");
    exit();
    }


?>

<html>
<head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <title><?php echo TITLE; ?></title>

</head>
<body>
        <?php
            include('includes/header.php');
        ?>
    
        <div class="container" >
            <?php
            if(isset($_POST["submit"])){
                $prenom = $_POST["prenom"];
                $nom = $_POST["nom"];
                $code = $_POST["code"];
                $numcompte = $_POST["numerocompte"];
                $solde = $_POST["solde"];
                $error = array();
                if(empty($prenom)){
                    array_push($error, "Le prenom n'est pas renseigner");
                }
                if(empty($nom)){
                    array_push($error, "Le nom n'est pas renseigner");
                }
                if(empty($code)){
                    array_push($error, "Le code n'est pas renseigner");
                }
                if(empty($numcompte)){
                    array_push($error, "Le numero de compte n'est pas renseigner");
                }
                if(empty($solde)){
                    array_push($error, "Le solde n'est pas renseigner");
                }
            
            
                //let's connect to the database
                if(count($error) > 0){
                    foreach($error as $errors){
                        echo "<p class=\"fail\">$errors</p>";
                    }
                }
                else{
                    $conn = mysqli_connect("localhost", "root", "root", "banqueofliberty");
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    //insertion of data into the table clients
                    $sql = "INSERT INTO client (prenom, nom, code, numcompte, solde) VALUES ('$prenom', '$nom', $code, $numcompte, $solde);";
                    $query = mysqli_query($conn, $sql); // corrected mysqli_query parameter order
                    if(!$query){
                        echo 'Erreur lors de l\'ajout du client: ' . mysqli_error($conn);
                    } else {
                        echo "<p class=\"success\">Ajout réussi</p>";
                    }
            
                    // close the database connection
                    mysqli_close($conn);
                }
            
            }
            ?>
            <form action="creation.php" method="POST" >

                    <div class="form-floating">
                        <input type="text" name="prenom" placeholder="enter the prenom" class="form-control">
                        <label for="prenom" class="label-form">Prenom</label>
                    </div>

                    
                    <div class="form-floating">
                        <input type="text" name="nom" placeholder="enter the prenom" class="form-control">
                        <label for="nom" class="label-form">Nom</label>
                    </div>

                    
                    <div class="form-floating">
                        <input type="number" name="code" placeholder="enter the prenom" class="form-control">
                        <label for="code" class="label-form">code</label>
                    </div>

                   
                    <div class="form-floating">
                        <input type="number" name="numerocompte" placeholder="enter the prenom" class="form-control">
                        <label for="code" class="label-form">Numero de compte</label>
                    </div>

                    
                    <div class="form-floating">
                        <input type="number" name="solde" placeholder="enter the prenom" class="form-control">
                        <label for="solde" class="label-form">Solde</label>
                    </div>

                    <input type="submit" value="Envoyer" name="submit" class="btn btn-success">
            </form>
        </div>

        <?php
            include('includes/footer.php');
        ?>

</body>
</html>
