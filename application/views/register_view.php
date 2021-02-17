<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/dist/app.js"></script>
    <title>Register</title>
</head>
<body>
    <section class="border border-2 border-primary p-4">
        <form method="POST" action="/register/register">
            <div class="block_login mb-3">
                <label for="login" class="form-label">Login</label>
                <input name="login" type="text" required id='reg_login' class="form-control">
            </div>
            <div class="block_register_pass  mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" required id="reg_password" class="form-control">
            </div>
            <div class="block_register_action mb-3 d-flex justify-content-center">
                <input name="submit" type="submit" value="Register me" class="btn btn-primary">
            </div>
        </form>
    </section>
</body>
</html>
