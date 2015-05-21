<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
   
    try
           {
               $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login);
           }
    catch (PDOException $e)
           {
               exit('problème de connexion à la base');
           }
           
        $requete= 'UPDATE utilisateurs SET Nom = :Nom, 
    									Prenom = :Prenom,
    									Poste = :Poste,
    									Login = :Login,
    									MotDePasse = MotDePasse
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
             					 'MotDePasse'=>$_POST['MotDePasse']
             					 ));

              if($_SESSION['Poste'] == 'Employe')
                header('location:http://localhost/GSB/Formulaires/SaisirFrais.php');
              else if($_SESSION['Poste'] == 'Comptable')
                header('location:http://localhost/GSB/Formulaires/ValidFrais.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
         
         
    ?>