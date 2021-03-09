<?php
    class ModelContacts extends Model
    {
        public $sql_conacts_get = 'SELECT user_id, user_login, avatar FROM users';

        public $sql_user_data = "SELECT
                                    user_id,
                                    user_login,
                                    avatar
                                FROM users
                                WHERE user_id = ?";

        public function getUserData($user_id)
        {
            return $this->db->getOne($this->sql_user_data, 'i', $user_id);
        }

        public function getContacts()
        {
            return $this->db->getAll($this->sql_conacts_get);
        }
    }
