<?php
    class View
    {
        public function generate($content_view, $template_view, $data = NULL, $errors = NULL, $user_data = NULL)
        {
            include 'application/views/'.$template_view;
        }

        public function phpAlert($message)
        {
            echo '<script type="text/javascript">alert("'.$message.'")</script>';
        }
    }
