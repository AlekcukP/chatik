<?php
    class ControllerRegister extends Controller
    {
        public function __construct()
        {
            $this->model = new ModelRegister();
            $this->view = new View();
        }

        public function actionIndex()
        {
            $this->view->generate('', 'register_view.php');
        }

        public function actionRegister()
        {
            if (count($this->model->checkUser($_POST['login'])) == 0) {
                $this->model->createUser($_POST['login'], $_POST['password']);
            }
            header('Location: /');
        }
    }
