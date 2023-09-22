
    <?php   
        //Constante d'environnement 
        define("DBHOST","localhost");
        define("DBUSER","root");
        define("DBPASS","");
        define("DBNAME","perso");

        //DSN de connextion
        $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

        //Connexion à la base de donnée
        try {
            $db = new PDO($dsn, DBUSER, DBPASS);

            //Verificartion de l'UTF8
            $db->exec("SET NAMES utf8");

            //choix du "fetch"

            $db->setAttribute
            (PDO::ATTR_DEFAULT_FETCH_MODE,
             PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("An error occurred: ".$e->getMessage());
        }



    ?>
