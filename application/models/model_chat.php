<?php
    class Model_Chat extends Model
    {
        public function __construct()
        {
            $this->link = mysqli_connect('localhost', 'root', 'root', 'chat');
            $this->sql_message_create = "INSERT INTO chat.messages (user_id, message_text, message_time) VALUES (?, ?, ?)";
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
        public function get_data()
        {
            $result = array();

            while ($row = mysqli_fetch_assoc($this->sql_messages_query)) {
                $result[] = $row;
            }

            return $result;
        }
        public function send_message($message_text)
        {
            if ($stmt = mysqli_prepare($this->link, $this->sql_message_create)) {
                mysqli_stmt_bind_param($stmt, 'iss', $currentUserId, $messageText, $messageDate);

                $currentUserId = 1;
                $messageText = $message_text;
                $messageDate = date('YmdHms');

                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
        }
    }
