<?php

class ControllerSettings extends Controller
{
    public function __construct()
    {
        $this->model = new ModelSettings;
        $this->view = new View;
        $this->validator = new Validator;
        $this->avatar = new Avatar;
    }

    public function actionIndex($error = NULL)
    {
        $this->sessionCheck();
        $user_data = $this->model->getUserData($_SESSION['user_id']);
        $this->view->generate('settings_view.php', 'template_view.php','', $error, $user_data);
    }
    public function actionAvatar()
    {
        if(!$this->avatar->checkConformity($_FILES['avatar'])){
            $avatar_path = $this->avatar->setAvatar($_FILES['avatar'], $_SESSION['user_id']);
            $this->model->updateAvatar($avatar_path, $_SESSION['user_id']);
        }

        header('Location: /settings');
    }

    public function actionLogin()
    {
        if ($error = $this->validator->validateLogin($_POST['login'])) {
            $this->actionIndex($error);
        } else {
            $this->model->updateLogin($_POST['login'], $_SESSION['user_id']);
            $this->actionIndex();
        }
    }

    public function actionPassword()
    {
        if ($error = $this->validator->validatePassword($_POST['password'])) {
            $this->actionIndex($error);
        }  else {
            $this->model->updatePassword($_POST['password'], $_SESSION['user_id']);
            $this->actionIndex();
        }
    }

    public function sessionCheck()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
        }
    }
}
