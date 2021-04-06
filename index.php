<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design/default.css">
</head>
<body>

    <h1>Welcome to the Blog</h1>
    <p>Derniers billets du blog :</p>

    <?php
        //BDD CONNECTION
        require('src/conn.php');

        //AFFICHAGE DES 5 DERNIERS MESSAGES
        $req = $bdd->query('SELECT * FROM billets');

        while($data = $req->fetch())
        { 
    ?>
            <p><?=htmlspecialchars($data['titre'])?></p>
            <p><?=htmlspecialchars($data['contenu'])?></p>
            <p><?=htmlspecialchars($data['date_creation'])?></p>
            <hr>
    <?php 
        }
            $req->closeCursor();
    ?>  

</body>
</html>