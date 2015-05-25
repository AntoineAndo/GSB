
     <header>
        <?php 
        $page = basename($_SERVER['PHP_SELF']);
        if($page =! "AccueilVisiteur.php" && $page =! "AccueilComptable.php" && $page =! "AccueilAdmin.php"){

            switch($_SESSION["Poste"]){
                case 'Comptable':
                    echo "<a href='AccueilComptable.php' id='BlocRetour'>";
                    break;
                case 'Employe':
                    echo "<a href='AccueilVisiteur.php' id='BlocRetour'>";
                    break;
                case 'Admin':
                    echo "<a href='AccueilAdministrateur.php' id='BlocRetour'>";
                    break;
            }
        echo "<img src='http://localhost/GSB/Ressources/fleche_retour.png'>
            <b>Retourner à l'accueil</b>
        </a>";
        }

        ?>

        <img src="http://localhost/GSB/Ressources/GSB.png" alt="Galaxy-Swiss Bourdin" />

     </header>
        <div id="User">
            <?php
            echo '<b>'.$_SESSION['Prenom'].' '.$_SESSION['Nom'].'</b>';
            ?>
            <img src="http://localhost/GSB/Ressources/Avatar.jpg" />
            <ul>
                <li><a href="../Appli/Deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>