<!--
Website by Tom Depussay 
v1.0
-->

<?php

if (!isset($_POST['score']) || !isset($_POST['accuracy'])){
    header('Location: index.html');
    exit();
}

$score = $_POST['score'];
$accuracy = $_POST['accuracy'];



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

    <div class="container" id="resultat">
        <h1 class="title" id="resultat-title">Résultat</h1>
        <p>Votre score est de <?php echo $score; ?> mots par minute.</p>
        <p>Votre précision est de <?php echo $accuracy; ?>%.</p>

        <form action="insert.php" method="post">
            <input type="hidden" name="score" value="<?php echo $score; ?>">
            <input type="hidden" name="accuracy" value="<?php echo $accuracy; ?>">

            <div class="input-group">
                <label for="name" class="label">Votre prénom :</label><br>
                <input autocomplete="off" name="name" id="name" class="input" type="text" autofocus>
            </div>

            <input class="btn highlight-btn" id="submit" type="submit">
            <a class="btn" href="game.html">Rejouer</a>
        </form>
    </div>
    
</body>
</html>