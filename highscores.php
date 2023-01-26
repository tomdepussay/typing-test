<!--
Website by Tom Depussay 
v1.0
-->

<?php

require('connect.php');

$sql = $connection->prepare("SELECT users.id, scores.id, MAX(scores.score), users.pseudo, COUNT(scores.score)
FROM users, scores
WHERE users.id = scores.user_id
GROUP BY users.id
ORDER BY MAX(scores.score) DESC;");

$sql->execute();

$array = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meilleur Score - Typing Test</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/ico"/>
</head>
<body>

    <div class="container">
        <h1 class="title">Meilleur Score :</h1>

        <ul>
            <?php foreach ($array as $key => $value) : ?>
                <li><span id="pseudo"><?=$value['pseudo'];?></span> - <?=$value['MAX(scores.score)'];?> MPM - <?=$value['COUNT(scores.score)'];?> tentative<?php if ($value['COUNT(scores.score)'] > 1) {echo "s";} ?></li>
            <?php endforeach; ?>
        </ul>

        <div class="btn-box">
            <a href="index.html" class="btn">Retour</a>
        </div>
    </div>
    
</body>
</html>