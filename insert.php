<!--
Website by Tom Depussay 
v1.0
-->

<?php

require('connect.php');

$pseudo = trim($_REQUEST['name']);
$pseudo = htmlspecialchars($pseudo);
$pseudo = ucfirst(strtolower($pseudo));

if (empty($pseudo) || $_REQUEST['score'] < 20 || $_REQUEST['accuracy'] < 30 || $_REQUEST['accuracy'] > 150) {
    header('Location: index.html');
    exit();
}


$sql = $connection->prepare("SELECT * FROM users WHERE pseudo = :pseudo");

$sql->execute(array(
        ':pseudo' => trim($_REQUEST['name'])
    ));

if ($sql->rowCount() == 0) {
    $sql_user = $connection->prepare("INSERT INTO users (pseudo) VALUES (:pseudo)");

    $sql_user->bindParam(':pseudo', trim($_REQUEST['name']));

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
$sql_score->bindParam(':score', trim($_REQUEST['score']));
$sql_score->bindParam(':accuracy', trim($_REQUEST['accuracy']));

$sql_score->execute();

header('Location: index.html');

?>