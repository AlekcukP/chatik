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
        $this->view->generate('settings_view.php', 'template_view.php');
    }
    public function sessionCheck()
    {
        if (! isset($_SESSION['user_id'])) {
            header('Location: /');
        }
    }
}
