<?php
    class ModelRegister extends Model
    {
        public function __construct()
        {
            $this->link = mysqli_connect(HOST_NAME, SQL_LOGIN, SQL_PASSWORD, DB_NAME);
            $this->sql_login_check = "SELECT user_id FROM users WHERE user_login = ?";
            $this->sql_create_user = "INSERT INTO chat.users (user_login, user_password, avatar) VALUES (?,?,?)";
        }

        public function getUserLogin($user_name)
        {
            $res =[];
            if ($stmt = mysqli_prepare($this->link, $this->sql_login_check)) {
                mysqli_stmt_bind_param($stmt, 's', $user_name);

                $user_name = $user_name;

                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
            }

            mysqli_stmt_close($stmt);
            return $res;
        }

        public function checkUser($user_name)
        {
            $error =[];

            if (mysqli_num_rows($this->getUserLogin($user_name)) > 0) {
                $err[] = 'User with this login has already exists';
            }

            if (! preg_match('/^[a-zA-Z0-9]+$/', $user_name)) {
                $error[] = 'Login can consist only letters of the English alphabet and numbers';
            }

            if (strlen($user_name) < 3 || strlen($user_name) > 30) {
                $error[] = 'Login must be at least 3 symbols and no more than 30';
            }

            return $error;
        }

        public function createUser($user_name, $user_password)
        {
            if ($stmt = mysqli_prepare($this->link, $this->sql_create_user)) {
                mysqli_stmt_bind_param($stmt, 'sss', $user_name, $user_password, $user_avatar);

                $user_name = $user_name;
                $user_password = trim($user_password);
                $user_avatar = '/avatar/default.png';

                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
        }
    }
