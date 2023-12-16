<?php
    define("TITLE", "Suppression de compte");
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
                    if(isset($_POST["submit"])){

                        $numcompte = $_POST["numerocompte"];
                        $agree = isset($_POST["agree"]);
                            if(!$agree){
                                array_push($error, "Vous n'avez pas confirme la suppression");
                            }
                            if(empty($numcompte)){
                                array_push($error, "Vous n'avez pas renseigner le numero de compte");
                            }
                            if(count($error) > 0 ){
                                foreach($error as $errors){
                                    echo "<p class=\"fail\">$errors</p>";
                                }
                            }
                            else{
                                //let's connect to the database
                                $conn = mysqli_connect("localhost", "root", "root", "banqueofliberty");
                                $sql = "DELETE from client WHERE numcompte=$numcompte;";
                                if (!(mysqli_query($conn, $sql))) {
                                    die('Error: ' . mysqli_error($conn));
                                }
                                    echo "<p class=\"success\">Suppression effectuee</p>";
                                 mysqli_close($conn);   
                            }
                    }
            ?>
            <form action="delete.php" method="POST">
                Numero de compte:<br><input type="number" name="numerocompte"><br>
                <input type="checkbox" name="agree" id="agree">Vous confirmez vouloir supprimer ce compte<br>
                <input type="submit" value="Supprimer" name="submit" class="submit">
            </form>
        </div>
        
    </body>
</html>