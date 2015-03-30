<?php 
include('SQL.php');

function hashPassword( $pwd )
{
    return sha1('e*?g^*~Ga7' . $pwd . '9!cF;.!Y)?');
}
         $Login = $_POST['Login'];
         $MDP = hashPassword($_POST['MDP']);
         $Poste = $_POST['Poste'];
         $Nom = $_POST['Nom'];
         $Prenom = $_POST['Prenom'];         
        
         $requete = 'INSERT INTO utilisateurs(Login,MotDePasse,Poste,Nom,Prenom) VALUES (:Login,:MDP,:Poste,:Nom,:Prenom)';
         try
         {
                $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login, $passwd);
         }
         catch (PDOException $e)
         {
                exit('problème de connexion à la base');
         }   
         
         try
         {
             $req_prep = $connect->prepare($requete);
             
             $req_prep->execute(array(':Login'=>$Login,
                                      ':MDP'=>$MDP,
                                      ':Poste'=>$Poste,
                                      ':Nom'=>$Nom,
                                      ':Prenom'=>$Prenom));
             header('location: http://localhost/GSB/Formulaires/AccueilAdmin.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
 ?>