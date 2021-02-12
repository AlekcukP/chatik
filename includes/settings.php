<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
    }
    $userId = $_SESSION['user_id'];

    // if(isset($_POST['submit'])){
    //     if(strlen($_POST['login'])>1 || strlen($_POST['password'])>1){
    //         mysqli_query($link, "UPDATE users SET user_login = '".mysqli_real_escape_string($link, $_POST['login'])."' WHERE user_id = $userID");
    //     }
    // }
    if (isset($_FILES['avatar'])) {
        $f_err = 0;
        $types = array(
            'jpg',
            'JPG',
            'jpeg',
            'gif',
            'bmp',
            'png'
        );
        $path = '/avatar/';
        $fullPath = $root . '/avatar/';
        $fname = $_FILES['avatar']['name'];
        // $ext = substr($fname, strpos($fname, '.'), strlen($fname) - 1);
        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $newName = 'user_' . $userId . '.' . $ext;
        $avatarSrc = $path . $newName;

        if (!in_array($ext, $types)) {
            $f_err++;
        }

        if ($f_err == 0) {
            move_uploaded_file($_FILES['avatar']['tmp_name'], $fullPath . $fname);
            rename($fullPath . $fname, $fullPath . $newName);

            $updateAvatar = "UPDATE chat.users SET avatar = '$avatarSrc' WHERE user_id = $userId";
            mysqli_query($link, $updateAvatar);
        }
    }
    include_once($root.'/views/settings.phtml');
