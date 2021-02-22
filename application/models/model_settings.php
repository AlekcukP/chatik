<?php

    class ModelSettings extends Model
    {
        public $sql_user_data = "SELECT
                                    user_id,
                                    user_login,
                                    avatar
                                FROM users
                                WHERE user_id = ?";

        public $sql_update_avatar = "UPDATE chat.users SET avatar = ? WHERE user_id = ?";
        public $sql_update_login = "UPDATE chat.users SET user_login = ? WHERE user_id = ?";
        public $sql_update_password = "UPDATE chat.users SET user_password = ? WHERE user_id = ?";

        public function getUserData($user_id)
        {
            return $this->getData($this->sql_user_data, 'i', $user_id);
        }

        public function updateLogin($user_name, $user_id)
        {
            $this->setData($this->sql_update_login, 'si' ,$user_name, $user_id);
        }

        public function updatePassword($user_password, $user_id)
        {
            $this->setData($this->sql_update_password, 'si' ,$user_password, $user_id);
        }

        public function updateAvatar($image, $user_id)
        {
            $root = $_SERVER["DOCUMENT_ROOT"];
            $path = '/avatar/';
            $full_path = $root . $path;
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $image_name = $image['name'];
            $new_name = 'user_' . $user_id . '.' . $ext;
            $avatar_path = $path . $new_name;

            move_uploaded_file($image['tmp_name'], $full_path . $image_name);
            rename($full_path . $image_name, $full_path . $new_name);

            $this->setData($this->sql_update_avatar, 'si', $avatar_path, $user_id);
        }
    }
