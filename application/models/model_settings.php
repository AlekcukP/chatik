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
            return $this->db->getOne($this->sql_user_data, 'i', $user_id);
        }

        public function updateLogin($user_name, $user_id)
        {
            $this->db->setData($this->sql_update_login, 'si' ,$user_name, $user_id);
        }

        public function updatePassword($user_password, $user_id)
        {
            $this->db->setData($this->sql_update_password, 'si' ,$user_password, $user_id);
        }

        public function updateAvatar($avatar_path, $user_id)
        {
            $this->db->setData($this->sql_update_avatar, 'si', $avatar_path, $user_id);
        }
    }
