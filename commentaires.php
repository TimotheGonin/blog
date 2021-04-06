<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
    <link rel="stylesheet" href="design/default.css">
</head>
    <body>
        <h1>Welcome to the Blog</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <?php
            //BDD CONNECTION
            require('src/conn.php');

            //RECUPERATION DU BILLET 
            $req = $bdd->prepare("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets WHERE id = ?");
            $req->execute(array($_GET['billet']));

            $data = $req->fetch();
            
        ?>

        <div class="news">

            <!-- BILLET TITLE -->
            <h3>
                <?=htmlspecialchars($data['titre']);?>
                <em>le <?=htmlspecialchars($data['date_creation_fr']);?></em>
            </h3>
            
            <!-- BILLET CONTENT -->
            <p>
            <?=htmlspecialchars($data['contenu']);?>
            </p>
        </div>

        <h2>Commentaires</h2>

        <?php
            $req->closeCursor();
            
            //RECUPERATION COMMENTAIRES
            $req = $bdd->prepare("SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin%ss') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire");
            $req->execute(array($_GET['billet']));

            while ($donnees = $req->fetch())
            {
        ?>
            <!-- AUTEUR DATE COMMENTAIRE -->
            <p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
            <p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
        <?php
            }
            
            $req->closeCursor();
        ?>

    </body>
</html>