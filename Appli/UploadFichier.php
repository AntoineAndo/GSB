<?php
  if(!empty($_FILES))
  {
       echo 'coucou <br>';
       $f1_size = $_FILES['Justificatif']['size'];  
       $f1_name = $_FILES['Justificatif']['name'];  
       $f1_tmpname = $_FILES['Justificatif']['tmp_name'];  
       
       $ext = strtolower(substr($f1_name,strrpos($f1_name, ".")+1));
       
       $valides = array("txt","doc","pdf");
       
       if ($f1_size > 100000)  
        {  
            $infos .= "- Le fichier est trop volumineux!<br>\n";  
        }  
        else if(!in_array($ext,$valides))  
        {  
            $infos .= "- Ce type de fichier n'est pas accepté!<br>\n";  
        }
        else
        {
            $target = "http://localhost/GSB/Upload/";
        }
        $date = date("d-m-Y");
        $nomdestination = "$nom-$prenom-$date";
        
        
        
        echo $f1_name . '<br>';
   
        
        $target = "http://localhost/GSB/Upload/";
        $target = $target . basename( $_FILES['Justificatif']['name']) ; 
       
        echo $target;
       
        move_uploaded_file($_FILES['Justificatif']['tmp_name'], $target);

       
  }
?>