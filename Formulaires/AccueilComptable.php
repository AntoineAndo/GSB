<?php
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: ../Appli/SeConnecter.php');
    }
    
if( $_SESSION['Poste'] != 'Comptable' && $_SESSION['Poste'] == 'Admin')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilAdmin.php">Accéder à l\'accueil Admin</a>';
}
else if($_SESSION['Poste'] == 'Employe')
{	
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilEmploye.php">Accéder à l\'accueil employe</a>';  
}    
else {    
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Accueil comptable de l'intranet</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
</head>
<body>
    <?php include_once("header.php") ?>

    <h1>Accueil comptable de l'intranet GSB</h1>

    <div id="Blabla" style='left:560px;'>
        <a href="ValidFrais.php" style="background-color: #52dae4;" class="Bloc">
            <p>Valider frais</p>
        </a>
    </div>
</body>
</html>

<?php
}
?>
