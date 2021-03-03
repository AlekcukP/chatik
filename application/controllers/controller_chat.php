<?php
    class ControllerChat extends Controller
    {
        public $curl;

        public function __construct()
        {
            $this->model = new ModelChat;
            $this->view = new View;
            $this->curl = new Curl(WS_LINK);
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
            $message_json = file_get_contents('php://input');
            $inserted_id = $this->model->createMessage($message_json, $_SESSION['user_id']);
            $message = $this->model->getMessage($inserted_id);
            $this->curl->postJson(json_encode($message), 'message');
        }

        public function actionUpdate()
        {
            $message_json = file_get_contents('php://input');
            $user_id = $this->model->getUserId($message_json);

            if ($user_id['user_id'] === $_SESSION['user_id']) {
                $this->model->updateMessage($message_json);
            }
        }

        public function actionDelete()
        {
            $message_json = file_get_contents('php://input');
            $user_id = $this->model->getUserId($message_json);

            if ($user_id['user_id'] === $_SESSION['user_id']) {
                $this->model->deleteMessage($message_json);
            }
        }

        public function actionUserId()
        {
            header('Content-Type: application/json');
            echo json_encode($_SESSION['user_id']);
        }

        public function sessionCheck()
        {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /');
            }
        }
    }
