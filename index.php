<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="design/default.css">
</head>
    <body>

        <h1>Welcome to the Blog</h1>
        <p>Derniers billets du blog :</p>

        

        <?php
            //BDD CONNECTION
            require('src/conn.php');

            //AFFICHAGE DES 5 DERNIERS MESSAGES
            $req = $bdd->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5");

            while($data = $req->fetch())
            { 
        ?>
                <div class="news">

                    <!-- BILLET TITLE -->
                    <h3>
                        <?=htmlspecialchars($data['titre']);?>
                        <em>
                            le <?=htmlspecialchars($data['date_creation_fr']);?>
                        </em>
                    </h3>

                    <!-- BILLET CONTENT -->
                    <p>
                        <?=htmlspecialchars($data['contenu']);?>
                    </p>

                    <!-- COMMENT LINK -->
                    <p>
                        <em>
                            <a href="commentaires.php?billet=<?=$data['id'];?>">Commentaires</a>
                        </em>
                    </p>
                </div>
        <?php 
            }
                $req->closeCursor();
        ?>  

    </body>
</html>