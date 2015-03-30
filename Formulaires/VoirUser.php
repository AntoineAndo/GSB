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
                   exit('problème de connexion à la base');
           }
           
    $requete = 'SELECT Login,Poste,Nom,Prenom FROM utilisateurs order by id';
    
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
    <title>Consulter Frais</title>
    <link href="CSS/Accueil.css" rel="stylesheet" />
</head>
<body>
     <header>
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
                     <th>Login</th>
                     <th>Poste</th>
                     <th>Nom</th>
                     <th>Prenom</th>
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
</body>

<?php } ?>
