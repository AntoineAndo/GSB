<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
   
    try
		{
		   $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login, $passwd);
		}
    catch (PDOException $e)
		{
			echo $e;
			exit('problème de connexion à la base');
		}
    $currentMonth = (new dateTime())->format('m');
    $requete2 = 'SELECT id, mois, annee, status, idEmploye FROM fichefrais WHERE status = "En cours" ORDER BY id asc';

    try
		{

            $req_prep = $connect->prepare($requete2);
            $req_prep->execute();
            $resultat2 = $req_prep->fetchAll(); 

             
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
     <header style="margin-bottom: 50px;">
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


<?php 

    foreach($resultat2 as $j)
    {   
        echo '<h2> Fiche de frais du mois de '.$j[1].' / '.$j[2].'</h2>';
        ?>
             <table border='1' id="Recap">
                 <tr style='background-color:rgb(150,150,150);'>
                     <th width="100">Type</th>
                     <th width ="150">Libelle</th>
                     <th width="100">Date</th>
                     <th>Montant</th>
                     <th></th>
                 </tr>
        <?php      
                $requete = 'SELECT l.id as lid, Type, Libelle, Date, Montant, f.id as fid, f.mois as mois, f.annee as annee FROM lignefrais l JOIN fichefrais f ON l.idFicheFrais = f.id WHERE f.id = '.$j[0];

                $req_prep = $connect->prepare($requete);
                $req_prep->execute();
                $resultat = $req_prep->fetchAll(); 

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
            <?php
                if ($j[1] != $currentMonth)
                {

            ?>
            <form method="POST" action="http://localhost/GSB/Appli/ValiderFiche.php">
                <?php
                echo '<input type="hidden" name="id" value="'.$j[0].'">'
                ?>
                <input type="submit" value="Valider cette fiche">
            </form>
        <?php
        }
        else {
            echo '<h4>Cette fiche ne peut pas être validée car le mois n\'est pas encore terminé</h4>';
        }
    }




?>
























    
    <form id="NouvelleLigne" method="POST" action="../Appli/NouveauFrais.php">
        <input type="text" style="width:105px;" name="Type" required="required">
        <input type="text" style="width:152px;" name="Libelle" required="required">
        <input  type="text" id="datepicker" name="Date" required="required">   
        <input type="text" style="width:62px;" name="Montant" required="required">
        <input type="submit" value="Valider">
    </form>
    
</body>
