<?php
    define("TITLE", "Mise à jour de solde");
    session_start();
    // Check if the user is not logged in
    if (!isset($_SESSION["prenom"]) || !isset($_SESSION["nom"])) {
        header("Location: index.php");
        exit();
        }

?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title><?php echo TITLE;?></title>
    </head>
    <body>
        <?php
            include('includes/header.php');
        ?>

        <div class="container">
        <?php
            $error = array();

            //let's connect to the database
            if(isset($_POST["submit"]))
            {
                $numcompte = $_POST["numcompte"];
                $nouveausolde= $_POST["nouveausolde"];

                if(empty($numcompte)){
                    array_push($error, "Le numero de compte n'est pas renseigne");
                }
                if(empty($nouveausolde)){
                    array_push($error, "Le nouveau solde n'est pas renseigne");
                }
                if(count($error) > 0){
                    foreach($error as $errors){
                        echo "<p class=\"fail\">$errors</p>";
                    }
                }else{
                    $conn = mysqli_connect("localhost", "root", "root", "banqueofliberty");
                    $sql = "UPDATE client SET solde = $nouveausolde WHERE numcompte=$numcompte ;";
                    if (!(mysqli_query($conn, $sql))) {
                        die('Error: ' . mysqli_error($conn));
                    }

                    echo "<p class=\"success\">Le solde du compte n°$numcompte a été mis à jour.</p>";
                    mysqli_close($conn);
                }

                
            
            }   
                
        ?>
            <form action="update.php" method="POST">
                Numero de compte:<br></compte:br><input type="number" name="numcompte"><br>
                Nouveau solde:<br></compte:br><input type="number" name="nouveausolde"><br>
                <input type="submit" value="Envoyer" name="submit" class="submit"><br>
            </form>
        </div>

        <?php
            include('includes/footer.php');
        ?>

    </body>
</html>

