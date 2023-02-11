<!--
Website by Tom Depussay 
v1.0
-->

<?php

require('connect.php');

$pseudo = trim($_POST['name']);
$pseudo = htmlspecialchars($pseudo);
$pseudo = ucfirst(strtolower($pseudo));

if (empty($pseudo) || $_POST['score'] < 20 || $_POST['accuracy'] < 30 || $_POST['accuracy'] > 150) {
    header('Location: index.html');
    exit();
}


$sql = $connection->prepare("SELECT * FROM users WHERE pseudo = :pseudo");

$sql->execute(array(
        ':pseudo' => trim($_POST['name'])
    ));

if ($sql->rowCount() == 0) {
    $sql_user = $connection->prepare("INSERT INTO users (pseudo) VALUES (:pseudo)");

    $sql_user->bindParam(':pseudo', trim($_POST['name']));

    $bol = $sql_user->execute();
    
    if ($bol) {
        echo "Utilisateur ajouté";
    } else {
        echo "Erreur";
    }

    $sql->execute();

} 

$array = $sql->fetchAll();


$user_id = $array[0]['id'];

$sql_score = $connection->prepare("INSERT INTO scores (user_id, score, accuracy) VALUES (:user_id, :score, :accuracy)");

$sql_score->bindParam(':user_id', $user_id);
$sql_score->bindParam(':score', trim($_POST['score']));
$sql_score->bindParam(':accuracy', trim($_POST['accuracy']));

$sql_score->execute();

header('Location: index.html');

?>