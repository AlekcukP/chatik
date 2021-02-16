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
            $messages = $this->model->getData();
            $this->view->generate('chat_view.php', 'template_view.php', $messages);
        }

        public function actionSend()
        {
            $this->model->createMessage($_POST['message']);
            header('Location: /');
        }

        public function actionUpdate()
        {
            $message_json = file_get_contents('php://input');
            $this->model->updateMessage($message_json);
            header('Location: /');
        }

        public function actionDelete()
        {
            $message_json = file_get_contents('php://input');
            $this->model->deleteMessage($message_json);
            header('Location: /');
        }

        public function sessionCheck()
        {
            if (! isset($_SESSION['user_id'])) {
                header('Location: /');
            }
        }
    }
