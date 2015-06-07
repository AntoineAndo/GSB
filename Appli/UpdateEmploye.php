<?php
include('SQL.php');
session_start(); 
function hashPassword( $pwd )
{
    return sha1('e*?g^*~Ga7' . $pwd . '9!cF;.!Y)?');
}
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
           

      if (!isset($_POST['Nom']) || !isset($_POST['Prenom']) || !isset($_POST['Poste']) || !isset($_POST['Login']) || !isset($_POST['MotDePasse']))
      {
        $requete = 'DELETE FROM utilisateurs WHERE id = :id';
        $req_prep = $connect->prepare($requete);
        $req_prep->execute(array('id'=>$_POST['id']));
        header('location: ../Formulaires/NouvelUser.php');
      }
      else {



          $requete= 'UPDATE utilisateurs SET Nom = :Nom, 
  					Prenom = :Prenom,
  					Poste = :Poste,
  					Login = :Login,
  					MotDePasse = :MotDePasse
					WHERE id = :id';

          try
          {
             $req_prep = $connect->prepare($requete);
             
             $req_prep->execute(array(
             					 'id'=>$_POST['id'],
             					 'Nom'=>$_POST['Nom'],
             					 'Prenom'=>$_POST['Prenom'],
             					 'Poste'=>$_POST['Poste'],
             					 'Login'=>$_POST['Login'],
             					 'MotDePasse'=> hashPassword($_POST['MotDePasse'])
             					 ));

                header('location: ../Formulaires/NouvelUser.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
         

      }
         
    ?>