<?php
include "includes/connect.php";
//on verifie si on a un id
if (!isset($_GET['id']) || empty($_GET['id'])){
    //je n'ai pas d'id
    header('location: articles.php');
    exit;
}

//je recupere l'id 
$id = $_GET['id'];

//on cherche k'artilce dans la DB

$sql = "SELECT * FROM articles WHERE id =:id";

//on prepare la requete
$q = $db->prepare($sql);

// on injecte les parametre
$q->bindValue(':id', $id, PDO::PARAM_INT);

//on execute la requete
$q->execute();

//on recupere l'article
$article = $q->fetch();

//on verifie si l'article est vide
if(!$article){
    //pas d'article , error 404
    http_response_code(404);
    echo"Article inexistant";
    exit;

}
//on a un article
//on definie le titre
$title = strip_tags($article["title"]);

//On inclue l'HTML
include "includes/header.php";
include "includes/navbar.php";
?>


<section>
    <article>
        <h1><?= strip_tags($article["title"]) ?></h1>
        <p>Publié le <?=$article["created_at"] ?></p>
        <div><?= strip_tags($article["content"]) ?></div>
    </article>

</section>

<?php
include "includes/footer.php";
?>

