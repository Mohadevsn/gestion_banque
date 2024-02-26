<?php
    define("TITLE", "Liste des clients");
    session_start();
    // Check if the user is not logged in
    if (!isset($_SESSION["prenom"]) || !isset($_SESSION["nom"])) {
        header("Location: index.php");
        exit();
        }
?>

<html>
    <head>
        
        <title><?php echo TITLE ; ?></title>
    </head>
    <body>
        <?php
            include('includes/header.php');
        ?>
        
        <?php 

            //let's connect to the database

            $conn = mysqli_connect("localhost", "root", "root", "banqueofliberty");
            $sql = "SELECT * from client";
            $result = mysqli_query($conn, $sql);
            $tab = mysqli_fetch_all($result);

            $chaine = "<table border='1px' class=\"table table-ml\"><thead><tr><th scope=\"col\">Prenom</th><th scope=\"col\">Nom</th><th scope=\"col\">Code</th><th scope=\"col\">Numero de compte</th><th scope=\"col\">Solde</th></tr></thead><tbody>";

            foreach($tab as $line){
                $prenom = $line[1];
                $nom = $line[2];
                $code = $line[3];
                $numcompte = $line[4];
                $solde = $line[5];
                
                $chaine = $chaine."<tr><td scope=\"row\">$prenom</td><td>$nom</td><td>$code</td><td>$numcompte</td><td>$solde</td></tr>";
            }
            $chaine = $chaine."</tbody></table></div>";

            print($chaine);
            mysqli_close($conn);

        ?>

        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>