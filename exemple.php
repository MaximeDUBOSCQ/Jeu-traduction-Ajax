<?php
$file=$_FILES["mon_fichier"];
echo "nom origine : ".$file["name"]."<br>";
echo "Taille      : ".$file["size"]."<br>";
echo "fichier temporaire sur le serveur : ".$file["tmp_name"]."<br>";
echo "type du fichier : ".$file["type"]."<br>";

if ($file["error"]) // traitement des erreurs
{	echo "il y a une erreur<br>";
	$err = $file["error"] ;
	if ($err == UPLOAD_ERR_INI_SIZE)
		echo "Le fichier est plus gros que le max autorisé par PHP";
	elseif ($err == UPLOAD_ERR_FORM_SIZE)
			echo "le fichier est plus gros qu'indiqué dans le formulaire";
		elseif ($err == UPLOAD_ERR_PARTIAL)
				echo "le fichier n'a été que partiellement téléchargé";
			elseif ($err == UPLOAD_ERR_NON_FILE)
				echo "Aucun fichier n'a été téléchargé";
}
else {
	if (preg_match("/jpeg/",$file["type"])){
			$file_def="uploads".'/'.$file["name"];
			 copy($file['tmp_name'], $file_def);
			 echo "Fichier uploadé dans : ".$file_def;
		} 
	else {
		echo "fichier non jpg !";
	}
}

?>
