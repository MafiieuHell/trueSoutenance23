<?php
//ouverture de la session
session_start();
if(isset($_SESSION["user"])){
    header("Location: profil.php");
    exit;
}
//on verifie si le form a ete envoyé
if(!empty($_POST)){
    //form envoyé
    //verif des champs
    if(isset($_POST["pseudo"], $_POST["email"] ,$_POST["pass"])
        && !empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["pass"])
    ){
        //form complet
        //protection des données
        $pseudo = strip_tags($_POST["pseudo"]);
       $_SESSION["error"] = [];

       if(strlen($pseudo) < 5){
        $_SESSION["error"][] = "Pseudo trop court";
       }
        //verif de l'email 
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"][] = "addresse email incorecte";
        }
        
        if($_SESSION["error"] === [])
        {
            //on hash le MDP

            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);


            //ajout de control souhaiter

            //on enregistre endb

            require_once "includes/connect.php";

            $sql = "INSERT INTO users(username, email, pass, roles) VALUES
                    (:pseudo, :email, '$pass', '[\"ROLE_USER\"]')";

            $q = $db->prepare($sql);

            $q->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $q->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $q->execute();

            //on recup l'id du new user

            $id = $db->lastInsertId();

            //connection du user 


            //stockage des info user
            $_SESSION["user"] = [
                "id" => $id,
                "pseudo" => $pseudo,
                "email" => $_POST["email"],
                "role" => ["ROLE_USER"]
            ];

            //on redigire vers une page 
            header("Location: profil.php");


        }
    }else{
        $_SESSION["error"] = "form incomplete";

    }
}




$title = "Sign in";


//On inclue l'HTML
include "includes/header.php";
include "includes/navbar.php";
?>
<h1>Inscription</h1>
<?php
    if(isset($_SESSION["error"])){
        foreach($_SESSION["error"] as $message){
            ?>
            <p><?= $message ?></p>
            <?php
        }
        unset($_SESSION["error"]);
    }
?>

<form  method="post">
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Sign in</button>
</form>

<?php
include "includes/footer.php";
?>

