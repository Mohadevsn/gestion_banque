<?php
    define("TITLE", "Mise à jour de solde");
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title><?php echo TITLE;?></title>
    </head>
    <body>
        <h1 class="title">Bank of Liberty</h1>
        <nav>
            <ul>
                <li><a href="creation.php">Creation de compte</a></li>
                <li><a href="lecture.php">Liste des clients</a></li>
                <li><a href="update.php">Mettre a jour le solde</a></li>
                <li><a href="delete.php">Supprimer un client</a></li>
            </ul>
        </nav>

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

        <div class="footer">
            <?php 
                $year = date('Y');
                $creator = "Mohamed Wade";
                echo "$creator &copy $year" ;
            ?>
        </div>
    </body>
</html>

