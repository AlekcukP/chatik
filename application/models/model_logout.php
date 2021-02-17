<?php
    class ModelLogout extends Model
    {
        public function unsetSessionParams()
        {
            unset($_SESSION['user_id']);
            session_destroy();
        }
    }