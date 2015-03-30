<?php      
include('sql.php');
function Verif_magicquotes ($chaine) 
{
if (get_magic_quotes_gpc()) $chaine = stripslashes($chaine);

return $chaine;
} 

function hashPassword( $pwd )
{
    //return sha1('e*?g^*~Ga7' . $pwd . '9!cF;.!Y)?');
	return $pwd;
}



if (isset($_POST['Login']))
{
    $Login = (isset($_POST['Login']) && trim($_POST['Login']) != '')? Verif_magicquotes($_POST['Login']) : null;
    $MotDePasse = (isset($_POST['MotDePasse']) && trim($_POST['MotDePasse']) != '')? Verif_magicquotes($_POST['MotDePasse']) : null;

    if(isset($Login,$MotDePasse)) 
    {
          $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
                
          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                
          $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8"; 
        
          try
                {
                        $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login, $passwd, $pdo_options);
                }
                catch (PDOException $e)
                {
                        exit('problème de connexion à la base');
                }
        
        // $Login = mysql_real_escape_string($Login);
        // $MotDePasse = mysql_real_escape_string($MotDePasse);
         // $MotDePasse = hashPassword($MotDePasse);
         $requete = 'SELECT Poste,Nom,Prenom FROM utilisateurs WHERE Login like :pseudo AND MotDePasse like :mdp';
    
		try
		{
             $req_prep = $connect->prepare($requete);
             
             $req_prep->execute(array(':pseudo'=>$Login,':mdp'=>$MotDePasse));
             $resultat = $req_prep->fetchAll(); 
             $nb_result = count($resultat);
             
             if ($nb_result == 1)
             {
                 if (!session_id()) session_start();
                
                    $_SESSION['login'] = $Login;
                    foreach ($resultat as $i) {
                        $_SESSION['Poste'] = $i[0];
                        $_SESSION['Nom'] = $i[1];
                        $_SESSION['Prenom'] = $i[2];
                    }
                    
                    if ($_SESSION['Poste'] == 'Employe'){
                        header('location: http://localhost/GSB/Formulaires/AccueilVisiteur.php');
                    }
                    else if ($_SESSION['Poste'] == 'Comptable')
                    {
                        header('location: http://localhost/GSB/Formulaires/AccueilComptable.php');
                    }
                    else if ($_SESSION['Poste'] == 'Admin')
                    {
                        header('location: http://localhost/GSB/Formulaires/AccueilAdmin.php');
                    }
             }
             else if ($nb_result > 1)
             {
                 $message = 'Problème de d\'unicité dans la table';
                 echo $message;
             }
             else
             {
                 $message = 'Le pseudo ou le mot de passe sont incorrect';
                 echo $message;
             }
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
				echo $e;
         }   
    }
} 

?>