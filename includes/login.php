<?php
    session_start();

    if (isset($_POST['submit'])) {

        $userResult = mysqli_query(
            $link,
            "SELECT
            user_id,
                user_password,
                user_login,
                avatar
            FROM users
            WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."'");

        $userData = mysqli_fetch_assoc($userResult);



        if ($userData['user_password'] === $_POST['password']) {

            $_SESSION['user_id'] = $userData['user_id'];
            $_SESSION['user_login'] = $userData['user_login'];
            $_SESSION['avatar'] = $userData['avatar'];

            setcookie('CookieMy', $userData['user_login'], time()+60*60*24*10);

            header('Location: index.php?page=chat');

            exit();
        }

        else {
            print 'You entered wrong password';
        }
    }

    if (isset($_SESSION['user_id'])) {
        header('Location: index.php?page=chat');
    }

    include_once($root.'/views/login.phtml');
