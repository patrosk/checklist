<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$listId = $_GET['id'];
$userId = $_SESSION['user']['id'];


if (isset($_POST['new-title'])) {
    $newTitle = trim(filter_var($_POST['new-title']));

    if (empty($newTitle)) {

        redirect('/');
    }

    $statement = $database->prepare('UPDATE lists SET title = :title WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':title', $newTitle, PDO::PARAM_STR);
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();
}

redirect('/loggedin.php');
