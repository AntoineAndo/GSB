<?php
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
    
if( $_SESSION['Poste'] != 'Admin' && $_SESSION['Poste'] == 'Employe')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilVisiteur.php">Accéder à l\'accueil employe</a>';
}
else if($_SESSION['Poste'] == 'Comptable')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilComptable.php">Accéder à l\'accueil comptable</a>';  
}
else
{
    
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Accueil administrateur de l'intranet</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
</head>
<body>
    <header>
        <img src="GSB.png" alt="Galaxy-Swiss Bourdin" />

        <div id="User">
            <?php
            echo '<b>'.$_SESSION['Prenom'].' '.$_SESSION['Nom'].'</b>';
            ?>
            <img src="Avatar.jpg" />
            <ul>
                <li>------------------</li>
                <li><a href="http://localhost/GSB/Appli/Deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>
    </header>
    <h1>Accueil administrateur de l'intranet GSB</h1>

    <div id="Blabla">
        <a href="NouvelUser.php" style="background-color: #52dae4;" class="Bloc">
            <p>Créer un nouvel utilisateur</p>
        </a>
        <a href="VoirUser.php" style="background-color: #24a7b0;" class="Bloc">
            <p>Modifier/Supprimer un utilisateur</p>
        </a>
        <a href="GestionFrais.php" style="background-color: #0c757c;" class="Bloc">
            <p>Gestion des utilisateurs</p>
        </a>
        <a href="GestionFrais.php" style="background-color: #0c757c;" class="Bloc">
            <p>Gestion des forfaits employés</p>
        </a>
    </div>
<?php
}
?>