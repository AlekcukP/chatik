<?php
    class ModelLogin extends Model
    {
        public function __construct()
        {
            $this->link = mysqli_connect(HOST_NAME, SQL_LOGIN, SQL_PASSWORD, DB_NAME);
            $this->sql_user_data =
                "SELECT
                    user_id,
                    user_password,
                    user_login,
                    avatar
                FROM users
                WHERE user_login = ?";
        }

        public function getUserData($user_name)
        {
            $user_data = [];

            if ($stmt = mysqli_prepare($this->link, $this->sql_user_data)) {
                mysqli_stmt_bind_param($stmt, 's', $user_name);

                $user_name = $user_name;

                mysqli_stmt_execute($stmt);

                $res = mysqli_stmt_get_result($stmt);
                $user_data = mysqli_fetch_assoc($res);
            }
            mysqli_stmt_close($stmt);

            return $user_data;
        }

        public function checkUser($user_name, $entered_password)
        {
            $user_data = $this->getUserData($user_name);

            if (!$user_data) {
                return 'login';
            }

            if ($user_data['user_password'] === $entered_password){
                return 'confirmed';
            } else {
                return 'password';
            }
        }

        public function setSessionParams($user_name)
        {
            $user_data = $this->getUserData($user_name);

            $_SESSION['user_id'] = $user_data['user_id'];
        }

        public function unsetSessionParams()
        {
            unset($_SESSION['user_id']);
            session_destroy();
        }
    }
