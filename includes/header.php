<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">   
<div class="nav-bar navbar navbar-expand">
            <ul class="navbar-nav navbar-dark bg-danger mr-auto">
                <a href="#" class="navbar-brand">Bank of Liberty</a>
                <li class="nav-item"><a href="creation.php" class="nav-link btn-primary">Creation de compte</a></li>
                <li class="nav-item"><a href="lecture.php" class="nav-link">Liste des clients</a></li>
                <li class="nav-item"><a href="update.php" class="nav-link">Mettre a jour le solde</a></li>
                <li class="nav-item"><a href="delete.php" class="nav-link">Supprimer un client</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link ">Deconnection</a></li>
            </ul>
        </div>

        
<h2>
    <?php
        // Check if the session variables are set
        if (isset($_SESSION["prenom"]) && isset($_SESSION["nom"])) {
            $prenom = $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            echo "<p class=\"bg-secondary\">Welcome, $prenom $nom</p>";
        } else {
            echo "<p class=\"bg-primary\">Welcome!</p>";
        }
    ?>
</h2>
