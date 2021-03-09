<?php
    class ModelRegister extends Model
    {
        public $sql_login_check = "SELECT user_id FROM users WHERE user_login = ?";
        public $sql_create_user = "INSERT INTO
                                            chat.users (user_login, user_password, avatar, user_email, user_token)
                                    VALUES (?,?,?,?,?)";
        public $sql_email_confirm = "UPDATE chat.users SET email_verificated = ? WHERE user_token = ?";

        public function getUserLogin($user_name)
        {
            return $this->db->getOne($this->sql_login_check, 's', $user_name);
        }

        public function registerUser($user_name, $user_password, $user_email)
        {
            $token = $this->generateToken();
            $this->createUser($user_name, $user_password, $user_email, $token);
            $this->sendMail($user_email, $token);
        }

        public function confirmEmail($token)
        {
            $time = date('d.m.Y H:m:s');
            $this->db->setData($this->sql_email_confirm, 'ss', $time, $token);
        }

        public function createUser($user_name, $user_password, $user_email, $user_token)
        {
            $user_password = trim($user_password);
            $user_avatar = '/avatar/default.png';

            $this->db->setData(
                $this->sql_create_user,
                'sssss',
                $user_name,
                $user_password,
                $user_avatar,
                $user_email,
                $user_token
            );
        }

        private function sendMail($email, $token)
        {
            $subject = 'Chatiks.loc';
            $message = 'To verificate your mail follow this link: '.
                        'https://chatiks.loc/register/confirm/' . $token;
            $headers = 'Verification mail.';

            mail($email, $subject, $message, $headers);
        }

        private function generateToken($length=16, $list="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ")
        {
            mt_srand((double)microtime()*1000000);
            $newstring = "";

            if ($length>0) {
                while (strlen($newstring)<$length) {
                    $newstring .= $list[mt_rand(0, strlen($list)-1)];
                }
            }
            return $newstring;
        }
    }
