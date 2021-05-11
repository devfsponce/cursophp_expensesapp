<?php
$user = $this->d['user'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <?php if ($user->getPhoto() != '') { ?>
        <img src="public/img/photos/<?php echo $user->getPhoto(); ?>" width="200">
    <?php } ?>

    <h2><?php echo ($user->getName() != '') ? $user->getName() : $user->getUserName(); ?> </h2>

    <form action=<?php echo constant('URL') . "/user/updateName" ?> method="POST">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" autocomplete="off" required value="<?php echo $user->getName() ?>">
        <div><input type="submit" value="Cambiar Nombre"></div>
    </form>

    <form action=<?php echo constant('URL') . "/user/updatePhoto" ?> method="POST" enctype="multipart/form-data">
        <div class="section">
            <label for="photo">Foto de Perfil</label>
            <?php
            if (!empty($user->getPhoto())) {
            ?>
                <img src="<?php echo constant('URL') ?>/public/img/photos<?php echo $user->getPhoto() ?>" width="50" height="50">
            <?php
            }
            ?>

            <input type="file" name="photo" id="photo" autocomplete="off" required>
            <div><input type="submit" value="Cambiar foto de perfil"></div>
        </div>
    </form>

    <?php if ($user->getPhoto() != '') { ?>
        <img src="public/img/photos/<?php echo $user->getPhoto(); ?>" width="200">
    <?php } ?>

    <h2><?php echo ($user->getName() != '') ? $user->getName() : $user->getUserName(); ?> </h2>

    <section id="password-user-container">
        <form action="action=<?php echo constant('URL') . "/user/updatePassword" ?>" method="POST">
            <div class="section">
                <label for="current_password">Password Actual</label>
                <input type="current_password" name="current_password" id="current_password" autocomplete="off">

                <label for="new_password">Nuevo Actual</label>
                <input type="new_password" name="new_password" id="new_password" autocomplete="off">
                <div><input type="submit" value="Cambiar password"></div>
            </div>
        </form>
    </section>

    <section id="budget-user-container">
        <form action="action=<?php echo constant('URL') . "/user/updateBudget" ?>" method="POST">
            <div class="section">
                <label for="budget">Definir presupuesto</label>
                <div><input type="number" name="budget" id="budget" autocomplete="off" required value="<?php echo $user->getBudget(); ?>"></div>
                <div><input type="submit" value="Actualizar Presupuesto"></div>
            </div>
        </form>
    </section>
</body>

</html>