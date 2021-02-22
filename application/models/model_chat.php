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

        public function getMessages()
        {
            $messages = mysqli_query($this->link, $this->sql_messages_get);

            $result = array();

            while ($row = mysqli_fetch_assoc($messages)) {
                $result[] = $row;
            }

            return $result;
        }

        public function createMessage($message_text, $current_user_id)
        {
            $message_date = date('YmdHms');
            $this->setData($this->sql_message_create, 'iss', $current_user_id, $message_text, $message_date);
        }

        public function updateMessage($json)
        {
            $message_obj = json_decode($json, true);
            $message_id = $message_obj['message_id'];
            $message_text = $message_obj['message_text'];

            $this->setData($this->sql_message_update, 'si', $message_text, $message_id);
        }

        public function deleteMessage($json)
        {
            $message_obj = json_decode($json, true);
            $message_id = $message_obj['message_id'];

            $this->setData($this->sql_message_delete, 'i', $message_id);
        }
    }
