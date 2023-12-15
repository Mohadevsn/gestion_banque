<?php
    define("TITLE", "Liste des clients");
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title><?php echo TITLE ; ?></title>
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

        <div class="footer">
            <?php 
                $year = date('Y');
                $creator = "Mohamed Wade";
                echo "$creator $year &copy" ;
            ?>
        </div>
    </body>
</html>