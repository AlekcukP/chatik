<?php
    class ModelChat extends Model
    {
        public $sql_message_update = "UPDATE messages SET message_text = ? WHERE id = ?";
        public $sql_message_delete = "DELETE FROM messages WHERE id = ?";
        public $sql_message_create = "INSERT INTO
                                                chat.messages (user_id, message_text, message_time)
                                            VALUES (?, ?, ?)";
        public $sql_messages_get = "SELECT
                                        messages.user_id,
                                        messages.id, message_text,
                                        message_time, avatar,
                                        users.user_login
                                    FROM messages
                                    JOIN users ON
                                        messages.user_id = users.user_id";
        public $sql_message_get = "SELECT
                                        messages.user_id,
                                        messages.id, message_text,
                                        message_time, avatar,
                                        users.user_login, users.user_id
                                    FROM messages
                                    JOIN users ON
                                        messages.user_id = users.user_id
                                    WHERE id = ?";
        public $sql_user_data = "SELECT
                                    user_id,
                                    user_login,
                                    avatar
                                FROM users
                                WHERE user_id = ?";
        public $sql_user_id = "SELECT user_id FROM messages WHERE id = ?";

        public function getUserId($message_json)
        {
            $message_obj = json_decode($message_json, true);
            return $this->db->getOne($this->sql_user_id, 'i', $message_obj['message_id']);
        }

        public function getMessage($message_id)
        {
            return $this->db->getOne($this->sql_message_get, 'i', $message_id);
        }

        public function getUserData($user_id)
        {
            return $this->db->getOne($this->sql_user_data, 'i', $user_id);
        }

        public function getMessages()
        {
            return $this->db->getAll($this->sql_messages_get);
        }

        public function createMessage($message_json, $current_user_id)
        {
            $message_obj = json_decode($message_json, true);
            $message_time = date('YmdHms');

            return $this->db->setData(
                $this->sql_message_create,
                'iss',
                $current_user_id,
                $message_obj['message_text'],
                $message_time
            );
        }

        public function updateMessage($message_json)
        {
            $message_obj = json_decode($message_json, true);

            $this->db->setData(
                $this->sql_message_update,
                'si',
                $message_obj['message_text'],
                $message_obj['message_id']
            );
        }

        public function deleteMessage($message_json)
        {
            $message_obj = json_decode($message_json, true);
            $this->db->setData($this->sql_message_delete, 'i', $message_obj['message_id']);
        }
    }
