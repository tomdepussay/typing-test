<!--
Website by Tom Depussay 
v1.0
-->

<?php

$score = $_REQUEST['score'];
$accuracy = $_REQUEST['accuracy'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat - Typing Test</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/ico"/>
</head>
<body>

    <div class="container">
        <h1 class="title">Résultat</h1>
        <p>Votre score est de <?php echo $score; ?> mots par minute.</p>
        <p>Votre précision est de <?php echo $accuracy; ?>%.</p>

        <form action="insert.php" method="get">
            <input type="hidden" name="score" value="<?php echo $score; ?>">
            <input type="hidden" name="accuracy" value="<?php echo $accuracy; ?>">

            <div class="input-group">
                <label for="name" class="label">Votre prénom</label>
                <input autocomplete="off" name="name" id="name" class="input" type="text">
            </div>

            <div class="btn-box">
                <button class="btn">Suivant</button>
            </div>
        </form>

        <div class="btn-box">
            <a class="btn" href="game.html">Rejouer</a>
        </div>

    </div>
    
</body>
</html>
