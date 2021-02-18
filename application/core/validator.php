<?php
    class Validation
    {
        public function validateLogin($login)
        {
            if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
                return 'Login can consist only letters of the English alphabet and numbers';
            } elseif (strlen($login) < 3) {
                return 'Login must be at least 3 symbols';
            } elseif (strlen($login) > 30) {
                return 'Login must be no more than 30 symbols';
            } else {
                return NULL;
            }
        }
    }