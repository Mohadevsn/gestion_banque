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
        <link rel="stylesheet" href="style.css">
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

            $chaine = "<div class=\"table\"><table border='1px' ><tr><td>Prenom</td><td>Nom</td><td>Code</td><td>Numero de compte</td><td>Solde</td></tr>";

            foreach($tab as $line){
                $prenom = $line[1];
                $nom = $line[2];
                $code = $line[3];
                $numcompte = $line[4];
                $solde = $line[5];
                
                $chaine = $chaine."<tr><td>$prenom</td><td>$nom</td><td>$code</td><td>$numcompte</td><td>$solde</td></tr>";
            }
            $chaine = $chaine."</table></div>";

            print($chaine);
            mysqli_close($conn);

        ?>

        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>