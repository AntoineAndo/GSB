   <?php

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