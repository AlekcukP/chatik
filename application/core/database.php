<?php
    class Database
    {
        private $connection;

        public function __construct()
        {
            try {
                $this->connection = mysqli_connect(HOST_NAME, SQL_LOGIN, SQL_PASSWORD, DB_NAME);
            } catch (Exception $e) {
                echo "Connection error: " . $e->getMessage();
            }
        }

        public function getOne($sql_request, $params_types, ...$params)
        {
            $data = [];

            if ($stmt = mysqli_prepare($this->connection, $sql_request)) {
                mysqli_stmt_bind_param($stmt, $params_types, ...$params);

                mysqli_stmt_execute($stmt);

                $res = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_assoc($res);
            }
            mysqli_stmt_close($stmt);

            return $data;
        }

        public function getAll($sql_request)
        {
            $data = mysqli_query($this->connection, $sql_request);

            $result = array();

            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
            }

            return $result;
        }

        public function setData($sql_request, $params_types, ...$params)
        {
            if ($stmt = mysqli_prepare($this->connection, $sql_request)) {
                mysqli_stmt_bind_param($stmt, $params_types, ...$params);
                mysqli_stmt_execute($stmt);
            }
            $id = mysqli_insert_id($this->connection);
            mysqli_stmt_close($stmt);

            return $id;
        }
    }
