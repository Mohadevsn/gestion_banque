<?php
    define("TITLE", "Creation de compte client");
?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title><?php echo TITLE; ?></title>

</head>
<body>
        <?php
            include('includes/header.php');
        ?>
    
        <div class="container">
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
            <form action="creation.php" method="POST">
                Prenom:<br></Prenom:br><input type="text" name="prenom"><br>
                Nom:<br><input type="text" name="nom"><br>
                code:<br><input type="number" name="code"><br>
                Numero de compte:<br><input type="number" name="numerocompte"><br>
                Solde:<br><input type="number" name="solde"><br>
                <input type="submit" value="Envoyer" name="submit" class="submit"><br>
            </form>
        </div>

        <?php
            include('includes/footer.php');
        ?>

</body>
</html>
