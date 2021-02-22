<?php

class ControllerSettings extends Controller
{
    public function __construct()
    {
        $this->model = new ModelSettings;
        $this->view = new View;
        $this->validator = new Validator;
    }

    public function actionIndex($error = NULL)
    {
        $this->sessionCheck();
        $user_data = $this->model->getUserData($_SESSION['user_id']);
        $this->view->generate('settings_view.php', 'template_view.php','', $error, $user_data);
    }
    public function actionAvatar()
    {
        $error = '';
        $types = array(
            'jpg',
            'JPG',
            'jpeg',
            'gif',
            'bmp',
            'png'
        );
        $size = 5*1024*1024;
        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

        if ($_FILES['size']>$size) {
            $error = 'Image size can not be over 5 mb.';
            $this->actionIndex($error);
            return;
        }

        if (!in_array($ext, $types)) {
            $error = 'Image is not image';
            $this->actionIndex($error);
            return;
        }

        $this->model->updateAvatar($_FILES['avatar'], $_SESSION['user_id']);

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
        if (! isset($_SESSION['user_id'])) {
            header('Location: /');
        }
    }
}
