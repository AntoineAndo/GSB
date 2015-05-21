    <?php
    include('SQL.php');
    session_start(); 
    if(!isset($_SESSION['login']))
        {
        header('location: http://localhost/GSB/Appli/SeConnecter.php');
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
        <?php include_once("header.php") ?> 
        <form action="CreationUser.php" method="post">
            Nom:
            <input type="text" name="Nom">
            Prenom:
            <input type="text" name="Prenom">
            Poste:
            <input type='text' name='Poste'>
            Login:
            <input type="text" name='Login'>
            MDP:
            <input type='text' name='MDP'>
            <input value="Valider" type="submit" />
        </form>

<br><br><br><br><br><br>

        <?php include_once("header.php") ?> 

            <?php      
                $requete = 'SELECT * from utilisateurs';

                $req_prep = $connect->prepare($requete);
                $req_prep->execute();
                $resultat = $req_prep->fetchAll(); 
            ?>
            <form method="POST" action="">
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
                    <input type="submit" value="Selectionner">
                </tr>
            </table>
        </form>












    <?php 
            
        if(isset($_POST["employe"]))
        {
            $requete2 = 'SELECT id, Nom, Prenom, Poste, Login, MotDePasse FROM utilisateurs WHERE id = :id';
   
            $req_prep = $connect->prepare($requete);
            $req_prep->bindParam(':id', $_POST['employe']);
            $req_prep->execute();
            $resultat2 = $req_prep->fetch(); 

function hashPassword( $pwd )
{
    return sha1('e*?g^*~Ga7' . $pwd . '9!cF;.!Y)?');
}

            echo "<form method='POST' action='../Appli/UpdateEmploye.php'> ";
                echo "<input type='hidden' name='id' value='$resultat2[id]'>";
                echo "<input required='required' type='text' name='Nom' value='$resultat2[Nom]'>";
                echo "<input required='required' type='text' name='Prenom' value='$resultat2[Prenom]'>";
                echo "<input required='required' type='text' name='Poste' value='$resultat2[Poste]'>";
                echo "<input required='required' type='text' name='Login' value='$resultat2[Login]'>";
                echo "<input required='required' type='text' name='MotDePasse' value=''>";
                echo "<input type='submit' value='Mettre à jour'>";
            echo "</form>";

        }

    ?>








    </body>
    <?php 

    }

    ?>
