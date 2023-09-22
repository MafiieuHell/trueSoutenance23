<?php
//traitement du form
if(!empty($_POST)){
    if(
        isset($_POST["titre"], $_POST["contenu"])
        && !empty($_POST["titre"]) && !empty($_POST["contenu"])
    ){
        //recperation des données avec protection contre les failles XS
        $titre = strip_tags($_POST["titre"]);

        $contenu = htmlspecialchars($_POST["contenu"]);

        //connection a la db
        require_once "../../includes/connect.php";

        $sql = "INSERT INTO articles (title, content) VALUES (:title, :content)";

        //on prepare la requete
        $q = $db->prepare($sql);

        //on injecte les valeur
        $q->bindValue(":title", $titre, PDO::PARAM_STR);
        $q->bindValue(":content",$contenu, PDO::PARAM_STR);

        //on execute la requete
        if(!$q->execute()){
            die("Une erreur est survenu");

        }
        //on recupere l'id de l'article
        $id = $db->lastInsertId();

        die("Article numéro $id ajouté");


    }else{
        die("form incompler");
    }
}

$titles = "ajout d'un articles";
include_once "../../includes/header.php";
include_once "../../includes/navbar.php";
?>
<h1>Ajouter un article</h1>

<form action="" method="post">
    <div>
        <label for="titre">titre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div>
        <label for="contenu">contenu</label>
        <textarea name="contenu" id="contenu"></textarea>
    </div>
    <button type="submit">Enregistrer</button>

</form>


<?php
include_once "../../includes/footer.php";
?>