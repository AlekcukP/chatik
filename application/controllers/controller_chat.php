<?php
    class ControllerChat extends Controller
    {
        public function __construct()
        {
            $this->model = new ModelChat();
            $this->view = new View();
        }

        public function actionIndex()
        {
            $this->sessionCheck();
            $messages = $this->model->getMessages();
            $user_data = $this->model->getUserData($_SESSION['user_id']);
            $this->view->generate('chat_view.php', 'template_view.php', $messages, '', $user_data);
        }

        public function actionSend()
        {
            $this->model->createMessage($_POST['message'], $_SESSION['user_id']);
            header('Location: /');
        }

        public function actionUpdate()
        {
            $message_json = file_get_contents('php://input');
            $this->model->updateMessage($message_json);
        }

        public function actionDelete()
        {
            $message_json = file_get_contents('php://input');
            $this->model->deleteMessage($message_json);
        }

        public function sessionCheck()
        {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /');
            }
        }
    }
