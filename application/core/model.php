<?php
    class Model
    {
        private $link;
        public $curl;

        public function __construct()
        {
            $this->link = mysqli_connect(HOST_NAME, SQL_LOGIN, SQL_PASSWORD, DB_NAME);
            $this->curl = new Curl(WS_LINK);
        }

        public function getData($sql_request, $params_types, ...$params)
        {
            $data = [];

            if ($stmt = mysqli_prepare($this->link, $sql_request)) {
                mysqli_stmt_bind_param($stmt, $params_types, ...$params);

                mysqli_stmt_execute($stmt);

                $res = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_assoc($res);
            }
            mysqli_stmt_close($stmt);

            return $data;
        }

        public function setData($sql_request, $params_types, ...$params)
        {
            if ($stmt = mysqli_prepare($this->link, $sql_request)) {
                mysqli_stmt_bind_param($stmt, $params_types, ...$params);
                mysqli_stmt_execute($stmt);
            }
            $id = mysqli_insert_id($this->link);
            mysqli_stmt_close($stmt);

            return $id;
        }

        public function getAll($sql_request)
        {
            $data = mysqli_query($this->link, $sql_request);

            $result = array();

            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
            }

            return $result;
        }
    }