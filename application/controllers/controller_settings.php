<?php

class Controller_Settings extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Settings();
        $this->view = new View();
    }

    public function action_index()
    {
        $this->view->generate('settings_view.php', 'template_view.php');
    }
}