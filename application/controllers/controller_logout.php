<?php
    class ControllerLogout extends Controller
    {
        public function __construct()
        {
            $this->model = new ModelLogout();
        }

        public function actionLogout()
        {
            $this->model->unsetSessionParams();
            header('Location: /');
        }
    }