
     <header>
        <?php 
        $page = basename($_SERVER['PHP_SELF']);
        if($page != "AccueilVisiteur.php" && $page != "AccueilComptable.php" && $page != "AccueilAdmin.php"){

            switch($_SESSION["Poste"]){
                case 'Comptable':
                    echo "<a href='AccueilComptable.php' id='blocRetour'>";
                    break;
                case 'Employe':
                    echo "<a href='AccueilVisiteur.php' id='BlocRetour'>";
                    break;
                case 'Admin':
                    echo "<a href='AccueilAdmin.php' id='BlocRetour'>";
                    break;
            }
        echo "<img src='../Ressources/fleche_retour.png' width='25' height='25'>
            <b>Retourner à l'accueil</b>
        </a>";
        }

        ?>

        <img src="../Ressources/GSB.png" alt="Galaxy-Swiss Bourdin" />

     </header>
        <div id="User">
            <?php
            echo '<b>'.$_SESSION['Prenom'].' '.$_SESSION['Nom'].'</b>';
            ?>
            <img src="../Ressources/Avatar.jpg" />
            <ul>
                <li><a href="../Appli/Deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>