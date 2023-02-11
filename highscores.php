<!--
Website by Tom Depussay 
v1.0
-->

<?php

require('connect.php');


$sql = $connection->prepare("SELECT users.id as 'uid', users.pseudo as 'pseudo', MAX(scores.score) as 'score'
FROM users, scores
WHERE users.id = scores.user_id
GROUP BY users.id
ORDER BY MAX(scores.score) DESC;");

$sql->execute();

$array = $sql->fetchAll();

$array2 = [];

for ($i = 0; $i < count($array); $i++){
    $sql2 = $connection->prepare("SELECT MAX(scores.accuracy) as 'accuracy' FROM scores WHERE scores.user_id = :uid AND scores.score = :score");
    $sql2->bindParam(':uid', $array[$i]['uid']);
    $sql2->bindParam(':score', $array[$i]['score']);
    $sql2->execute();
    array_push($array2, $sql2->fetch());
}

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

    <div id="highscore">
        <h1 class="title" id="title-highscore">Meilleur Score :</h1>

        <ul>
            <?php for ($i = 0; $i < count($array); $i++) : ?>
                <?php
                if ($i == count($array) - 1){
                    $position = "last";
                    $array[$i]['pseudo'] = "💩" . $array[$i]['pseudo'] . "💩";
                }
                else {
                    $position = $i + 1;
                }
                ?>
                <li id="position-<?= $position ?>"><?=$i + 1?> - <?=$array[$i]['pseudo'];?> - <?=$array[$i]['score'];?> MPM - <?=$array2[$i]['accuracy'];?>%</li>
            <?php endfor; ?>
        </ul>

        <a href="index.html" class="btn" id="btn-highscore">Retour</a>
    </div>
    
</body>
</html>