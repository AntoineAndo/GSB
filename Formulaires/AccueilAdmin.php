<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: ../Appli/SeConnecter.php');
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
    try
           {
                   $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login);
           }
    catch (PDOException $e)
           {
                   exit('problème de connexion à la base');
           }
           
    $requete = 'SELECT Nom,Prenom,Date FROM formulaire WHERE Valider = 1 order by id';
    
    try
         {
             $req_prep = $connect->prepare($requete);
             $req_prep->execute();
             $resultat = $req_prep->fetchAll(); 
             $nb_result = count($resultat);
             
         }
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         } 
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Accueil visiteur de l'intranet</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
</head>
<body>
    <?php include_once("header.php") ?>
    <div id="Blabla" style='left:560px;'>
        <a href="NouvelUser.php" style="background-color: #52dae4;" class="Bloc">
            <p>Gestion des utilisateurs</p>
        </a>
        <a href="Archives.php" style="background-color: #24a7b0;" class="Bloc">
            <p>Gestion des archives</p>
        </a>
    </div>
</body>
<?php } ?>
