<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: SeConnecter.php');
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
           
    $requete= 'DELETE FROM lignefrais WHERE id = :id';
    try
         {
             $req = $connect->prepare($requete);
             
             $req->execute(array(':id'=>$_POST['id']));
             
             header('location: ../Formulaires/SaisirFrais.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
         
         
    ?>