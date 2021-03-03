<?php
    class Curl
    {
        private $url;

        public function __construct($url)
        {
            $this->url = $url;
        }

        public function postJson($json, $action = '')
        {
            $curl_session = curl_init();

            curl_setopt($curl_session, CURLOPT_URL, $this->url . $action);
            curl_setopt($curl_session, CURLOPT_POST, 1);
            curl_setopt($curl_session, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl_session, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json))
            );
            curl_exec($curl_session);
            curl_close($curl_session);
        }
    }