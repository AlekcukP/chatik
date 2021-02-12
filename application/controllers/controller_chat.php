<?php
    class Controller_Chat extends Controller
    {
        public function __construct()
        {
            $this->model = new Model_Chat();
            $this->view = new View();
        }

        public function action_index()
        {
            $messages = $this->model->get_data();
            $this->view->generate('chat_view.php', 'template_view.php', $messages);
        }

        public function action_send()
        {
            $this->model->send_message($_POST['message']);
            header('Location: /');
        }
    }
