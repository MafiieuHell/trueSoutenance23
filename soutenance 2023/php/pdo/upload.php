<?php
//verification de l'envoi des fichiers

if(isset($_FILES["image"]) && $_FILES["image"]["error"] === 0){

    //on a reçu l'image 
    // in proced aux verifications  (extention + type mime)
    $allowed = [
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png",
    ];
    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    //on verifie l'absence de l'extension dans les clés de $allowed ou du type mime
    if(!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)){
        // extension ou type incorect
        die("Erreur : format du fichier incorecte");

    }
    //le tpe est correct
    //on limite à 1Mo
    if($filesize > 1024 * 1024){
        die("fichier trop lourd");
    }
    
    //on genere un nom unique
    $newname = md5(uniqid());
    //on genere le chemin complet
    $newfilename = __DIR__ . "/uploads/$newname.$extension";
    
    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)){
        die("Erreur :");
    }

    //on interdit l'execution du fichier
    chmod($newfilename, 0644);

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>ajout de fichier</h1>
<form method="post" enctype="multipart/form-data">
    <div>
        <label for="ficher">image</label>
        <input type="file" name="image" id="ficher">
    </div>
    <button type="submit">envoyer</button>
</form>

</body>
</html>
