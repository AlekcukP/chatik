<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/dist/app.js"></script>
    <title>Login</title>
</head>
<body>
    <section class="border border-2 border-primary p-4">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <form method="POST" action="/login/check">
            <div class="block_login mb-3">
                <label for="loginLogin" class="form-label">Login</label>
                <input name="login" type="text" required id='loginLogin' class="form-control">

                <?php if ($data === 'login'):?>
                <span class="error">There is no user with such login.</span>
                <?php endif;?>
            </div>
            <div class="login_password mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input name="password" type="password" required id="loginPassword" class="form-control">

                <?php if ($data === 'password'):?>
                <span class="error">You entered wrong password.</span>
                <?php endif;?>
            </div>
            <div class="login_btns mb-3 d-flex justify-content-evenly">
                <input name="submit" type="submit" value="Enter" class="btn btn-primary">
                <div class="block_reg"><a href="/register" class="btn btn-secondary">Register</a></div>
            </div>
        </form>
    </section>
</body>
</html>
