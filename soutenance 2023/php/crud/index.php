<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Listes des clients</h2>
        <a class="btn btn-primary "href="/myshop/create.php" role="button">Nouveau Client</a> 
        <table class="table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Mail</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Créé le</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "myshop";

                // connextion a la base de donnée
                $connection = new mysqli($servername, $username, $password,$database);

                //verification de la connexion
                if ($connection->connect_error) {
                    die("connection échoué:" . $connection->connect_error);
                }

                //lire les colones de la base de donnée
                $sql = "SELECT * FROM clients";
                $result = $connection ->query($sql);
                

                if(!$result){
                    die ("invalid query:" . $connection->error);
                }

                //lis les data de chaque colonne
                while($row = $result->fetch_assoc()){
                    echo "                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/myshop/edit.php?id=$row[id]'>éditer</a>
                        <a class='btn btn-danger btn-sm' href='/myshop/delete.php?id=$row[id]'>suprimer</a>

                    </td>
                </tr>";
                }
?>



            </tbody>
        </table>
    </div>
</body>
</html>