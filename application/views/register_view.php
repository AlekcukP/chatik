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
                <label for="regLogin" class="form-label">Login</label>
                <input name="login" type="text" required id='regLogin' class="form-control">

                <?php if ($errors['login']):?>
                    <span class="error"><?php echo($errors['login']);?></span>
                <?php endif;?>
            </div>
            <div class="mb-3">
                <label for="regEmail" class="form-label">Email</label>
                <input name="email" type="email" required id='regEmail' class="form-control">

                <?php if ($errors['email']):?>
                    <span class="error"><?php echo($errors['email']);?></span>
                <?php endif;?>
            </div>
            <div class="mb-3">
                <label for="regPassword" class="form-label">Password</label>
                <input name="password" type="password" required id="regPassword" class="form-control">

                <?php if ($errors['password']):?>
                    <span class="error"><?php echo($errors['password']);?></span>
                <?php endif;?>
            </div>
            <div class="mb-3 d-flex justify-content-evenly">
                <input name="submit" type="submit" value="Register me" class="btn btn-primary">
                <a href="/login" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>
</body>
</html>
