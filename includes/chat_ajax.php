<?php
    session_start();

    $json = file_get_contents('php://input');
    $obj = json_decode($json, true);

    $messageId = $obj['messageId'];
    $updatedText = $obj['newMessage'];

    $sqlUserId = "SELECT user_id FROM messages WHERE id = $messageId";

    $getId = mysqli_query($link, $sqlUserId);
    $userId = mysqli_fetch_assoc($getId);

    if ($userId['user_id'] === $_SESSION['user_id']) {
        if ($obj['action'] === 'update') {
            $updateSql = "UPDATE messages SET message_text = '$updatedText' WHERE id = $messageId";
            $updateMessage = mysqli_query($link, $updateSql);
        } elseif($obj['action'] === 'delete') {
            $deleteSql = "DELETE FROM messages WHERE id = $messageId";
            $deleteMessage = mysqli_query($link, $deleteSql);
        }
    }
