<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']) || $_SESSION['Poste'] != 'Employe' )
    {
    header('location: ../Appli/SeConnecter.php');
    }

include('functions.php');
    $currentMonth = (new dateTime())->format('m');
    $requete2 = 'SELECT id, mois, annee, status, idEmploye FROM fichefrais WHERE status = 0 ORDER BY id asc';

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
    <link href="CSS/Style.css" rel="stylesheet" />
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
    <?php include_once("header.php") ?> 

<div class="main">
<?php 

    foreach($resultat2 as $j)
    {   
        echo '<h2> Fiche de frais du mois de '.$j[1].' / '.$j[2].'</h2>';
        ?>
        <div class="fiche">
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
                        <form method="post" action="../Appli/DeleteLigne.php">
                            <input type="hidden" name="id" value="'.$i[0].'">
                            <input type="submit" value="X"/>
                        </form>
                    </th>
                </tr>
                <tr>
                    <td colspan="5">';
                        if ($j[1] != $currentMonth)
                        {

                        ?>
                        <form method="POST" action="../Appli/ValiderFiche.php">
                            <?php
                            echo '<input type="hidden" name="id" value="'.$j[0].'">'
                            ?>
                            <input type="submit" value="Valider cette fiche" style="width: 555px;">
                        </form>
                        <?php
                        }
                        else {
                            echo '<h4>Cette fiche ne peut pas être validée car le mois n\'est pas encore terminé</h4>';
                        }

             echo '</td>
                </tr>';
             }
                 ?>

            </table>
        </div>
            <?php

    }




?>
























    
    <form id="NouvelleLigne" method="POST" action="../Appli/NouveauFrais.php">
        <div>
            <input type="text" style="width:105px;" name="Type" required="required">
            <input type="text" style="width:152px;" name="Libelle" required="required">
            <input  type="text" id="datepicker" name="Date" required="required">   
            <input type="text" style="width:62px;" name="Montant" required="required">
            <input type="submit" value="Valider">
        </div>
    </form>

</div>
    
</body>
