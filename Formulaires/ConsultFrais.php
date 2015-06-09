<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']) || $_SESSION['Poste'] != 'Employe' )
    {
    header('location: ../Appli/SeConnecter.php');
    }
   
if (isset($_POST['mois']) || isset($_POST['annee']))
{
    try
        {
           $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login, $passwd);
        }
    catch (PDOException $e)
        {
            echo $e;
            exit('problème de connexion à la base');
        }
           
    $requete = 'SELECT Type, Libelle, Date, Montant FROM lignefrais l JOIN fichefrais f ON l.idFicheFrais = f.id WHERE f.mois = :Mois AND f.annee = :Annee WHERE status < 3 AND status > 0';
    
    try
         {
             $req_prep = $connect->prepare($requete);
             $req_prep->execute(array(':Mois'=>$_POST['mois'],
                                     ':Annee'=>$_POST['annee']));
             $resultat = $req_prep->fetchAll(); 
             $nb_result = count($resultat);
             
         }
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         } 
     }
    ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Consultation des frais</title>
    <link href="CSS/Style.css" rel="stylesheet" />
    <link rel="icon" href="../Ressources/favicon.ico" />
</head>
<body>

        <?php include_once("header.php") ?>
<div class="main">
    
    <form method="POST" action="ConsultFrais.php" id="NouvelleLigne" style="margin-top: 50px;">
        <input type="text" name="mois" placeholder="Mois">
        <input type="text" name="annee" placeholder="Année">
        <input type="submit" value="Valider">
    </form>

            <table border='1' id="Recap">
                 <tr style='background-color:rgb(150,150,150);'>
                     <th width="100">Type</th>
                     <th width ="150">Libelle</th>
                     <th width="100">Date</th>
                     <th>Montant</th>
                 </tr>
<?php
         foreach ($resultat as $i) 
         {
         echo '<tr>
                    <th>'.$i[0].'</th>
                    <th>'.$i[1].'</th>
                    <th>'.$i[2].'</th>
                    <th>'.$i[3].'</th>
                </tr>';
             }


?>
</table>
    <div class="main">
</body>