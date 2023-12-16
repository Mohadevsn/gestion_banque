<?php
    
    define("TITLE", "Bank of liberty");
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title><?php echo TITLE;?></title>
    </head>
    <body>
        <?php
            include('includes/headeradmin.php');
        ?>

        <div class="container">
            <?php
                if(isset($_POST["submit"])){
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $error = array();
                    if(empty($username)){
                        array_push($error, "Veuillez renseigner le username");
                    }
                    if(empty($password)){
                        array_push($error, "Veuillez renseigner le mot de passe ");
                    }
                    if(count($error) >0){
                        foreach($error as $errors){
                            echo "<p class=\"fail\">$errors</p>";
                        }
                    }else
                    {
                            // let's connect to the database

                        $conn = mysqli_connect("localhost", "root", "root", "banqueofliberty");
                        if(!$conn){
                            die("Error: Unable to connect to MySQL");
                        }
                        $sql = "SELECT * FROM admin WHERE username='$username' AND passwd='$password'";
                        $result = mysqli_query($conn, $sql);

                        // ... (other code)

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $prenom = $row['prenom']; // Adjust column name as per your database structure
                        $nom = $row['nom']; // Adjust column name as per your database structure
                        $_SESSION["prenom"] = $prenom;
                        $_SESSION["nom"] = $nom;
                        header("Location: creation.php");
                        exit();
                    } else {
                        echo "<p class=\"fail\">Le mot de passe ou le username est incorrect</p>";
                    }

                    // ... (other code)

                        mysqli_close($conn);
                    }
                }
            
            ?>


            <h1>Administrateur connection</h1>
            <form action="" method="POST">
                Username:<br><input type="text" name="username" ><br>
                Mot de passe:<br><input type="password" name="password"><br>
                <input type="submit" value="Se connecter" name="submit" class="submit">
            </form>
        </div>
        <?php
            include('includes/footer.php');
        ?>
        
    </body>
</html>