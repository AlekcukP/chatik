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
        $check_result = $this->model->checkUser($_POST['login'], $_POST['password']);

        if ($check_result === 'confirmed') {
            $this->model->setSessionParams($_POST['login']);
            header('Location: /chat');
        } elseif ($check_result === 'password') {
            header('Location: /login/pass');
        } else {
            header('Location: /login/login');
        }
    }

    public function actionLogout()
    {
        $this->model->unsetSessionParams();
        $this->actionIndex();
    }

    public function sessionCheck()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /chat');
        }
    }
}
