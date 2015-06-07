    <?php
    include('SQL.php');
    session_start(); 
    if(!isset($_SESSION['login']))
        {
        header('location: ../Appli/SeConnecter.php');
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

            <?php      
                $requete = 'SELECT * from utilisateurs';

                $req_prep = $connect->prepare($requete);
                $req_prep->execute();
                $resultat = $req_prep->fetchAll(); 
            ?>
            <form method="GET" action="" class="selectUser">
                <table border="1">

    <?php
                foreach ($resultat as $i) 
                    { 
                        echo '<tr>';
                            echo "<td><input type='radio' name='employe' value='$i[0]'></td><td>$i[1]</td><td>$i[2]</td>";
                        echo '</tr>';
                    }

    ?>
                <tr>
                    <td colspan="3">
                        <input type="submit" value="Selectionner"style="width: 290px;">
                    </td>
                </tr>
            </table>
        </form>

    <?php 
            
        if(isset($_GET["employe"]))
        {
       // $requete2 = 'SELECT * from fichefrais f JOIN lignefrais l on l.idFicheFrais = f.id WHERE f.idEmploye == ' . $_POST["employe"];
        $requete2 = "SELECT mois, annee, idEmploye, status, Nom, Prenom, f.id from fichefrais f JOIN utilisateurs u ON u.id = f.idEmploye WHERE f.idEmploye = :employe AND status >= 2 ORDER BY mois";
        try
            {
                $req_prep = $connect->prepare($requete2);
                $req_prep->bindParam(':employe', $_GET['employe']);
                $req_prep->execute();
                $resultat2 = $req_prep->fetchAll(); 
            }
        catch (PDOException $e)
            {
                $message = 'Problème dans la requête de sélection';
                echo $message;
            } 

        foreach($resultat2 as $j)
        {
            if ($j[3] == 2)
            {
                echo "<div style='margin: 10px auto; border: solid 5px white; width: 400px; padding: 20px; background-color: rgb(139,171,210)'>";
                echo "<h4>Fiche de frais de $j[5] $j[4] du mois de $j[0]/$j[1]</h4>"; 
            }
            if ($j[3] == 3)
            {
                echo "<div style='margin: 10px auto; border: solid 5px white; width: 400px; padding: 20px; background-color: rgb(255,185,185)'>";
                echo "<h4>Archive</h4>";
                echo "<h4>Fiche de frais de $j[5] $j[4] du mois de $j[0]/$j[1]</h4>"; 
            }


            $requete3 = "SELECT Type, Libelle, Date, Montant, idFicheFrais, id FROM lignefrais WHERE idFicheFrais = :idficheFrais";
            try
                {
                    $req_prep = $connect->prepare($requete3);
                    $req_prep->bindParam(':idficheFrais', $j[6]);
                    $req_prep->execute();
                    $resultat3 = $req_prep->fetchAll(); 
                }
            catch (PDOException $e)
                {
                    $message = 'Problème dans la requête de sélection';
                    echo $message;
                } 
            echo "<table border='2' style='width: 400px;'>";
            echo "<tr>
                    <td>
                        <b>Type</b>
                    </td>
                    <td>
                        <b>Libelle</b>
                    </td>
                    <td>
                        <b>Date</b>
                    </td>
                    <td>
                        <b>Montant</b>
                    </td>
                </tr>";
            foreach($resultat3 as $k)
            {
              echo "<tr>
                        <td>$k[0]</td>
                        <td>$k[1]</td>
                        <td>$k[2]</td>
                        <td>$k[3]</td>
                    </tr>";
            }
            echo "</table>";

                echo '<form method="POST" action="../Appli/ValiderFiche.php" style="margin: 10 0 -10 0 ">';
                    echo "<input type='hidden' name='id' value=$k[4]>";

            if ($j[3] == 2)
            {
                echo "<input type='hidden' name='status' value='".$_GET['employe']."'>";
                echo "<input type='submit' value='Archiver'>";
            }
            if ($j[3] == 3)
            {
                echo "<input type='hidden' name='employe' value='".$_GET['employe']."'>";
                echo "<input type='hidden' name='status' value='$j[3]'>";
                echo "<input type='submit' value='Désarchiver'>";
            }
                echo '</form>';

            echo "</div>";

            if(!isset($j[0]))
            {
                echo "<h2>Aucune fiche de frais en attente";
            }

             }



        }

    ?>



        
    </body>