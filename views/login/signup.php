<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
</head>

<body>
    <?php $this->showMessages(); ?>

    <form action="<?php echo constant('URL'); ?>signup/newUser" method="POST">
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </p>
        <p>
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
        </p>
        <p>
            <input type="submit" value="Iniciar sesión">
        </p>
        <p>
            ¿Tienes una cuenta? <a href="<?php echo constant('URL'); ?>">Inicia sesion</a>
        </p>
    </form>
</body>

</html>