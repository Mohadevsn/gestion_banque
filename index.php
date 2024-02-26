<?php
    
    define("TITLE", "Bank of liberty");
    session_start();
?>
<html>
    <head>
        
        <title><?php echo TITLE;?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
                            echo "<p class=\"bg-warning\">$errors</p>";
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


            <div class="container bg-danger">
                <h1>Administrateur connection</h1>
                <form action="" method="POST" novalidate >
                    <div class="form-floating">
                
                        <input type="text" name="username" class="form-control form-control-sm" placeholder="enter your username">
                        <label for="username" class="form-label">Username</label>
                        <div class="invalid-feedback">
                            Veuillez renseigner le username
                        </div>
                    </div>
                
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="enter your password" required>
                        <label for="password" class="form-label">Mot de passe</label>
                    </div>
                
                        <input type="submit" value="Se connecter" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
        
    </body>
</html>