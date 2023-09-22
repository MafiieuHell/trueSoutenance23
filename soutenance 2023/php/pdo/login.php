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
    if(isset($_POST["email"], $_POST["pass"])
        && !empty($_POST["email"] && !empty($_POST["pass"]))
    ){
        $_SESSION["error"] = [];
        //verif email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"][] = "ce nest pas un email";
        }

        if($_SESSION["error"] === [])
        {

            //connexion a la db
            require_once "includes/connect.php";

            $sql = "SELECT * FROM users WHERE email = :email";

            $q = $db->prepare($sql);

            $q->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

            $q->execute();
            
            $user = $q->fetch();

           
            //verification du user
            if($user){
                // user exist
                //verification du mdp de user
                if(password_verify($_POST["pass"], $user["pass"])){
                    //le mdp est bon
                    
                    //stockage des info du user
                    $_SESSION["user"] = [
                        "id" => $user["id"],
                        "pseudo" => $user["username"],
                        "email" => $user["email"],
                        "role" => $user["roles"]
                    ];
        
                    
                   
                        //on redigire vers une page 
                        header("Location: profil.php"); 
                }else{
                    //mdp faux
                    $_SESSION["error"][] = "mdp ou user incorecte";
                }
                
            }else{
                //user inexistant
                $_SESSION["error"][] = "mdp ou user incorecte";
            }
            
        }
    }
}




$title = "Log in";


//On inclue l'HTML
include "includes/header.php";
include "includes/navbar.php";
?>
<h1>connexion</h1>
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
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Log in</button>
</form>

<?php
include "includes/footer.php";
?>

