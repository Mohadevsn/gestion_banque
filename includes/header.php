<h1 class="title">Bank of Liberty</h1>
<nav>
    <ul>
        <li><a href="creation.php">Creation de compte</a></li>
        <li><a href="lecture.php">Liste des clients</a></li>
        <li><a href="update.php">Mettre a jour le solde</a></li>
        <li><a href="delete.php">Supprimer un client</a></li>
        <li><a href="logout.php">Deconnection</a></li>
    </ul>
</nav>
<h2>
    <?php
        // Check if the session variables are set
        if (isset($_SESSION["prenom"]) && isset($_SESSION["nom"])) {
            $prenom = $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            echo "<p class=\"welcome\">Welcome, $prenom $nom</p>";
        } else {
            echo "<p class=\"welcome\">Welcome!</p>";
        }
    ?>
</h2>
