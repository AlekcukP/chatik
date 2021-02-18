<?php

    class ModelSettings extends Model
    {
        public $sql_user_data = "SELECT
                                    user_id,
                                    user_login,
                                    avatar
                                FROM users
                                WHERE user_id = ?";

        public $sql_user_avatar = "UPDATE chat.users SET avatar = ? WHERE user_id = ?";

        public function getUserData()
        {
            $user_data = [];

            if ($stmt = mysqli_prepare($this->link, $this->sql_user_data)) {
                mysqli_stmt_bind_param($stmt, 'i', $user_id);

                $user_id = $_SESSION['user_id'];

                mysqli_stmt_execute($stmt);

                $res = mysqli_stmt_get_result($stmt);
                $user_data = mysqli_fetch_assoc($res);
            }
            mysqli_stmt_close($stmt);

            return $user_data;
        }

        public function checkFile($file)
        {
            $error = '';
            $types = array(
                'jpg',
                'JPG',
                'jpeg',
                'gif',
                'bmp',
                'png'
            );
            $size = 5*1024*1024;
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            if ($file['size']>$size) {
                $error = 'Image size can not be over 5 mb.';
            }

            if (! in_array($ext, $types)) {
                $error = 'Image is not image';
            }

            return $error;
        }

        public function updateAvatar($image)
        {
            $root = $_SERVER["DOCUMENT_ROOT"];
            $path = '/avatar/';
            $full_path = $root . $path;
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $image_name = $_FILES['avatar']['name'];
            $new_name = 'user_' . $_SESSION['user_id'] . '.' . $ext;

            move_uploaded_file($_FILES['avatar']['tmp_name'], $full_path . $image_name);
            rename($full_path . $image_name, $full_path . $new_name);

            if ($stmt = mysqli_prepare($this->link, $this->sql_user_avatar)) {
                mysqli_stmt_bind_param($stmt, 'si',$avatar_path, $user_id);

                $user_id = $_SESSION['user_id'];
                $avatar_path = $path . $new_name;

                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
    }
