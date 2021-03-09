<?php
    class ControllerRegister extends Controller
    {
        public function __construct()
        {
            $this->model = new ModelRegister;
            $this->view = new View;
            $this->validator = new Validator;
        }

        public function actionIndex()
        {
            $this->view->generate('', 'register_view.php');
        }

        public function actionError($error)
        {
            $this->view->generate('', 'register_view.php', '', $error);
        }

        public function actionConfirm($token)
        {
            $this->model->confirmEmail($token);
            header('Location: /');
        }

        public function actionRegister()
        {
            $error = [];
            if ($this->model->getUserLogin($_POST['login']) > 0) {
                $error['login'] = 'User with this login has already exist';
                $this->actionError($error);
                return;
            } elseif ($res = $this->validator->validateLogin($_POST['login'])) {
                $error['login'] = $res;
                $this->actionError($error);
                return;
            } elseif ($res = $this->validator->validateEmail($_POST['email'])) {
                $error['email'] = $res;
                $this->actionError($error);
                return;
            } elseif ($res = $this->validator->validatePassword($_POST['password'])) {
                $error['password'] = $res;
                $this->actionError($error);
                return;
            } else {
                $this->model->registerUser($_POST['login'], $_POST['password'], $_POST['email']);
                $this->view->phpAlert('We`re send mail on your email address, check it to finish registration.');
                $this->actionIndex();
            }
        }
    }
