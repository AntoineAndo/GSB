aaaa
<?php
include('SQL.php');
session_start(); 
$date = new DateTime();
if(!isset($_SESSION['login']))
    {
    header('location: ./SeConnecter.php');
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

          $requete= 'UPDATE lignefrais SET 
            Type = :Type, 
  					Libelle = :Libelle,
  					Date = :Date,
  					Montant = :Montant
					WHERE id = :id';

         $date = date("Y/m/d H:i:s ", strtotime($_POST["date"]));


echo $_POST['type'];



          try
          {
             $req_prep = $connect->prepare($requete);
             
             $req_prep->execute(array(
             					 'Type'=>$_POST['type'],
             					 'Libelle'=>$_POST['libelle'],
             					 'Date'=>$date,
             					 'Montant'=>$_POST['montant'],
                       'id'=>$_POST['id'])
             					 );

                header('location: ../Formulaires/SaisirFrais.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
         
         
    ?>