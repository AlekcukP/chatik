<?php

class ControllerLogin extends Controller
{
    public function __construct()
    {
        $this->model = new ModelLogin;
        $this->view = new View;
    }

    public function actionIndex()
    {
        $this->sessionCheck();
        $this->view->generate('', 'login_view.php');
    }

    public function actionError($error)
    {
        $this->view->generate('', 'login_view.php', '', $error);
    }

    public function actionCheck()
    {
        $user_data = $this->model->getUserData($_POST['login']);
        $error = [];

        if (!$user_data) {
            $error['login'] = 'There is no user with such login.';
            $this->actionError($error);

            return;
        }
        if(!$user_data['email_verificated']){
            $error['email'] = 'Please, verificate your email.';
            $this->actionError($error);

            return;
        }
        if ($user_data['user_password'] === $_POST['password']) {
            $_SESSION['user_id'] = $user_data['user_id'];
            header('Location: /chat');
        } elseif ($user_data['user_password'] !== $_POST['password']) {
            $error['password'] = 'You entered wrong password.';
            $this->actionError($error);

            return;
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
