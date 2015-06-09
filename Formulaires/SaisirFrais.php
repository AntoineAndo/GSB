<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']) || $_SESSION['Poste'] != 'Employe' )
    {
    header('location: ../Appli/SeConnecter.php');
    }

include('functions.php');
    $currentMonth = (new dateTime())->format('m');
    $requete2 = 'SELECT id, mois, annee, status, idEmploye FROM fichefrais WHERE status <= 0 AND idEmploye = :id ORDER BY id asc';

    try
        {
            $req_prep = $connect->prepare($requete2);
            $req_prep->execute(array('id'=>$_SESSION['id']));
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
    <title>Saisie des frais</title>
    <link href="CSS/Style.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="icon" href="../Ressources/favicon.ico" />
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>
</head>
<body>
    <?php include_once("header.php") ?> 

<div class="main">
<?php 

    foreach($resultat2 as $fiche)
    {                   

        if($fiche[3] == -1)
            echo '<h2> Fiche de frais refusée du mois de '.$fiche[1].' / '.$fiche[2].'</h2>';
        else
            echo '<h2> Fiche de frais du mois de '.$fiche[1].' / '.$fiche[2].'</h2>';
        ?>
        <div class="fiche">
             <table border='1' id="Recap">
                <?php if($fiche[3] == -1)
                        echo "<tr style='background-color:red;'>";
                      else
                        echo "<tr style='background-color:rgb(150,150,150);'>";
                ?>
                     <th width="100">Type</th>
                     <th width ="150">Libelle</th>
                     <th width="100">Date</th>
                     <th>Montant</th>

            <?php 
                if($fiche[3] == -1)
                     echo '<th></th>';
                     ?>
                     <th></th>
                 </tr>
        <?php      
                $requete = 'SELECT l.id as lid, Type, Libelle, Date, Montant, f.id as fid, f.mois as mois, f.annee as annee FROM lignefrais l JOIN fichefrais f ON l.idFicheFrais = f.id WHERE f.id = '.$fiche[0];

                $req_prep = $connect->prepare($requete);
                $req_prep->execute();
                $resultat = $req_prep->fetchAll(); 

             foreach ($resultat as $ligne) 
             {
                if($fiche[3] == -1)
                {
                    echo '<form method="post" action="../Appli/MAJLigne.php">
                            <tr>
                                <th><input type="text" value="'.$ligne[1].'" name="type" placeholder="'.$ligne[1].'" required></th>
                                <th><input type="text" value="'.$ligne[2].'" name="libelle" placeholder="'.$ligne[2].'" required></th>
                                <th><input style="width:100px" type="text" value="'.$ligne[3].'" name="date" placeholder="'.$ligne[3].'" class="datepicker" required></th>
                                <th><input style="width:80px" type="text" value="'.$ligne[4].'" name="montant" placeholder="'.$ligne[4].'" required></th>
                                <th>
                                    <input type="hidden" name="id" value="'.$ligne[0].'">
                                    <input type="submit" value="Mettre à jour"/>
                            </form>
                        </th>';
                }
                else
                {
                    echo '<tr>
                            <th>'.$ligne[1].'</th>
                            <th>'.$ligne[2].'</th>
                            <th>'.$ligne[3].'</th>
                            <th>'.$ligne[4].'</th>';
                }
                echo '<th>
                        <form method="post" action="../Appli/DeleteLigne.php">
                            <input type="hidden" name="id" value="'.$ligne[0].'">
                            <input type="submit" value="X"/>
                        </form>
                    </th>
                </tr>';
             }


        echo '
                <tr>
                    <td colspan="6">';
                        if ($fiche[1] != $currentMonth)
                        {

                        ?>
                        <form method="POST" action="../Appli/ValiderFiche.php">
                            <?php
                            echo '<input type="hidden" name="id" value="'.$fiche[0].'">
                                  <input type="hidden" name="status" value="'.$fiche[3].'">';
                            ?>
                            <input type="submit" value="Valider cette fiche" style="width: 555px; display:block; margin:auto;">
                        </form>
                        <?php
                        }
                        else {
                            echo '<h4>Cette fiche ne peut pas être validée car le mois n\'est pas encore terminé</h4>';
                        }

             echo '</td>
                </tr>';
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
            <input  type="text" class="datepicker" name="Date" required="required">   
            <input type="text" style="width:62px;" name="Montant" required="required">
            <input type="submit" value="Valider">
        </div>
    </form>

</div>
    
</body>
