<?php
    require_once 'config.php';

    require_once 'core/model.php';
    require_once 'core/view.php';
    require_once 'core/controller.php';
    require_once 'core/database.php';
    require_once 'core/avatar.php';
    require_once 'core/curl.php';
    require_once 'core/validator.php';
    require_once 'libs/authentication-jwt/src/JWT.php';
    require_once 'core/jwt.php';

    require_once 'core/route.php';

    Route::start();
