<?php
    class ModelChat extends Model
    {
        public function __construct()
        {
            $this->link = mysqli_connect(HOST_NAME, SQL_LOGIN, SQL_PASSWORD, DB_NAME);
            $this->sql_message_update = "UPDATE messages SET message_text = ? WHERE id = ?";
            $this->sql_message_delete = "DELETE FROM messages WHERE id = ?";
            $this->sql_message_create = "INSERT INTO
                                                    chat.messages (user_id, message_text, message_time)
                                                VALUES (?, ?, ?)";
            $this->sql_messages_query = mysqli_query(
                $this->link,
                "SELECT
                    messages.user_id,
                    messages.id, message_text,
                    message_time, avatar,
                    users.user_login
                FROM messages
                JOIN users ON
                    messages.user_id = users.user_id"
            );
        }

        public function getData()
        {
            $result = array();

            while ($row = mysqli_fetch_assoc($this->sql_messages_query)) {
                $result[] = $row;
            }

            return $result;
        }

        public function createMessage($message_text)
        {
            if ($stmt = mysqli_prepare($this->link, $this->sql_message_create)) {
                mysqli_stmt_bind_param($stmt, 'iss', $current_user_id, $message_text, $message_date);

                $current_user_id = $_SESSION['user_id'];
                $message_text = $message_text;
                $message_date = date('YmdHms');

                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
        }

        public function updateMessage($json)
        {
            $message_obj = json_decode($json, true);

            if ($stmt = mysqli_prepare($this->link, $this->sql_message_create)) {
                mysqli_stmt_bind_param($stmt, 'si', $message_text, $message_id);

                $message_id = $message_obj['message_id'];
                $message_text = $message_obj['message_text'];

                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
        }

        public function deleteMessage($json)
        {
            $message_obj = json_decode($json, true);

            if ($stmt = mysqli_prepare($this->link, $this->sql_message_create)) {
                mysqli_stmt_bind_param($stmt, 'i', $message_id);

                $message_id = $message_obj['message_id'];

                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
        }
    }
