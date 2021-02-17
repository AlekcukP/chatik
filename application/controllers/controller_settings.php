<?php

class ControllerSettings extends Controller
{
    public function __construct()
    {
        $this->model = new ModelSettings();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->sessionCheck();
        $user_data = $this->model->getUserData();
        $this->view->generate('settings_view.php', 'template_view.php', $user_data);
    }
    public function actionAvatar()
    {
        $res = $this->model->checkFile($_FILES['avatar']);

        if (! $res) {
            $this->model->updateAvatar($_FILES['avatar']);
        }

        header('Location: /settings');
    }
    public function sessionCheck()
    {
        if (! isset($_SESSION['user_id'])) {
            header('Location: /');
        }
    }
}
