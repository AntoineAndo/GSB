    <?php
    include('SQL.php');
    session_start(); 
    if(!isset($_SESSION['login']))
        {
        header('location: ../Appli/SeConnecter.php');
        }
       
    include('functions.php');

        ?>

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Validation des frais</title>
        <link href="CSS/Style.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="icon" href="../Ressources/favicon.ico" />
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
                $requete = 'SELECT u.id, u.Nom, u.Prenom, COUNT(f.status) AS COUNT FROM fichefrais f JOIN utilisateurs u ON f.idEmploye = u.id WHERE f.status = 1 AND Poste != "Rekt" GROUP BY u.id ORDER BY COUNT DESC, u.NOM ASC';

                $req_prep = $connect->prepare($requete);
                $req_prep->execute();
                $users = $req_prep->fetchAll(); 

                if($users == array())
                {
                    echo '<h2>Aucune fiche en attente</h2>';
                }
                else
                {
                
            ?>




            <form method="GET" class="selectUser" action="">
                <table border="1" style="width: 300px;">

    <?php
                foreach ($users as $i) 
                    { 
                        echo '<tr>';
                            echo "<td><input type='radio' name='employe' value='$i[0]'></td><td>$i[1]</td><td>$i[2]</td><td><b>$i[3] fiche(s) des frais en attente</b></td>";
                        echo '</tr>';
                    }

    ?>
                <tr>
                    <td colspan="4">
                        <input type="submit" value="Selectionner" style="width: 290px;">
                    </td>
                </tr>
            </table>
        </form>

    <?php 
}
            
        if(isset($_GET["employe"]))
        {
       // $requete2 = 'SELECT * from fichefrais f JOIN lignefrais l on l.idFicheFrais = f.id WHERE f.idEmploye == ' . $_POST["employe"];
        $requete2 = "SELECT mois, annee, idEmploye, status, Nom, Prenom, f.id from fichefrais f JOIN utilisateurs u ON u.id = f.idEmploye WHERE f.idEmploye = :employe AND status = 1 ORDER BY mois";
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
            echo "<div style='margin: 10px auto; border: solid 5px white; width: 400px; padding: 20px; background-color: rgb(139,171,210)'>";
            echo "<h4>Fiche de frais de $j[5] $j[4] du mois de $j[0]/$j[1]</h4>"; 

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
            echo '</table>
                <form method="POST" action="../Appli/ValiderFiche.php" style="margin: 10 0 -10 0 ">
                    <input type="hidden" name="employe" value="'.$_GET['employe'].'">
                    <input type="hidden" name="id" value="'.$k[4].'">
                    <input type="submit" value="Valider" name="submit">
                    <input type="submit" value="Refuser" name="submit">
                </form>
            </div>';

        }
        if(!isset($j[0]))
        {
            echo "<h2>Aucune fiche de frais en attente";
        }

    }

?>
    
</body>