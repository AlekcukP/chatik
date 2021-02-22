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
            return $this->getData($this->sql_user_data, 'i', $user_id);
        }

        public function getContacts()
        {
            $contacts = mysqli_query($this->link, $this->sql_conacts_get);

            $result = array();

            while ($row = mysqli_fetch_assoc($contacts)) {
                $result[] = $row;
            }

            return $result;
        }
    }