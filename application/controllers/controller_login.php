<?php

class ControllerLogin extends Controller
{
    public function __construct()
    {
        $this->model = new ModelLogin();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->sessionCheck();
        $this->view->generate('', 'login_view.php');
    }

    public function actionPass()
    {
        $this->view->generate('', 'login_view.php', 'password');
    }

    public function actionLogin()
    {
        $this->view->generate('', 'login_view.php', 'login');
    }

    public function actionCheck()
    {
        $user_data = $this->model->getUserData($_POST['login']);

        if (!$user_data) {
            $this->actionLogin();
        }

        if ($user_data['user_password'] === $_POST['password']){
            $_SESSION['user_id'] = $user_data['user_id'];
            header('Location: /chat');
        } elseif ($user_data['user_password'] !== $_POST['password']) {
            $this->actionPass();
        }
    }

    public function actionLogout()
    {
        unset($_SESSION['user_id']);
        session_destroy();

        $this->actionIndex();
    }

    public function sessionCheck()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /chat');
        }
    }
}
