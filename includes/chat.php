<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
    }

    if (isset($_POST['message'])) {
        $sql = "INSERT INTO chat.messages (user_id, message_text, message_time) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, 'iss', $currentUserId, $messageText, $messageDate);

            $currentUserId = $_SESSION['user_id'];
            $messageText = $_POST['message'];
            $messageDate = date('YmdHms');

            mysqli_stmt_execute($stmt);
        }

    mysqli_stmt_close($stmt);
    }

    $query = mysqli_query(
        $link,
        "SELECT
            messages.user_id,
            messages.id, message_text,
            message_time, avatar,
            users.user_login
        FROM messages
        JOIN users ON
            messages.user_id = users.user_id"
    );

    function getMessages($query){
        $result = array();

        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }

        return $result;
    }

    $messages = getMessages($query);

    include_once($root.'/views/chat.phtml');
