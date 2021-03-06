<?php
    class ControllerContacts extends Controller
    {
        public function __construct()
        {
            $this->model = new ModelContacts;
            $this->view = new View;
        }

        public function actionIndex()
        {
            $this->sessionCheck();
            $user_data = $this->model->getUserData($_SESSION['user_id']);
            $contacts = $this->model->getContacts();
            $this->view->generate('contacts_view.php', 'template_view.php', $contacts, '', $user_data);
        }

        private function sessionCheck()
        {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /');
            }
        }
    }