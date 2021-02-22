<?php
    class ModelLogin extends Model
    {
        public $sql_user_data = "SELECT
                                    user_id,
                                    user_password,
                                    user_login,
                                    avatar,
                                    email_verificated
                                FROM users
                                WHERE user_login = ?";

        public function getUserData($user_name)
        {
            return $this->getData($this->sql_user_data, 's', $user_name);
        }
    }
