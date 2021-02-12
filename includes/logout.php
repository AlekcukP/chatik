<?php
session_start();

unset($_SESSION['user_id']);
unset($_SESSION['user_login']);
unset($_SESSION['avatar']);

session_destroy();

header('Location: index.php?page=login');
