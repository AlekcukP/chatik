<?php
    class ModelRegister extends Model
    {
        public $sql_login_check = "SELECT user_id FROM users WHERE user_login = ?";
        public $sql_create_user = "INSERT INTO chat.users (user_login, user_password, avatar) VALUES (?,?,?)";

        public function getUserLogin($user_name)
        {
            return $this->getData($this->sql_login_check, 's', $user_name);
        }

        public function checkUser($user_name)
        {
            $error = [];

            if (mysqli_num_rows($this->getUserLogin($user_name)) > 0) {
                $err[] = 'User with this login has already exists';
            }

            if (!preg_match('/^[a-zA-Z0-9]+$/', $user_name)) {
                $error[] = 'Login can consist only letters of the English alphabet and numbers';
            }

            if (strlen($user_name) < 3 || strlen($user_name) > 30) {
                $error[] = 'Login must be at least 3 symbols and no more than 30';
            }

            return $error;
        }

        public function createUser($user_name, $user_password)
        {
            $user_password = trim($user_password);
            $user_avatar = '/avatar/default.png';

            $this->setData($this->sql_create_user, 'sss', $user_name, $user_password, $user_avatar);
        }
    }
