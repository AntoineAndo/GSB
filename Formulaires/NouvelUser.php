    <?php
    include('SQL.php');
    session_start(); 
    if(!isset($_SESSION['login']) || $_SESSION['Poste'] != 'Admin')
        {
        header('location: ../Formulaires/SeConnecter.php');
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
        <title>Gestion des utilisateurs</title>
        <link href="CSS/Style.css" rel="stylesheet" />
        <script src="./jquery.js" type="text/javascript" language="JavaScript"></script> 
        <script src="./fonctions.js" type="text/javascript" language="JavaScript"></script> 
        <link rel="icon" href="../Ressources/favicon.ico" />
    </head>
    <body>
        <?php include_once("header.php") ?> 
        <div class="UserButton">
            <h3 id="123456Butt" class="toggleButt">Ajouter un nouvel utilisateur</h3>
            <div id="123456" class="toggleZone" style="overflow: hidden; display: none;">
            <form action="../Appli/CreationUser.php" method="post">
                <table border="1"> 
                    <tr>
                        <th>
                        Nom:
                        </th>
                        <th>
                            <input type="text" name="Nom" required>
                        </th>
                </tr>
                <tr>
                <th>
                Prenom:
            </th>
            <th>
                <input type="text" name="Prenom" required>
                </th>
            </tr>
            <tr>
                <th>
                Poste:
            </th>
            <th>
                <select name="Poste" style="width: 173px;" required>
                  <option selected></option>
                  <option value="Employe">Employé</option> 
                  <option value="Comptable" >Comptable</option>
                  <option value="Admin">Administrateur</option>
                </select>
                </th>
            </tr>
            <tr>
                <th>
                    Login:
                </th>
                <th>
                    <input type="text" name='Login' required>
                </th>
            </tr>
            <tr>
                <th>
                MDP:
                </th>
                <th>
                <input type='text' name='MDP' required>
                </th>
                </tr>
            <tr>
                <td colspan="2">
                    <input value="Valider" type="submit" style="width: 244px; height: 30px;"/>
                </td>
            </tr>
            </table>
            </form>
        </div>
    </div>  

        <?php include_once("header.php") ?> 

            <?php      
                $requete = 'SELECT * from utilisateurs WHERE Poste != "Rekt"';

                $req_prep = $connect->prepare($requete);
                $req_prep->execute();
                $resultat = $req_prep->fetchAll(); 
            ?>
<div class="UserButton">
    <h3 id="654321Butt" class="toggleButt">Modifier un utilisateur</h3>
  <?php if(isset($_POST["employe"]))
            echo '<div id="654321" class="toggleZone" style="overflow: hidden; display: block;">';
        else
            echo '<div id="654321" class="toggleZone" style="overflow: hidden; display: none;">';
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
                    <td colspan="3">
                    <input type="submit" value="Selectionner" style="width: 244px; height: 30px;">
                </td>
                </tr>
            </table>
        </form>

    <?php 
            
        if(isset($_POST["employe"]))
        {
            $requete2 = "SELECT id, Nom, Prenom, Poste, Login, MotDePasse FROM utilisateurs WHERE id = :id ";
           // $requete2 = 'SELECT id, Nom, Prenom, Poste, Login, MotDePasse FROM utilisateurs WHERE id = :id';
            $req = $connect->prepare($requete2);
            //$req->bindParam(':id', $_POST['employe']);
            $req->execute(array('id'=>$_POST['employe']));
            $resultat2 = $req->fetch(); 

function hashPassword( $pwd )
{
    return sha1('e*?g^*~Ga7' . $pwd . '9!cF;.!Y)?');
}

?>


                <table border="1"> 
                    <form action="../Appli/UpdateEmploye.php" method="post">
                    <tr>
                        <th>
                            Nom:
                        </th>
                        <th>
                            <?php echo "<input required='required' type='text' name='Nom' value='$resultat2[Nom]'>"; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Prenom:
                        </th>
                        <th>
                            <?php echo "<input required='required' type='text' name='Prenom' value='$resultat2[Prenom]'>"; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Poste:
                        </th>
                        <th>
                            <?php echo "<input required='required' type='text' name='Poste' value='$resultat2[Poste]'>"; ?>
                        </th>
                    </tr>
                    <tr>
                <th>
                Login:
                </th>
                <th>
                <?php echo "<input required='required' type='text' name='Login' value='$resultat2[Login]'>"; ?>
                </th>
            </tr>
            <tr>
                <th>
                MDP:
                </th>
                <th>
                <?php echo "<input required='required' type='text' name='MotDePasse' value=''>"; ?>
                </th>
                </tr>
            <tr>
                <td colspan="2">
                    <?php echo "<input type='hidden' name='id' value='$resultat2[id]'>"; ?>
                    <input value="Mettre à jour" type="submit" style="width: 244px; height: 30px;"/>
                </td>
            </tr>
            </form>
            <form action="../Appli/UpdateEmploye.php" method="post">
                <tr>
                    <td colspan="2">
                        <?php echo "<input type='hidden' name='id' value='$resultat2[id]'>"; ?>
                        <input value="Supprimer" type="submit" style="width: 244px; height: 30px;"/>
                    </td>
                </tr>
            </form>
            </table>
<?php
        }

    ?>
        </div>
    </div>
</body>
<?php 

}

?>
