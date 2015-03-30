<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
   
    try
           {
                   $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login);
           }
    catch (PDOException $e)
           {
                   exit('problème de connexion à la base');
           }
           
    $requete = 'SELECT * FROM lignedefrais';
    
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
    <title>FRAIS</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
</head>
<body>
     <header>
        <a href="AccueilVisiteur.php" id='BlocRetour'><img src='http://localhost/GSB/Ressources/fleche_retour.png'><b>Retourner à l'accueil</b></a>
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
    
    <form method="POST" action="ConsultFrais.php" id="NouvelleLigne" style="margin-top: 50px;">
        <input type="text" name="Mois" placeholder="Mois">
        <input type="text" name="Annee" placeholder="Année">
        <input type="submit" value="Valider">
    </form>
    
</body>
