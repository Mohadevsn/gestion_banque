<?php
    define("TITLE", "Suppression de compte");
    session_start();
    // Check if the user is not logged in
    if (!isset($_SESSION["prenom"]) || !isset($_SESSION["nom"])) {
        header("Location: index.php");
        exit();
        }

?>
<html>
    <head>
        
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
                <div class="form-floating">
                    <input type="number" name="numerocompte" class="form-control" placeholder="number"><br>
                    <label class="label-form">Numero de compte:<br></label>
                    
                </div>
                
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="agree" autocomplete="off" name="agree">
                        <label class="btn btn-outline-danger" for="agree">Vous confirmez vouloir supprimer ce compte</label>
                    </div>

                    <br>
                    <br>
                <input type="submit" value="Supprimer" name="submit" class="btn btn-danger">
            </form>
        </div>
        
        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>