<?php
    class Jwt
    {
        private $key = "secret_key";
        private $jwt_lib;

        public function __construct()
        {
            $this->jwt_lib = new \Firebase\JWT\JWT;
        }

        public function generate($user_id)
        {
            $current_time = time();

            $token = array(
                "alg" => "HS256",
                "typ" => "JWT",
                "data" => array(
                    "user_id" => $user_id,
                    "iat" => $current_time,
                    "exp" => $current_time + (60*60*60)
                )
            );

            return $this->jwt_lib::encode($token, $this->key);
        }

        public function decode($jwt)
        {
            return $this->jwt_lib::decode($jwt, $this->key, array('HS256'));
        }
    }
