<?php
    class Model
    {
        public function __construct()
        {
            $this->link = mysqli_connect(HOST_NAME, SQL_LOGIN, SQL_PASSWORD, DB_NAME);
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
            mysqli_stmt_close($stmt);
        }
    }