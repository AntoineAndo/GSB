<?php
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
    
if( $_SESSION['Poste'] != 'Employe' && $_SESSION['Poste'] == 'Admin')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilAdmin.php">Accéder à l\'accueil Admin</a>';
}
else if($_SESSION['Poste'] == 'Comptable')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilComptable.php">Accéder à l\'accueil comptable</a>';  
}    
else {    
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Accueil visiteur de l'intranet</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
</head>
<body>
    <header>
        <img src="http://localhost/GSB/Ressources/GSB.png" alt="Galaxy-Swiss Bourdin" />

        <div id="User">
            <?php
            echo '<b>'.$_SESSION['Prenom'].' '.$_SESSION['Nom'].'</b>';
            ?>
            <img src="http://localhost/GSB/Ressources/Avatar.jpg" />
            <ul>
                <li>------------------</li>
                <li><a href="http://localhost/GSB/Appli/Deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>

    </header>

    <h1>Accueil visiteur de l'intranet GSB</h1>

    <div id="Blabla" style='left:560px;'>
        <a href="SaisirFrais - NEW.php" style="background-color: #52dae4;" class="Bloc">
            <p>Saisir Frais</p>
        </a>
        <a href="ConsultFrais.php" style="background-color: #24a7b0;" class="Bloc">
            <p>Consulter Frais</p>
        </a>
    </div>
</body>
</html>
<?php
}
?>