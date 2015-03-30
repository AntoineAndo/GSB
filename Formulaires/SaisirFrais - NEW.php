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
           
    $requete = 'SELECT id, Type, Libelle, Date, Montant FROM ficheFrais';
    
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
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
             <table border='1' id="Recap">
                 <tr style='background-color:rgb(150,150,150);'>
                     <th width="100">Type</th>
                     <th width ="150">Libelle</th>
                     <th width="100">Date</th>
                     <th>Montant</th>
					 <th></th>
                 </tr>
     <?php      
             foreach ($resultat as $i) 
             {
      echo '<tr>
                <th>'.$i[1].'</th>
                <th>'.$i[2].'</th>
                <th>'.$i[3].'</th>
                <th>'.$i[4].'</th>
                <th>
                    <form method="post" action="http://localhost/GSB/Appli/DeleteLigne.php">
                        <input type="hidden" name="id" value="'.$i[0].'">
                        <input type="submit" value="X"/>
                    </form>
                </th>
           </tr>';
             }
     ?>
            </table>
    
    <form id="NouvelleLigne" method="POST" action="../Appli/NouveauFrais.php">
        <input type="text" style="width:105px;" name="Type" required="required">
        <input type="text" style="width:152px;" name="Libelle" required="required">
        <input  type="text" id="datepicker" name="Date" required="required">   
        <input type="text" style="width:62px;" name="Montant" required="required">
        <input type="submit" value="Valider">
    </form>
    
</body>
